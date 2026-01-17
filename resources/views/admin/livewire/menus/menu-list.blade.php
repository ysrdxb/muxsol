<div>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Menus</h1>
            <p class="mt-1 text-sm text-gray-500">Manage your website navigation menus</p>
        </div>
        <a href="{{ route('admin.menus.create') }}" wire:navigate
           class="rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary/90">
            Create Menu
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-lg bg-white shadow-sm">
        <div class="border-b border-gray-200 p-4">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search menus..."
                   class="w-full max-w-xs rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Location</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Items</th>
                        <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($menus as $menu)
                        <tr>
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $menu->name }}</div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="inline-flex rounded-full bg-blue-100 px-2 py-0.5 text-xs font-medium text-blue-800">
                                    {{ $menu->location->label() }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                {{ $menu->items_count }} items
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-right">
                                <a href="{{ route('admin.menus.edit', $menu->id) }}" wire:navigate
                                   class="text-primary hover:text-primary/80">Edit</a>
                                <button wire:click="deleteMenu({{ $menu->id }})"
                                        wire:confirm="Are you sure you want to delete this menu?"
                                        class="ml-4 text-red-600 hover:text-red-800">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                No menus found. Create your first menu to get started.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($menus->hasPages())
            <div class="border-t border-gray-200 px-4 py-3">
                {{ $menus->links() }}
            </div>
        @endif
    </div>
</div>
