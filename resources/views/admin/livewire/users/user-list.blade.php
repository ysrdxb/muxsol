<div>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Users</h1>
            <p class="mt-1 text-sm text-gray-500">Manage admin users and roles</p>
        </div>
        <a href="{{ route('admin.users.create') }}" wire:navigate
           class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">
            <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
            </svg>
            Add User
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-50 p-4 text-sm text-green-700">{{ session('success') }}</div>
    @endif

    <div class="rounded-lg bg-white shadow-sm">
        <div class="border-b border-gray-200 p-4">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search users..."
                   class="w-64 rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Last Login</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach($users as $user)
                        <tr>
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary text-white font-bold">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="inline-flex rounded-full bg-purple-100 px-2 py-0.5 text-xs font-medium text-purple-800">
                                    {{ $user->role->label() }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                {{ $user->last_login_at?->diffForHumans() ?? 'Never' }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                @if($user->id !== auth()->id())
                                    <button wire:click="toggleStatus({{ $user->id }})"
                                            class="inline-flex rounded-full px-2 py-0.5 text-xs font-medium {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                @else
                                    <span class="inline-flex rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">Active</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-right space-x-3">
                                <a href="{{ route('admin.users.edit', $user->id) }}" wire:navigate
                                   class="text-blue-600 hover:text-blue-800">Edit</a>
                                @if($user->id !== auth()->id())
                                    <button wire:click="delete({{ $user->id }})" wire:confirm="Delete this user?" class="text-red-600 hover:text-red-800">Delete</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div class="border-t border-gray-200 px-4 py-3">{{ $users->links() }}</div>
        @endif
    </div>
</div>
