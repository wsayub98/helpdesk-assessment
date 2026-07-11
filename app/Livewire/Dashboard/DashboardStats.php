<?php

namespace App\Livewire\Dashboard;

use App\Models\Ticket;
use Livewire\Component;

class DashboardStats extends Component
{
    public function render()
    {
        return view('livewire.dashboard.dashboard-stats', [
            'openTickets' => Ticket::where('status', 'open')->count(),
            'inProgressTickets' => Ticket::where('status', 'in_progress')->count(),
            'resolvedTickets' => Ticket::where('status', 'resolved')->count(),
            'priorityStats' => [
                'low' => Ticket::where('priority', 'low')->count(),
                'medium' => Ticket::where('priority', 'medium')->count(),
                'high' => Ticket::where('priority', 'high')->count(),
            ],
            'recentTickets' => Ticket::latest()
                ->take(5)
                ->get(),
        ]);
    }
}
