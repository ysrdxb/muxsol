<div>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $user ? 'Edit User' : 'Create User' }}</h1>
            <p class="mt-1 text-sm text-gray-500">{{ $user ? 'Update user information and permissions' : 'Add a new user to the system' }}</p>
        </div>
        <a href="{{ route('admin.users.index') }}" wire:navigate class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
            <svg class="-ml-0.5 mr-1.5 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z" clip-rule="evenodd" />
            </svg>
            Back to Users
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

    @if (session('error'))
        <div class="mb-6 rounded-md bg-red-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <form wire:submit="save" class="space-y-6">
        <div class="rounded-lg bg-white shadow-sm ring-1 ring-gray-900/5">
            <div class="p-6">
                <h3 class="text-base font-semibold leading-7 text-gray-900">User Information</h3>
                <p class="mt-1 text-sm leading-6 text-gray-500">Basic user details and credentials.</p>

                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                    <!-- Name -->
                    <div class="sm:col-span-3">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Full Name</label>
                        <div class="mt-2">
                            <input type="text" wire:model="name" id="name"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('name') ring-red-300 @enderror">
                        </div>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="sm:col-span-3">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email Address</label>
                        <div class="mt-2">
                            <input type="email" wire:model="email" id="email"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('email') ring-red-300 @enderror">
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="sm:col-span-3">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">
                            {{ $user ? 'New Password (leave blank to keep current)' : 'Password' }}
                        </label>
                        <div class="mt-2">
                            <input type="password" wire:model="password" id="password"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('password') ring-red-300 @enderror">
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="sm:col-span-3">
                        <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirm Password</label>
                        <div class="mt-2">
                            <input type="password" wire:model="password_confirmation" id="password_confirmation"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded-lg bg-white shadow-sm ring-1 ring-gray-900/5">
            <div class="p-6">
                <h3 class="text-base font-semibold leading-7 text-gray-900">Role & Permissions</h3>
                <p class="mt-1 text-sm leading-6 text-gray-500">Define user access level and account status.</p>

                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                    <!-- Role -->
                    <div class="sm:col-span-3">
                        <label for="role" class="block text-sm font-medium leading-6 text-gray-900">Role</label>
                        <div class="mt-2">
                            <select wire:model="role" id="role"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                    {{ $user && $user->id === auth()->id() ? 'disabled' : '' }}>
                                @foreach($roles as $roleOption)
                                    <option value="{{ $roleOption->value }}">{{ $roleOption->label() }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($user && $user->id === auth()->id())
                            <p class="mt-2 text-sm text-gray-500">You cannot change your own role.</p>
                        @endif
                        @error('role')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Active Status -->
                    <div class="sm:col-span-3">
                        <div class="flex items-center h-full pt-6">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" wire:model="is_active" class="sr-only peer"
                                       {{ $user && $user->id === auth()->id() ? 'disabled' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                <span class="ms-3 text-sm font-medium text-gray-900">Account Active</span>
                            </label>
                        </div>
                        @if($user && $user->id === auth()->id())
                            <p class="mt-2 text-sm text-gray-500">You cannot deactivate your own account.</p>
                        @endif
                    </div>
                </div>

                <!-- Role Descriptions -->
                <div class="mt-6 rounded-md bg-gray-50 p-4">
                    <h4 class="text-sm font-medium text-gray-900">Role Permissions</h4>
                    <ul class="mt-2 space-y-1 text-sm text-gray-600">
                        <li><strong>Super Admin:</strong> Full access to all features and settings</li>
                        <li><strong>Admin:</strong> Manage content, users, and most settings</li>
                        <li><strong>Editor:</strong> Create and edit content, manage media</li>
                        <li><strong>Viewer:</strong> View-only access to the admin panel</li>
                    </ul>
                </div>
            </div>
        </div>

        @if($user)
            <div class="rounded-lg bg-white shadow-sm ring-1 ring-gray-900/5">
                <div class="p-6">
                    <h3 class="text-base font-semibold leading-7 text-gray-900">Account Information</h3>
                    <dl class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Created</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('M d, Y H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Last Login</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $user->last_login_at?->format('M d, Y H:i') ?? 'Never' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Last Login IP</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $user->last_login_ip ?? 'N/A' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        @endif

        <!-- Actions -->
        <div class="flex items-center justify-between">
            <div>
                @if($user && $user->id !== auth()->id() && $user->role !== \App\Enums\UserRole::SUPER_ADMIN)
                    <button type="button" wire:click="confirmDelete"
                            class="inline-flex items-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.519.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                        </svg>
                        Delete User
                    </button>
                @endif
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.users.index') }}" wire:navigate
                   class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit"
                        class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                    <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                    </svg>
                    {{ $user ? 'Update User' : 'Create User' }}
                </button>
            </div>
        </div>
    </form>

    <!-- Delete Confirmation Modal -->
    @if($showDeleteModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
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
                            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Delete User</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Are you sure you want to delete this user? This action cannot be undone.</p>
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
