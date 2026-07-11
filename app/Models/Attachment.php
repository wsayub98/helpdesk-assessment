<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'ticket_id',
        'filename',
        'path',
        'size'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
