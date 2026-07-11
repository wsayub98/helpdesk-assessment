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
                        <h3 class="text-lg font-semibold text-gray-800">Edit Ticket</h3>
                        <x-secondary-button onclick="window.location.href='{{ route('tickets.index') }}'">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                    </div>

                    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">

                                <form action="{{ route('tickets.update', $ticket) }}" method="POST"
                                    enctype="multipart/form-data" class="space-y-6">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <x-input-label for="title" :value="__('Title')" />
                                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                            value="{{ old('title', $ticket->title) }}" required autofocus />
                                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                                    </div>

                                    <div>
                                        <x-input-label for="description" :value="__('Description')" />
                                        <textarea id="description" name="description" rows="4"
                                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required>{{  old('description', $ticket->description)  }}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                    </div>

                                    <div>
                                        <x-input-label for="priority" :value="__('Priority')" />
                                        <select id="priority" name="priority"
                                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required>
                                            <option value="" disabled selected>Select an option</option>
                                            @foreach(\App\Enums\TicketPriority::cases() as $priority)
                                                <option value="{{ $priority->value }}"
                                                    @selected($ticket->priority === $priority)>
                                                    {{ $priority->label() }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('priority')" />
                                    </div>

                                    <div>
                                        <x-input-label for="status" :value="__('Status')" />
                                        <select id="status" name="status"
                                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required>
                                            <option value="" disabled selected>Select an option</option>
                                            @foreach(\App\Enums\TicketStatus::cases() as $status)
                                                <option value="{{ $status->value }}" @selected($ticket->status === $status)>
                                                    {{ $status->label() }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('status')" />
                                    </div>

                                    <div>
                                        <x-input-label for="category" :value="__('Category')" />
                                        <select id="category" name="category"
                                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required>
                                            <option value="" disabled selected>Select an option</option>
                                            <option value="hardware" @selected($ticket->category == 'hardware')>Hardware
                                            </option>
                                            <option value="infra" @selected($ticket->category == 'infra')>Infra</option>
                                            <option value="bug" @selected($ticket->category == 'bug')>Bug</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('category')" />
                                    </div>

                                    <div>
                                        {{-- Existing Attachments --}}
                                        <div class="mt-6">
                                            <x-input-label value="Existing Attachments" />
                                            @foreach($ticket->attachments as $attachment)
                                                <div class="flex justify-between mt-2">
                                                    <a href="{{ Storage::url($attachment->path) }}" target="_blank">
                                                        {{ $attachment->filename }}
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                        {{-- New Attachments --}}
                                        <div class="mt-4">
                                            <x-input-label value="Add Attachments" />
                                            <input type="file" name="attachments[]" multiple />
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                                        <x-secondary-button type="button" onclick="window.history.back()">
                                            {{ __('Cancel') }}
                                        </x-secondary-button>

                                        <x-primary-button>
                                            {{ __('Update Ticket') }}
                                        </x-primary-button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>