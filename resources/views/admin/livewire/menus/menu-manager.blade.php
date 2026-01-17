<div>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                {{ $menu ? 'Edit Menu' : 'Create Menu' }}
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Manage navigation menus for your website
            </p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.menus.index') }}" wire:navigate
               class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button wire:click="save"
                    class="rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary/90">
                <span wire:loading.remove wire:target="save">Save Menu</span>
                <span wire:loading wire:target="save">Saving...</span>
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid gap-6 lg:grid-cols-3">
        <!-- Menu Settings -->
        <div class="space-y-6">
            <div class="rounded-lg bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-lg font-semibold text-gray-900">Menu Settings</h2>

                <div class="space-y-4">
                    <div>
                        <label for="menuName" class="block text-sm font-medium text-gray-700">Menu Name</label>
                        <input type="text" wire:model="menuName" id="menuName"
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        @error('menuName')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="menuLocation" class="block text-sm font-medium text-gray-700">Location</label>
                        <select wire:model="menuLocation" id="menuLocation"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            @foreach($locations as $location)
                                <option value="{{ $location->value }}">{{ $location->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Add Item -->
            <div class="rounded-lg bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-lg font-semibold text-gray-900">Add Item</h2>
                <button wire:click="openAddModal"
                        class="w-full rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary/90">
                    Add Menu Item
                </button>
            </div>
        </div>

        <!-- Menu Items -->
        <div class="lg:col-span-2">
            <div class="rounded-lg bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-lg font-semibold text-gray-900">Menu Items</h2>

                @if(count($menuItems) > 0)
                    <div class="space-y-3">
                        @foreach($menuItems as $index => $item)
                            <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-gray-50 p-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex flex-col space-y-1">
                                        <button wire:click="moveItem({{ $index }}, 'up')" {{ $index === 0 ? 'disabled' : '' }}
                                                class="rounded p-1 text-gray-400 hover:bg-gray-200 hover:text-gray-600 disabled:opacity-30">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                            </svg>
                                        </button>
                                        <button wire:click="moveItem({{ $index }}, 'down')" {{ $index === count($menuItems) - 1 ? 'disabled' : '' }}
                                                class="rounded p-1 text-gray-400 hover:bg-gray-200 hover:text-gray-600 disabled:opacity-30">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $item['title'] }}</p>
                                        <p class="text-sm text-gray-500">
                                            {{ $item['url'] ?? ($item['page_id'] ? 'Page Link' : 'No URL') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button wire:click="editItem({{ $index }})"
                                            class="rounded p-2 text-gray-400 hover:bg-gray-200 hover:text-gray-600">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </button>
                                    <button wire:click="removeItem({{ $index }})"
                                            class="rounded p-2 text-gray-400 hover:bg-red-100 hover:text-red-600">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="rounded-lg border-2 border-dashed border-gray-300 p-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <h3 class="mt-2 text-sm font-semibold text-gray-900">No menu items</h3>
                        <p class="mt-1 text-sm text-gray-500">Add items to build your navigation menu.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Add/Edit Item Modal -->
    @if($showItemModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex min-h-screen items-end justify-center px-4 pb-20 pt-4 text-center sm:block sm:p-0">
                <div wire:click="$set('showItemModal', false)" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                <div class="inline-block transform overflow-hidden rounded-lg bg-white text-left align-bottom shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:align-middle">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6">
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">
                                {{ $editingItemIndex !== null ? 'Edit Menu Item' : 'Add Menu Item' }}
                            </h3>
                            <button wire:click="$set('showItemModal', false)" class="text-gray-400 hover:text-gray-600">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Title</label>
                                <input type="text" wire:model="itemTitle"
                                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                @error('itemTitle')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Link to Page</label>
                                <select wire:model="itemPageId"
                                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                    <option value="">Custom URL</option>
                                    @foreach($pages as $page)
                                        <option value="{{ $page->id }}">{{ $page->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @if(!$itemPageId)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Custom URL</label>
                                    <input type="text" wire:model="itemUrl" placeholder="https:// or /page-slug"
                                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                </div>
                            @endif

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Target</label>
                                <select wire:model="itemTarget"
                                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                    <option value="_self">Same Window</option>
                                    <option value="_blank">New Window</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <button wire:click="$set('showItemModal', false)"
                                    class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Cancel
                            </button>
                            <button wire:click="{{ $editingItemIndex !== null ? 'updateItem' : 'addItem' }}"
                                    class="rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary/90">
                                {{ $editingItemIndex !== null ? 'Update Item' : 'Add Item' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
