<?php

namespace Tests\Unit;

use Tests\TestCase;

class TransactionImportTest extends TestCase
{
    public function test_duplicate_transactions_are_removed()
    {
        $transactions = [
            [
                'txn_date' => '2024-01-12',
                'amount' => 1500.50,
                'customer_email' => 'ali@email.com',
            ],
            [
                'txn_date' => '2024-01-12',
                'amount' => 1500.50,
                'customer_email' => 'ali@email.com',
            ],
            [
                'txn_date' => '2024-01-13',
                'amount' => 2500,
                'customer_email' => 'ali@email.com',
            ],
        ];

        $unique = collect($transactions)->unique(function ($transaction) {
                return $transaction['txn_date'] . $transaction['customer_email'] . $transaction['amount'];
            })->values();

        $this->assertCount(2, $unique);
    }


    public function test_different_transaction_is_not_removed()
    {
        $transactions = [
            [
                'txn_date' => '2024-01-12',
                'amount' => 1500.50,
                'customer_email' => 'ali@email.com',
            ],
            [
                'txn_date' => '2024-01-12',
                'amount' => 2000,
                'customer_email' => 'ali@email.com',
            ],
        ];

        $unique = collect($transactions)->unique(function ($transaction) {
                return $transaction['txn_date'] . $transaction['customer_email'] . $transaction['amount'];
            })->values();

        $this->assertCount(2, $unique);
    }
}
