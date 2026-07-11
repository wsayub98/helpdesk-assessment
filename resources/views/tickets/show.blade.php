<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-800">Ticket Details</h3>
                        <x-secondary-button onclick="window.location.href='{{ route('tickets.index') }}'">
                            {{ __('Back') }}
                        </x-secondary-button>
                    </div>

                    <div class="py-6">
                        <div class="max-w-7xl mx-auto">

                            {{-- Ticket Details --}}
                            <div class="bg-white p-6 rounded-lg shadow">

                                <h1 class="text-2xl font-bold">
                                    {{ $ticket->title }}
                                </h1>

                                <div class="mt-4">
                                    <p>
                                        Category: {{ $ticket->category }}
                                    </p>
                                    <p>
                                        Priority: {{ $ticket->priority->label() }}
                                    </p>
                                    <p>
                                        Status: {{ $ticket->status->label() }}
                                    </p>
                                </div>
                                <hr class="my-4">
                                <p>
                                    {{ $ticket->description }}
                                </p>
                            </div>


                            {{-- Attachments --}}
                            <div class="bg-white p-6 mt-6 rounded-lg shadow">
                                <h2 class="font-bold text-lg">
                                    Attachments
                                </h2>
                                @forelse($ticket->attachments as $attachment)
                                    <div class="mt-2">
                                        <a href="{{ Storage::url($attachment->path) }}" target="_blank"
                                            class="text-blue-600">
                                            {{ $attachment->filename }}
                                        </a>
                                    </div>
                                @empty
                                    <p>No attachments</p>
                                @endforelse
                            </div>

                            {{-- Comments --}}
                            <div class="bg-white p-6 mt-6 rounded-lg shadow">
                                <h2 class="font-bold text-lg">
                                    Comments
                                </h2>
                                <livewire:comments.ticket-comments :ticket="$ticket" />
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>