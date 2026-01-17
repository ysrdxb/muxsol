<div>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Advertisements</h1>
            <p class="mt-1 text-sm text-gray-500">Manage your website advertisements</p>
        </div>
        <a href="{{ route('admin.advertisements.create') }}" wire:navigate
           class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">
            <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
            </svg>
            Create Ad
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-lg bg-white shadow-sm">
        <div class="border-b border-gray-200 p-4">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search advertisements..."
                   class="w-64 rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Position</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Impressions</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Clicks</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($advertisements as $ad)
                        <tr>
                            <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">{{ $ad->name }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $ad->position->label() }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ number_format($ad->impressions) }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ number_format($ad->clicks) }}</td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <button wire:click="toggleStatus({{ $ad->id }})"
                                        class="inline-flex rounded-full px-2 py-0.5 text-xs font-medium {{ $ad->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $ad->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-right space-x-3">
                                <a href="{{ route('admin.advertisements.edit', $ad->id) }}" wire:navigate
                                   class="text-blue-600 hover:text-blue-800">Edit</a>
                                <button wire:click="delete({{ $ad->id }})" wire:confirm="Delete this advertisement?"
                                        class="text-red-600 hover:text-red-800">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">No advertisements found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($advertisements->hasPages())
            <div class="border-t border-gray-200 px-4 py-3">{{ $advertisements->links() }}</div>
        @endif
    </div>
</div>
