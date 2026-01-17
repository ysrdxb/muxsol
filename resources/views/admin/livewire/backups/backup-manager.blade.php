<div>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Backups</h1>
            <p class="mt-1 text-sm text-gray-500">Manage your website backups</p>
        </div>
        <div class="flex items-center space-x-3">
            <button wire:click="createBackup('database')"
                    wire:loading.attr="disabled"
                    class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50">
                <span wire:loading.remove wire:target="createBackup('database')">Backup Database</span>
                <span wire:loading wire:target="createBackup('database')">Creating...</span>
            </button>
            <button wire:click="createBackup('full')"
                    wire:loading.attr="disabled"
                    class="rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary/90 disabled:opacity-50">
                <span wire:loading.remove wire:target="createBackup('full')">Full Backup</span>
                <span wire:loading wire:target="createBackup('full')">Creating...</span>
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 rounded-lg bg-red-50 p-4 text-sm text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <div class="rounded-lg bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Size</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Created</th>
                        <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($backups as $backup)
                        <tr>
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $backup->name }}</div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-medium
                                    {{ $backup->type === \App\Enums\BackupType::FULL ? 'bg-purple-100 text-purple-800' : '' }}
                                    {{ $backup->type === \App\Enums\BackupType::DATABASE ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $backup->type === \App\Enums\BackupType::FILES ? 'bg-green-100 text-green-800' : '' }}">
                                    {{ $backup->type->label() }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                {{ $backup->human_readable_size }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-medium
                                    {{ $backup->status === \App\Enums\BackupStatus::COMPLETED ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $backup->status === \App\Enums\BackupStatus::PROCESSING ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $backup->status === \App\Enums\BackupStatus::FAILED ? 'bg-red-100 text-red-800' : '' }}
                                    {{ $backup->status === \App\Enums\BackupStatus::PENDING ? 'bg-gray-100 text-gray-800' : '' }}">
                                    {{ $backup->status->label() }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                {{ $backup->created_at->format('M d, Y H:i') }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-right">
                                @if($backup->status === \App\Enums\BackupStatus::COMPLETED)
                                    <button wire:click="downloadBackup({{ $backup->id }})"
                                            class="text-primary hover:text-primary/80">Download</button>
                                @endif
                                <button wire:click="deleteBackup({{ $backup->id }})"
                                        wire:confirm="Are you sure you want to delete this backup?"
                                        class="ml-4 text-red-600 hover:text-red-800">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-semibold text-gray-900">No backups</h3>
                                <p class="mt-1 text-sm text-gray-500">Create your first backup to secure your data.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($backups->hasPages())
            <div class="border-t border-gray-200 px-4 py-3">
                {{ $backups->links() }}
            </div>
        @endif
    </div>
</div>
