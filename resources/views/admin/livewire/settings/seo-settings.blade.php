<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">SEO Settings</h1>
        <p class="mt-1 text-sm text-gray-500">Configure search engine optimization settings</p>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-6">
        <div class="rounded-lg bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-lg font-semibold text-gray-900">Meta Tags</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Title Suffix</label>
                    <input type="text" wire:model="meta_title_suffix" placeholder=" | Site Name"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    <p class="mt-1 text-xs text-gray-500">Appended to all page titles</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Default Meta Description</label>
                    <textarea wire:model="default_meta_description" rows="3"
                              class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary"></textarea>
                </div>
            </div>
        </div>

        <div class="rounded-lg bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-lg font-semibold text-gray-900">Google Integration</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Google Analytics ID</label>
                    <input type="text" wire:model="google_analytics_id" placeholder="G-XXXXXXXXXX"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Google Search Console Verification</label>
                    <input type="text" wire:model="google_search_console"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                </div>
            </div>
        </div>

        <div class="rounded-lg bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-lg font-semibold text-gray-900">Sitemap</h2>
            <label class="flex items-center">
                <input type="checkbox" wire:model="enable_sitemap"
                       class="rounded border-gray-300 text-primary focus:ring-primary">
                <span class="ml-2 text-sm text-gray-700">Enable automatic sitemap generation</span>
            </label>
        </div>
    </div>

    <div class="mt-6 flex justify-end">
        <button wire:click="save" class="rounded-lg bg-primary px-6 py-2 text-sm font-medium text-white hover:bg-primary/90">
            Save Changes
        </button>
    </div>
</div>
