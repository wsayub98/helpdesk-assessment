<?php

namespace App\Livewire\Tickets;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;

class TicketTable extends Component
{
    use WithPagination;

    public Ticket $ticket;
    public string $search = '';
    public string $status = '';
    public string $priority = '';
    public function render()
    {
        $tickets = Ticket::query()
            ->when($this->search, fn ($q) =>
                $q->where('title', 'like', "%{$this->search}%"))
            ->when($this->status, fn ($q) =>
                $q->where('status', $this->status))
            ->when($this->priority, fn ($q) =>
                $q->where('priority', $this->priority))
            ->latest()
            ->paginate(10);

        return view('livewire.tickets.ticket-table', compact('tickets'));
    }
}
