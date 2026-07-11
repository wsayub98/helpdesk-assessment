<?php

namespace App\Livewire\Comments;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TicketComments extends Component
{
    public Ticket $ticket;
    public string $content = '';

    public function render()
    {
        return view('livewire.comments.ticket-comments');
    }

    public function addComment()
    {
        $this->validate([
            'content' => ['required', 'string'],
        ]);

        $this->ticket->comments()->create([
            'user_id' => Auth::id(),
            'ticket_id' => $this->ticket->id,
            'content' => $this->content,
        ]);

        $this->content = '';

        $this->ticket->refresh();

        session()->flash(
            'success',
            'Comment added successfully'
        );
    }
}
