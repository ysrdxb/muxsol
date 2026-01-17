<div class="space-y-6">
    <!-- Page Header -->
    <div class="md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                General Settings
            </h2>
        </div>
    </div>

    <!-- Settings Navigation -->
    <div class="border-b border-gray-200">
        <nav class="-mb-px flex space-x-8 overflow-x-auto">
            <a href="{{ route('admin.settings.index') }}" wire:navigate class="border-blue-500 text-blue-600 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium">
                General
            </a>
            <a href="{{ route('admin.settings.appearance') }}" wire:navigate class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium">
                Appearance
            </a>
            <a href="{{ route('admin.settings.header-footer') }}" wire:navigate class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium">
                Header & Footer
            </a>
            <a href="{{ route('admin.settings.seo') }}" wire:navigate class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium">
                SEO
            </a>
            <a href="{{ route('admin.settings.security') }}" wire:navigate class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium">
                Security
            </a>
            <a href="{{ route('admin.settings.email') }}" wire:navigate class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium">
                Email
            </a>
        </nav>
    </div>

    <form wire:submit="save" class="space-y-6">
        <!-- Site Information -->
        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-base font-semibold leading-6 text-gray-900">Site Information</h3>
                <p class="mt-1 text-sm text-gray-500">Basic information about your website.</p>

                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="site_name" class="block text-sm font-medium leading-6 text-gray-900">Site Name</label>
                        <div class="mt-2">
                            <input type="text" wire:model="site_name" id="site_name"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('site_name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-4">
                        <label for="site_tagline" class="block text-sm font-medium leading-6 text-gray-900">Tagline</label>
                        <div class="mt-2">
                            <input type="text" wire:model="site_tagline" id="site_tagline"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="site_description" class="block text-sm font-medium leading-6 text-gray-900">Site Description</label>
                        <div class="mt-2">
                            <textarea wire:model="site_description" id="site_description" rows="3"
                                      class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="admin_email" class="block text-sm font-medium leading-6 text-gray-900">Admin Email</label>
                        <div class="mt-2">
                            <input type="email" wire:model="admin_email" id="admin_email"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Date & Time Settings -->
        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-base font-semibold leading-6 text-gray-900">Date & Time</h3>
                <p class="mt-1 text-sm text-gray-500">Configure timezone and date/time formats.</p>

                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="timezone" class="block text-sm font-medium leading-6 text-gray-900">Timezone</label>
                        <div class="mt-2">
                            <select wire:model="timezone" id="timezone"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                @foreach($timezones as $tz)
                                    <option value="{{ $tz }}">{{ $tz }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="date_format" class="block text-sm font-medium leading-6 text-gray-900">Date Format</label>
                        <div class="mt-2">
                            <select wire:model="date_format" id="date_format"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                <option value="M d, Y">Jan 01, 2024</option>
                                <option value="d M Y">01 Jan 2024</option>
                                <option value="Y-m-d">2024-01-01</option>
                                <option value="d/m/Y">01/01/2024</option>
                                <option value="m/d/Y">01/01/2024</option>
                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="time_format" class="block text-sm font-medium leading-6 text-gray-900">Time Format</label>
                        <div class="mt-2">
                            <select wire:model="time_format" id="time_format"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                <option value="h:i A">12:00 PM</option>
                                <option value="H:i">14:00</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Site Options -->
        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-base font-semibold leading-6 text-gray-900">Site Options</h3>
                <p class="mt-1 text-sm text-gray-500">Control site-wide features.</p>

                <div class="mt-6 space-y-6">
                    <div class="relative flex items-start">
                        <div class="flex h-6 items-center">
                            <input type="checkbox" wire:model="maintenance_mode" id="maintenance_mode"
                                   class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-600">
                        </div>
                        <div class="ml-3 text-sm leading-6">
                            <label for="maintenance_mode" class="font-medium text-gray-900">Maintenance Mode</label>
                            <p class="text-gray-500">When enabled, visitors will see a maintenance page. Admins can still access the site.</p>
                        </div>
                    </div>

                    <div class="relative flex items-start">
                        <div class="flex h-6 items-center">
                            <input type="checkbox" wire:model="enable_analytics" id="enable_analytics"
                                   class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-600">
                        </div>
                        <div class="ml-3 text-sm leading-6">
                            <label for="enable_analytics" class="font-medium text-gray-900">Enable Analytics</label>
                            <p class="text-gray-500">Track page views and visitor statistics.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="flex justify-end">
            <button type="submit"
                    class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Save Settings
            </button>
        </div>
    </form>
</div>
