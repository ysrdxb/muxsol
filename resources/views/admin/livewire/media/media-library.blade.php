<div>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Media Library</h1>
            <p class="mt-1 text-sm text-gray-500">Manage your uploaded files and images</p>
        </div>
        <button wire:click="$set('showUploadModal', true)"
                class="rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary/90">
            Upload Files
        </button>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-lg bg-white shadow-sm">
        <!-- Filters -->
        <div class="flex items-center justify-between border-b border-gray-200 p-4">
            <div class="flex items-center space-x-4">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search files..."
                       class="w-64 rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">

                <select wire:model.live="type"
                        class="rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                    <option value="">All Files</option>
                    <option value="images">Images</option>
                    <option value="documents">Documents</option>
                </select>
            </div>
        </div>

        <!-- Media Grid -->
        <div class="p-4">
            @if($media->count() > 0)
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8">
                    @foreach($media as $item)
                        <div wire:click="selectMedia({{ $item->id }})"
                             class="group relative cursor-pointer rounded-lg border border-gray-200 bg-gray-50 p-2 hover:border-primary hover:ring-2 hover:ring-primary/20 transition-all">
                            @if($item->isImage())
                                <div class="aspect-square overflow-hidden rounded">
                                    <img src="{{ $item->url }}" alt="{{ $item->alt_text }}"
                                         class="h-full w-full object-cover">
                                </div>
                            @else
                                <div class="flex aspect-square items-center justify-center rounded bg-gray-100">
                                    <svg class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                </div>
                            @endif
                            <p class="mt-2 truncate text-xs text-gray-600">{{ $item->name }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $media->links() }}
                </div>
            @else
                <div class="py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-semibold text-gray-900">No files</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by uploading files.</p>
                    <button wire:click="$set('showUploadModal', true)"
                            class="mt-4 rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary/90">
                        Upload Files
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Upload Modal -->
    @if($showUploadModal)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex min-h-screen items-end justify-center px-4 pb-20 pt-4 text-center sm:block sm:p-0">
                <div wire:click="$set('showUploadModal', false)" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                <div class="inline-block transform overflow-hidden rounded-lg bg-white text-left align-bottom shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:align-middle">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6">
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Upload Files</h3>
                            <button wire:click="$set('showUploadModal', false)" class="text-gray-400 hover:text-gray-600">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="rounded-lg border-2 border-dashed border-gray-300 p-8 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-600">Drag and drop files here, or click to browse</p>
                            <input type="file" wire:model="files" multiple
                                   class="absolute inset-0 h-full w-full cursor-pointer opacity-0"
                                   accept="image/*,.pdf,.doc,.docx,.xls,.xlsx,.zip">
                        </div>

                        <div wire:loading wire:target="files" class="mt-4 text-center text-sm text-gray-600">
                            Uploading...
                        </div>

                        @error('files.*')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Details Modal -->
    @if($showDetailsModal && $selectedMedia)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex min-h-screen items-end justify-center px-4 pb-20 pt-4 text-center sm:block sm:p-0">
                <div wire:click="$set('showDetailsModal', false)" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                <div class="inline-block transform overflow-hidden rounded-lg bg-white text-left align-bottom shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl sm:align-middle">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6">
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Media Details</h3>
                            <button wire:click="$set('showDetailsModal', false)" class="text-gray-400 hover:text-gray-600">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="grid gap-6 sm:grid-cols-2">
                            <div>
                                @if($selectedMedia->isImage())
                                    <img src="{{ $selectedMedia->url }}" alt="{{ $selectedMedia->alt_text }}"
                                         class="w-full rounded-lg">
                                @else
                                    <div class="flex aspect-video items-center justify-center rounded-lg bg-gray-100">
                                        <svg class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">File Name</label>
                                    <p class="mt-1 text-sm text-gray-600">{{ $selectedMedia->file_name }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">File Size</label>
                                    <p class="mt-1 text-sm text-gray-600">{{ $selectedMedia->human_readable_size }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">URL</label>
                                    <input type="text" value="{{ $selectedMedia->url }}" readonly
                                           class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 text-sm">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Alt Text</label>
                                    <input type="text" wire:model="altText"
                                           class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Caption</label>
                                    <textarea wire:model="caption" rows="2"
                                              class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-between">
                            <button wire:click="deleteMedia"
                                    wire:confirm="Are you sure you want to delete this file?"
                                    class="rounded-lg border border-red-300 px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50">
                                Delete
                            </button>
                            <div class="flex space-x-3">
                                <button wire:click="$set('showDetailsModal', false)"
                                        class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    Cancel
                                </button>
                                <button wire:click="updateMedia"
                                        class="rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary/90">
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
