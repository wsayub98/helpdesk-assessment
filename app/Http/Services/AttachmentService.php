<?php

namespace App\Http\Services;

use App\Models\Attachment;
use App\Models\Ticket;
use Illuminate\Http\UploadedFile;

class AttachmentService
{
    public static function create(Ticket $ticket, array $files = []): void
    {
        foreach ($files as $file) {
            if(!$file instanceof UploadedFile)
                continue;

            $path = $file->store('tickets', 'public');

            Attachment::create([
                'ticket_id' => $ticket->id,
                'filename' => $file->getClientOriginalName(),
                'path' => $path,
                'size' => $file->getSize(),
            ]);
        }
    }
}
