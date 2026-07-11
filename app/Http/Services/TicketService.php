<?php

namespace App\Http\Services;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TicketService
{
    public static function create(array $data, array $files = []): Ticket
    {
        return DB::transaction(function () use ($data, $files) {
            unset($data['attachments']);

            $data['priority'] = TicketPriority::fromValue((int) $data['priority']);
            $data['status'] = TicketStatus::fromValue((int) $data['status']);

            $ticket = Ticket::create([
                'user_id' => Auth::id(),
                ...$data,
            ]);

            if (!blank($files)) {
                AttachmentService::create($ticket, $files);
            }

            return $ticket;
        });
    }

    public static function update(Ticket $ticket, array $data, array $files = []): Ticket
    {
        return DB::transaction(function () use($ticket, $data, $files) {
            unset($data['attachments']);

            $ticket->update($data);

            if (!blank($files)) {
                AttachmentService::create($ticket, $files);
            }

            return $ticket->fresh();
        });
        
    }

    public static function delete(Ticket $ticket): void
    {
        DB::transaction(function () use ($ticket) {
            foreach ($ticket->attachments as $attachment) {
                Storage::disk('public')->delete($attachment->path);
            }

            $ticket->delete();
        });
    }
}
