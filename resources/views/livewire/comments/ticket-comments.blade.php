<div>
    <div class="space-y-4 mb-6">
        @forelse($ticket->comments as $comment)
            <div class="bg-gray-100 rounded-lg p-4 mb-4">
                <div class="flex justify-between items-center">
                    <h4 class="font-semibold">
                        {{ $comment->user->name }}
                    </h4>

                    <span class="text-sm text-gray-500">
                        {{ $comment->created_at->diffForHumans() }}
                    </span>
                </div>
                <p class="mt-2 text-gray-700">
                    {{ $comment->content }}
                </p>
            </div>
        @empty
            <p class="text-gray-500">
                No comments yet.
            </p>
        @endforelse
    </div>

    <form wire:submit="addComment">
        <textarea
            wire:model="content"
            rows="3"
            class="w-full border rounded-lg p-3"
            placeholder="Write a reply..."
        ></textarea>
        @error('content')
            <span class="text-red-500 text-sm">
                {{ $message }}
            </span>
        @enderror
        <x-primary-button>{{ __('Submit') }}</x-primary-button>
    </form>

</div>