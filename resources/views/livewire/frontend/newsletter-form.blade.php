<div class="w-full max-w-md">
    @if($subscribed)
        <div class="flex items-center justify-center space-x-2 text-white">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-medium">Thank you for subscribing!</span>
        </div>
    @else
        <form wire:submit="subscribe" class="flex flex-col sm:flex-row gap-3">
            <input type="email" wire:model="email" placeholder="Enter your email"
                   class="flex-1 rounded-lg border-0 px-4 py-3 text-gray-900 shadow-sm focus:ring-2 focus:ring-white">
            <button type="submit"
                    class="rounded-lg bg-white px-6 py-3 text-sm font-semibold text-primary shadow-sm hover:bg-gray-100 transition-colors">
                <span wire:loading.remove>Subscribe</span>
                <span wire:loading>...</span>
            </button>
        </form>
        @error('email')
            <p class="mt-2 text-sm text-white/80">{{ $message }}</p>
        @enderror
    @endif
</div>
