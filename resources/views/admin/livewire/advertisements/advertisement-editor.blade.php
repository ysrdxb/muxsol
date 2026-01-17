<div>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $advertisement ? 'Edit Advertisement' : 'Create Advertisement' }}</h1>
            <p class="mt-1 text-sm text-gray-500">{{ $advertisement ? 'Update advertisement settings' : 'Create a new advertisement' }}</p>
        </div>
        <a href="{{ route('admin.advertisements.index') }}" wire:navigate class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
            <svg class="-ml-0.5 mr-1.5 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z" clip-rule="evenodd" />
            </svg>
            Back to Ads
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-md bg-green-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <form wire:submit="save" class="space-y-6">
        <div class="rounded-lg bg-white shadow-sm ring-1 ring-gray-900/5">
            <div class="p-6">
                <h3 class="text-base font-semibold leading-7 text-gray-900">Advertisement Details</h3>
                <p class="mt-1 text-sm leading-6 text-gray-500">Basic advertisement information.</p>

                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                    <!-- Name -->
                    <div class="sm:col-span-4">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                        <div class="mt-2">
                            <input type="text" wire:model="name" id="name"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('name') ring-red-300 @enderror"
                                   placeholder="e.g., Homepage Banner">
                        </div>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Position -->
                    <div class="sm:col-span-3">
                        <label for="position" class="block text-sm font-medium leading-6 text-gray-900">Position</label>
                        <div class="mt-2">
                            <select wire:model="position" id="position"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                @foreach($positions as $pos)
                                    <option value="{{ $pos->value }}">{{ $pos->label() }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('position')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Type -->
                    <div class="sm:col-span-3">
                        <label for="type" class="block text-sm font-medium leading-6 text-gray-900">Type</label>
                        <div class="mt-2">
                            <select wire:model.live="type" id="type"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                @foreach($types as $t)
                                    <option value="{{ $t->value }}">{{ $t->label() }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('type')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- URL -->
                    <div class="sm:col-span-6">
                        <label for="url" class="block text-sm font-medium leading-6 text-gray-900">Click URL (optional)</label>
                        <div class="mt-2">
                            <input type="url" wire:model="url" id="url"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                   placeholder="https://example.com/landing-page">
                        </div>
                        @error('url')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="rounded-lg bg-white shadow-sm ring-1 ring-gray-900/5">
            <div class="p-6">
                <h3 class="text-base font-semibold leading-7 text-gray-900">Advertisement Content</h3>
                <p class="mt-1 text-sm leading-6 text-gray-500">
                    @if($type === 'image')
                        Upload an image for this advertisement.
                    @elseif($type === 'html')
                        Enter HTML code for this advertisement.
                    @else
                        Enter a script/embed code for this advertisement.
                    @endif
                </p>

                <div class="mt-6">
                    @if($type === 'image')
                        <!-- Image Upload -->
                        <div>
                            @if($currentImage || $image)
                                <div class="mb-4">
                                    <p class="text-sm font-medium text-gray-700 mb-2">Current Image:</p>
                                    <div class="relative inline-block">
                                        @if($image)
                                            <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="max-w-md rounded-lg shadow">
                                        @else
                                            <img src="{{ $currentImage }}" alt="Current" class="max-w-md rounded-lg shadow">
                                        @endif
                                        <button type="button" wire:click="removeImage"
                                                class="absolute -top-2 -right-2 rounded-full bg-red-500 p-1 text-white hover:bg-red-600">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endif

                            <label class="block">
                                <span class="sr-only">Choose image</span>
                                <input type="file" wire:model="image" accept="image/*"
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            </label>
                            <p class="mt-2 text-sm text-gray-500">PNG, JPG, GIF up to 2MB</p>
                            @error('image')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @elseif($type === 'html')
                        <!-- HTML Content -->
                        <div>
                            <label for="content" class="block text-sm font-medium leading-6 text-gray-900">HTML Code</label>
                            <div class="mt-2">
                                <textarea wire:model="content" id="content" rows="10"
                                          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 font-mono"
                                          placeholder="<div class='ad-banner'>...</div>"></textarea>
                            </div>
                            @error('content')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @else
                        <!-- Script Content -->
                        <div>
                            <label for="content" class="block text-sm font-medium leading-6 text-gray-900">Script/Embed Code</label>
                            <div class="mt-2">
                                <textarea wire:model="content" id="content" rows="10"
                                          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 font-mono"
                                          placeholder="<script>...</script>"></textarea>
                            </div>
                            <p class="mt-2 text-sm text-yellow-600">
                                <svg class="inline h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                </svg>
                                Only use scripts from trusted sources.
                            </p>
                            @error('content')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Schedule Section -->
        <div class="rounded-lg bg-white shadow-sm ring-1 ring-gray-900/5">
            <div class="p-6">
                <h3 class="text-base font-semibold leading-7 text-gray-900">Schedule & Status</h3>
                <p class="mt-1 text-sm leading-6 text-gray-500">Set when this advertisement should be displayed.</p>

                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                    <!-- Start Date -->
                    <div class="sm:col-span-2">
                        <label for="start_date" class="block text-sm font-medium leading-6 text-gray-900">Start Date</label>
                        <div class="mt-2">
                            <input type="date" wire:model="start_date" id="start_date"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('start_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- End Date -->
                    <div class="sm:col-span-2">
                        <label for="end_date" class="block text-sm font-medium leading-6 text-gray-900">End Date</label>
                        <div class="mt-2">
                            <input type="date" wire:model="end_date" id="end_date"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('end_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Active Status -->
                    <div class="sm:col-span-2">
                        <div class="flex items-center h-full pt-6">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" wire:model="is_active" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                <span class="ms-3 text-sm font-medium text-gray-900">Active</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($advertisement)
            <!-- Stats Section -->
            <div class="rounded-lg bg-white shadow-sm ring-1 ring-gray-900/5">
                <div class="p-6">
                    <h3 class="text-base font-semibold leading-7 text-gray-900">Performance</h3>
                    <dl class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-4">
                        <div class="rounded-lg bg-gray-50 p-4">
                            <dt class="text-sm font-medium text-gray-500">Impressions</dt>
                            <dd class="mt-1 text-2xl font-semibold text-gray-900">{{ number_format($advertisement->impressions) }}</dd>
                        </div>
                        <div class="rounded-lg bg-gray-50 p-4">
                            <dt class="text-sm font-medium text-gray-500">Clicks</dt>
                            <dd class="mt-1 text-2xl font-semibold text-gray-900">{{ number_format($advertisement->clicks) }}</dd>
                        </div>
                        <div class="rounded-lg bg-gray-50 p-4">
                            <dt class="text-sm font-medium text-gray-500">CTR</dt>
                            <dd class="mt-1 text-2xl font-semibold text-gray-900">
                                {{ $advertisement->impressions > 0 ? number_format(($advertisement->clicks / $advertisement->impressions) * 100, 2) : 0 }}%
                            </dd>
                        </div>
                        <div class="rounded-lg bg-gray-50 p-4">
                            <dt class="text-sm font-medium text-gray-500">Created</dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-900">{{ $advertisement->created_at->format('M d, Y') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        @endif

        <!-- Actions -->
        <div class="flex items-center justify-between">
            <div>
                @if($advertisement)
                    <button type="button" wire:click="confirmDelete"
                            class="inline-flex items-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.519.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                        </svg>
                        Delete
                    </button>
                @endif
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.advertisements.index') }}" wire:navigate
                   class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit"
                        class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                    <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                    </svg>
                    {{ $advertisement ? 'Update' : 'Create' }} Advertisement
                </button>
            </div>
        </div>
    </form>

    <!-- Delete Modal -->
    @if($showDeleteModal)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="$set('showDeleteModal', false)"></div>
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-base font-semibold leading-6 text-gray-900">Delete Advertisement</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Are you sure you want to delete this advertisement? This action cannot be undone.</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                        <button type="button" wire:click="delete"
                                class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">
                            Delete
                        </button>
                        <button type="button" wire:click="$set('showDeleteModal', false)"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
