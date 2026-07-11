<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ImportTransactions extends Command
{
    protected $signature = 'import:transactions {file}';

    protected $description = 'Import transactions from CSV';

    public function handle()
    {
        $file = $this->argument('file');

        $handle = fopen($file, 'r');

        $header = fgetcsv($handle);

        $batch = [];
        $batchSize = 1000;

        while (($row = fgetcsv($handle)) !== false) {

            $data = array_combine($header, $row);

            // Parse mixed date format.
            $date = $this->parseDate($data['txn_date']);

            // Fallback customer name.
            $customerName = $data['customer_name'] ?: $data['customer_email'];

            // Normalize status.
            $status = strtolower(trim($data['status']));

            // Duplicate checking.
            $exists = DB::table('transactions')
                ->whereDate('txn_date', $date)
                ->where('customer_email', $data['customer_email'])
                ->where('amount', $data['amount'])
                ->exists();

            if ($exists) {
                continue;
            }

            $batch[] = [
                'txn_date' => $date,
                'amount' => $data['amount'],
                'customer_name' => $customerName,
                'customer_email' => $data['customer_email'],
                'status' => $status,
            ];

            if (count($batch) >= $batchSize) {
                DB::table('transactions')->insertOrIgnore($batch);
                $batch = [];
            }
        }

        // Insert remaining rows.
        if (!empty($batch)) {
            DB::table('transactions')->insert($batch);
        }

        fclose($handle);

        $this->info('Import completed');

        return Command::SUCCESS;
    }

    private function parseDate($date)
    {
        $formats = [
            'd/m/Y',
            'Y-m-d',
            'd-m-Y'
        ];

        foreach ($formats as $format) {
            try {
                return Carbon::createFromFormat(
                    $format,
                    $date
                )->format('Y-m-d');
            } catch (\Exception $e) {}
        }

        return null;
    }
}
