<div>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                {{ $page ? 'Edit Page' : 'Create Page' }}
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                {{ $page ? 'Update page content and settings' : 'Add a new page to your website' }}
            </p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.pages.index') }}" wire:navigate
               class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button wire:click="save"
                    class="rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary/90">
                <span wire:loading.remove wire:target="save">Save Page</span>
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
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Info -->
            <div class="rounded-lg bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-lg font-semibold text-gray-900">Page Details</h2>

                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" wire:model.live="title" id="title"
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                        <div class="mt-1 flex rounded-lg shadow-sm">
                            <span class="inline-flex items-center rounded-l-lg border border-r-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500">
                                {{ url('/') }}/
                            </span>
                            <input type="text" wire:model="slug" id="slug"
                                   class="block w-full rounded-r-lg border-gray-300 focus:border-primary focus:ring-primary">
                        </div>
                        @error('slug')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                        <textarea wire:model="content" id="content" rows="6"
                                  class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary"></textarea>
                    </div>

                    <div>
                        <label for="excerpt" class="block text-sm font-medium text-gray-700">Excerpt</label>
                        <textarea wire:model="excerpt" id="excerpt" rows="2"
                                  class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary"></textarea>
                    </div>
                </div>
            </div>

            <!-- Sections -->
            <div class="rounded-lg bg-white p-6 shadow-sm">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">Page Sections</h2>
                    <button wire:click="$set('showSectionModal', true)"
                            class="rounded-lg bg-primary px-3 py-1.5 text-sm font-medium text-white hover:bg-primary/90">
                        Add Section
                    </button>
                </div>

                @if(count($sections) > 0)
                    <div class="space-y-3">
                        @foreach($sections as $index => $section)
                            <div class="flex items-center justify-between rounded-lg border {{ $section['is_active'] ? 'border-gray-200 bg-gray-50' : 'border-gray-100 bg-gray-100 opacity-60' }} p-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex flex-col space-y-1">
                                        <button wire:click="moveSection({{ $index }}, 'up')" {{ $index === 0 ? 'disabled' : '' }}
                                                class="rounded p-1 text-gray-400 hover:bg-gray-200 hover:text-gray-600 disabled:opacity-30">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                            </svg>
                                        </button>
                                        <button wire:click="moveSection({{ $index }}, 'down')" {{ $index === count($sections) - 1 ? 'disabled' : '' }}
                                                class="rounded p-1 text-gray-400 hover:bg-gray-200 hover:text-gray-600 disabled:opacity-30">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div>
                                        <span class="inline-flex items-center rounded-full bg-primary/10 px-2 py-0.5 text-xs font-medium text-primary">
                                            {{ ucfirst(str_replace('_', ' ', $section['type'])) }}
                                        </span>
                                        <p class="mt-1 font-medium text-gray-900">
                                            {{ $section['title'] ?: 'Untitled Section' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button wire:click="toggleSection({{ $index }})"
                                            class="rounded p-2 text-gray-400 hover:bg-gray-200 hover:text-gray-600">
                                        @if($section['is_active'])
                                            <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        @else
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                            </svg>
                                        @endif
                                    </button>
                                    <button wire:click="editSection({{ $index }})"
                                            class="rounded p-2 text-gray-400 hover:bg-gray-200 hover:text-gray-600">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </button>
                                    <button wire:click="removeSection({{ $index }})"
                                            wire:confirm="Are you sure you want to remove this section?"
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
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        <h3 class="mt-2 text-sm font-semibold text-gray-900">No sections</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by adding a section to this page.</p>
                        <button wire:click="$set('showSectionModal', true)"
                                class="mt-4 rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary/90">
                            Add Section
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Publish -->
            <div class="rounded-lg bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-lg font-semibold text-gray-900">Publish</h2>

                <div class="space-y-4">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select wire:model="status" id="status"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            @foreach($statusOptions as $option)
                                <option value="{{ $option->value }}">{{ $option->label() }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="template" class="block text-sm font-medium text-gray-700">Template</label>
                        <select wire:model="template" id="template"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            <option value="default">Default</option>
                            <option value="home">Homepage</option>
                            <option value="full-width">Full Width</option>
                            <option value="sidebar">With Sidebar</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Featured Image -->
            <div class="rounded-lg bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-lg font-semibold text-gray-900">Featured Image</h2>
                <div class="rounded-lg border-2 border-dashed border-gray-300 p-6 text-center">
                    <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    <p class="mt-2 text-sm text-gray-500">Select from media library</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Type Modal -->
    @if($showSectionModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex min-h-screen items-end justify-center px-4 pb-20 pt-4 text-center sm:block sm:p-0">
                <div wire:click="$set('showSectionModal', false)" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                <div class="inline-block transform overflow-hidden rounded-lg bg-white text-left align-bottom shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-3xl sm:align-middle">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6">
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Add Section</h3>
                            <button wire:click="$set('showSectionModal', false)" class="text-gray-400 hover:text-gray-600">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="grid gap-3 sm:grid-cols-3">
                            @foreach($sectionTypes as $type)
                                <button wire:click="addSection('{{ $type->value }}')"
                                        class="flex flex-col items-center rounded-lg border border-gray-200 p-4 text-center hover:border-primary hover:bg-primary/5 transition-colors">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gray-100 text-gray-600">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6z" />
                                        </svg>
                                    </div>
                                    <span class="mt-2 text-sm font-medium text-gray-900">{{ $type->label() }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Edit Section Modal -->
    @if($editingSectionIndex !== null)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex min-h-screen items-end justify-center px-4 pb-20 pt-4 text-center sm:block sm:p-0">
                <div wire:click="$set('editingSectionIndex', null)" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                <div class="inline-block transform overflow-hidden rounded-lg bg-white text-left align-bottom shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl sm:align-middle">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6">
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Edit Section</h3>
                            <button wire:click="$set('editingSectionIndex', null)" class="text-gray-400 hover:text-gray-600">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Title</label>
                                <input type="text" wire:model="sectionForm.title"
                                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Subtitle</label>
                                <input type="text" wire:model="sectionForm.subtitle"
                                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <button wire:click="$set('editingSectionIndex', null)"
                                    class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Cancel
                            </button>
                            <button wire:click="updateSection"
                                    class="rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary/90">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
