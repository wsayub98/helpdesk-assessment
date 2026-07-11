<div class="space-y-6">

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <div class="rounded-lg bg-white p-6 shadow">
            <p class="text-sm text-gray-500">Open Tickets</p>
            <h2 class="mt-2 text-3xl font-bold">{{ $openTickets }}</h2>
        </div>
        <div class="rounded-lg bg-white p-6 shadow">
            <p class="text-sm text-gray-500">In Progress</p>
            <h2 class="mt-2 text-3xl font-bold">{{ $inProgressTickets }}</h2>
        </div>
        <div class="rounded-lg bg-white p-6 shadow">
            <p class="text-sm text-gray-500">Resolved</p>
            <h2 class="mt-2 text-3xl font-bold">{{ $resolvedTickets }}</h2>
        </div>

    </div>


    {{-- Chart + Recent Activity --}}
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
        {{-- Chart --}}
        <div class="xl:col-span-2 rounded-lg bg-white p-6 shadow">
            <h2 class="mb-4 text-lg font-semibold">
                Tickets by Priority
            </h2>
            <div class="h-64 w-full">
                <canvas id="priorityChart"></canvas>
            </div>
        </div>


        {{-- Recent Activity --}}
        <div class="rounded-lg bg-white p-6 shadow">
            <h2 class="mb-4 text-lg font-semibold">
                Recent Activity
            </h2>
            <div class="space-y-4">
                @forelse($recentTickets as $ticket)
                    <div class="border-b pb-3">
                        <p class="font-medium">
                            {{ $ticket->title }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ $ticket->status->label() }}
                        </p>
                        <p class="text-xs text-gray-400">
                            {{ $ticket->created_at->diffForHumans() }}
                        </p>
                    </div>
                @empty
                    <p class="text-gray-500">No recent activity.</p>
                @endforelse
            </div>
        </div>
    </div>

    @script
    <script>
    const ctx = document.getElementById('priorityChart');

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Low', 'Medium', 'High'],
            datasets: [{
                data: [
                    {{ $priorityStats['low'] }},
                    {{ $priorityStats['medium'] }},
                    {{ $priorityStats['high'] }}
                ]
            }]
        }
    });
    </script>
    @endscript
</div>