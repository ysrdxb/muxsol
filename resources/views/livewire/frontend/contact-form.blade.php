<div>
    @if($submitted)
        <div class="text-center py-8">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>
            <h3 class="mt-4 text-lg font-semibold text-gray-900">Thank you!</h3>
            <p class="mt-2 text-gray-600">Your message has been sent successfully. We'll get back to you soon.</p>
            <button wire:click="$set('submitted', false)" class="mt-6 text-sm font-medium text-primary hover:text-primary/80">
                Send another message
            </button>
        </div>
    @else
        <form wire:submit="submit" class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" wire:model="name" id="name"
                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" wire:model="email" id="email"
                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone (optional)</label>
                <input type="tel" wire:model="phone" id="phone"
                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                @error('phone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea wire:model="message" id="message" rows="4"
                          class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary"></textarea>
                @error('message')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="btn-primary w-full rounded-lg px-4 py-3 text-sm font-semibold text-white shadow-sm hover:opacity-90 transition-opacity">
                <span wire:loading.remove>Send Message</span>
                <span wire:loading>Sending...</span>
            </button>
        </form>
    @endif
</div>
