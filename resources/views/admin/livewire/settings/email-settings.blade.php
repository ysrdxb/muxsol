<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Email Settings</h1>
        <p class="mt-1 text-sm text-gray-500">Configure email sending settings</p>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-lg bg-white p-6 shadow-sm">
        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label class="block text-sm font-medium text-gray-700">Mail Driver</label>
                <select wire:model="mail_driver"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    <option value="smtp">SMTP</option>
                    <option value="mailgun">Mailgun</option>
                    <option value="ses">Amazon SES</option>
                    <option value="postmark">Postmark</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Encryption</label>
                <select wire:model="mail_encryption"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    <option value="tls">TLS</option>
                    <option value="ssl">SSL</option>
                    <option value="">None</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">SMTP Host</label>
                <input type="text" wire:model="mail_host" placeholder="smtp.example.com"
                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">SMTP Port</label>
                <input type="text" wire:model="mail_port" placeholder="587"
                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" wire:model="mail_username"
                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" wire:model="mail_password"
                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">From Address</label>
                <input type="email" wire:model="mail_from_address" placeholder="noreply@example.com"
                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">From Name</label>
                <input type="text" wire:model="mail_from_name" placeholder="My Website"
                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
            </div>
        </div>
    </div>

    <div class="mt-6 flex justify-end">
        <button wire:click="save" class="rounded-lg bg-primary px-6 py-2 text-sm font-medium text-white hover:bg-primary/90">
            Save Changes
        </button>
    </div>
</div>
