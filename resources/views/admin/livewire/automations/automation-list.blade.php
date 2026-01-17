<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Automations</h1>
        <p class="mt-1 text-sm text-gray-500">AI-powered automation and triggers</p>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-50 p-4 text-sm text-green-700">{{ session('success') }}</div>
    @endif

    <div class="rounded-lg bg-white shadow-sm">
        <div class="border-b border-gray-200 p-4">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search automations..."
                   class="w-64 rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Runs</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($automations as $automation)
                        <tr>
                            <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">{{ $automation->name }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $automation->type }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ number_format($automation->runs_count) }}</td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <button wire:click="toggleStatus({{ $automation->id }})"
                                        class="inline-flex rounded-full px-2 py-0.5 text-xs font-medium {{ $automation->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $automation->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-right">
                                <button wire:click="delete({{ $automation->id }})" wire:confirm="Delete this automation?" class="text-red-600 hover:text-red-800">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">No automations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($automations->hasPages())
            <div class="border-t border-gray-200 px-4 py-3">{{ $automations->links() }}</div>
        @endif
    </div>
</div>
