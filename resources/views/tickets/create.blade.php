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
                        <h3 class="text-lg font-semibold text-gray-800">New Ticket</h3>
                        <x-secondary-button onclick="window.location.href='{{ route('tickets.index') }}'">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                    </div>

                    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">

                                <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                    @csrf
                                    <div>
                                        <x-input-label for="title" :value="__('Title')" />
                                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                            :value="old('title')" required autofocus />
                                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                                    </div>

                                    <div>
                                        <x-input-label for="description" :value="__('Description')" />
                                        <textarea id="description" name="description" rows="4"
                                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required>{{ old('description') }}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                    </div>

                                    <div>
                                        <x-input-label for="priority" :value="__('Priority')" />
                                        <select id="priority" name="priority"
                                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required>
                                            <option value="" disabled selected>Select an option</option>
                                            <option value="0">Low</option>
                                            <option value="1">Medium</option>
                                            <option value="2">High</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('priority')" />
                                    </div>

                                    <div>
                                        <x-input-label for="status" :value="__('Status')" />
                                        <select id="status" name="status"
                                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required>
                                            <option value="" disabled selected>Select an option</option>
                                            <option value="0">Open</option>
                                            <option value="1">In Progress</option>
                                            <option value="2">Resolved</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('status')" />
                                    </div>

                                    <div>
                                        <x-input-label for="category" :value="__('Category')" />
                                        <select id="category" name="category"
                                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required>
                                            <option value="" disabled selected>Select an option</option>
                                            <option value="hardware">Hardware</option>
                                            <option value="infra">Infra</option>
                                            <option value="bug">Bug</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('category')" />
                                    </div>

                                    <div>
                                        <x-input-label for="attachment" :value="__('Upload File')" />
                                        <input id="attachment" name="attachments[]" type="file" multiple accept=".pdf, image/*"
                                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                                        <x-input-error class="mt-2" :messages="$errors->get('attachment')" />
                                    </div>

                                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                                        <x-secondary-button type="button" onclick="window.history.back()">
                                            {{ __('Cancel') }}
                                        </x-secondary-button>

                                        <x-primary-button>
                                            {{ __('Create Ticket') }}
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