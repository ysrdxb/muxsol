<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Appearance Settings</h1>
        <p class="mt-1 text-sm text-gray-500">Customize your website's look and feel</p>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid gap-6 lg:grid-cols-2">
        <!-- Colors -->
        <div class="rounded-lg bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-lg font-semibold text-gray-900">Colors</h2>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Primary Color</label>
                    <div class="mt-1 flex items-center space-x-3">
                        <input type="color" wire:model.live="primary_color"
                               class="h-10 w-14 cursor-pointer rounded border border-gray-300">
                        <input type="text" wire:model.live="primary_color"
                               class="block w-32 rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Secondary Color</label>
                    <div class="mt-1 flex items-center space-x-3">
                        <input type="color" wire:model.live="secondary_color"
                               class="h-10 w-14 cursor-pointer rounded border border-gray-300">
                        <input type="text" wire:model.live="secondary_color"
                               class="block w-32 rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Accent Color</label>
                    <div class="mt-1 flex items-center space-x-3">
                        <input type="color" wire:model.live="accent_color"
                               class="h-10 w-14 cursor-pointer rounded border border-gray-300">
                        <input type="text" wire:model.live="accent_color"
                               class="block w-32 rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                    </div>
                </div>
            </div>
        </div>

        <!-- Typography -->
        <div class="rounded-lg bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-lg font-semibold text-gray-900">Typography</h2>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Body Font</label>
                    <select wire:model.live="font_family"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        @foreach($fonts as $font)
                            <option value="{{ $font }}">{{ $font }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Heading Font</label>
                    <select wire:model.live="heading_font"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                        @foreach($fonts as $font)
                            <option value="{{ $font }}">{{ $font }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Body Font Size (px)</label>
                        <input type="number" wire:model.live="body_font_size" min="12" max="24"
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Heading Font Size (px)</label>
                        <input type="number" wire:model.live="heading_font_size" min="24" max="64"
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                </div>
            </div>
        </div>

        <!-- Preview -->
        <div class="lg:col-span-2 rounded-lg bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-lg font-semibold text-gray-900">Preview</h2>

            <div class="rounded-lg border border-gray-200 p-6" style="font-family: '{{ $font_family }}', sans-serif;">
                <h3 class="text-2xl font-bold" style="font-family: '{{ $heading_font }}', sans-serif; font-size: {{ $heading_font_size }}px; color: {{ $primary_color }};">
                    Sample Heading
                </h3>
                <p class="mt-4 text-gray-600" style="font-size: {{ $body_font_size }}px;">
                    This is sample body text to preview how your content will look with the selected typography settings.
                    The font family is {{ $font_family }} and the body text size is {{ $body_font_size }}px.
                </p>
                <div class="mt-6 flex space-x-4">
                    <button class="rounded-lg px-4 py-2 text-sm font-medium text-white" style="background-color: {{ $primary_color }};">
                        Primary Button
                    </button>
                    <button class="rounded-lg px-4 py-2 text-sm font-medium text-white" style="background-color: {{ $secondary_color }};">
                        Secondary Button
                    </button>
                    <button class="rounded-lg px-4 py-2 text-sm font-medium text-white" style="background-color: {{ $accent_color }};">
                        Accent Button
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 flex justify-end">
        <button wire:click="save"
                class="rounded-lg bg-primary px-6 py-2 text-sm font-medium text-white hover:bg-primary/90">
            <span wire:loading.remove wire:target="save">Save Changes</span>
            <span wire:loading wire:target="save">Saving...</span>
        </button>
    </div>
</div>
