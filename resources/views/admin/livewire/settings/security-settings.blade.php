<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Security Settings</h1>
        <p class="mt-1 text-sm text-gray-500">Configure security and access settings</p>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-6">
        <div class="rounded-lg bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-lg font-semibold text-gray-900">Maintenance Mode</h2>
            <div class="space-y-4">
                <label class="flex items-center">
                    <input type="checkbox" wire:model="maintenance_mode"
                           class="rounded border-gray-300 text-primary focus:ring-primary">
                    <span class="ml-2 text-sm text-gray-700">Enable maintenance mode</span>
                </label>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Maintenance Message</label>
                    <textarea wire:model="maintenance_message" rows="2"
                              class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary"></textarea>
                </div>
            </div>
        </div>

        <div class="rounded-lg bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-lg font-semibold text-gray-900">Login Security</h2>
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Max Login Attempts</label>
                    <input type="number" wire:model="login_attempts" min="1" max="10"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Lockout Duration (minutes)</label>
                    <input type="number" wire:model="lockout_duration" min="1" max="60"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 flex justify-end">
        <button wire:click="save" class="rounded-lg bg-primary px-6 py-2 text-sm font-medium text-white hover:bg-primary/90">
            Save Changes
        </button>
    </div>
</div>
