<div class="space-y-6">
    <!-- Page Header -->
    <div class="md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                Header & Footer Settings
            </h2>
        </div>
    </div>

    <!-- Settings Navigation -->
    <div class="border-b border-gray-200">
        <nav class="-mb-px flex space-x-8 overflow-x-auto">
            <a href="{{ route('admin.settings.index') }}" wire:navigate class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium">
                General
            </a>
            <a href="{{ route('admin.settings.appearance') }}" wire:navigate class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium">
                Appearance
            </a>
            <a href="{{ route('admin.settings.header-footer') }}" wire:navigate class="border-blue-500 text-blue-600 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium">
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

    <div class="space-y-6">
        <!-- Header Settings -->
        <div class="rounded-lg bg-white shadow-sm ring-1 ring-gray-900/5">
            <div class="p-6">
                <h3 class="text-lg font-semibold leading-7 text-gray-900">Header Settings</h3>
                <p class="mt-1 text-sm text-gray-500">Configure how your header appears across the website.</p>

                @if (session('header_success'))
                    <div class="mt-4 rounded-md bg-green-50 p-4">
                        <p class="text-sm font-medium text-green-800">{{ session('header_success') }}</p>
                    </div>
                @endif

                <form wire:submit="saveHeader" class="mt-6 space-y-6">
                    <!-- Logo Section -->
                    <div class="border-b border-gray-200 pb-6">
                        <h4 class="text-sm font-medium text-gray-900 mb-4">Logo</h4>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <!-- Main Logo -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Main Logo (Light Background)</label>
                                @if($logo)
                                    <div class="mb-3 relative inline-block">
                                        <img src="{{ $logo }}" alt="Logo" class="h-12 object-contain bg-gray-100 rounded p-2">
                                        <button type="button" wire:click="removeLogo" class="absolute -top-2 -right-2 rounded-full bg-red-500 p-1 text-white hover:bg-red-600">
                                            <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                        </button>
                                    </div>
                                @endif
                                <input type="file" wire:model="newLogo" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                @error('newLogo') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <!-- Dark Logo -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Dark Logo (Dark Background)</label>
                                @if($logo_dark)
                                    <div class="mb-3 relative inline-block">
                                        <img src="{{ $logo_dark }}" alt="Logo Dark" class="h-12 object-contain bg-gray-800 rounded p-2">
                                        <button type="button" wire:click="removeLogoDark" class="absolute -top-2 -right-2 rounded-full bg-red-500 p-1 text-white hover:bg-red-600">
                                            <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                        </button>
                                    </div>
                                @endif
                                <input type="file" wire:model="newLogoDark" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                @error('newLogoDark') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="logo_height" class="block text-sm font-medium text-gray-700">Logo Height (px)</label>
                            <input type="number" wire:model="logo_height" id="logo_height" min="20" max="100"
                                   class="mt-1 block w-32 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>

                    <!-- Style & Layout -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="header_style" class="block text-sm font-medium text-gray-700">Header Style</label>
                            <select wire:model="header_style" id="header_style" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                @foreach($headerStyles as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="header_menu" class="block text-sm font-medium text-gray-700">Navigation Menu</label>
                            <select wire:model="header_menu" id="header_menu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                <option value="">Select a menu</option>
                                @foreach($menus as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Toggles -->
                    <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                        <label class="flex items-center">
                            <input type="checkbox" wire:model="header_sticky" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Sticky Header</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" wire:model="header_transparent" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Transparent</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" wire:model="header_search_enabled" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Search Icon</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" wire:model="header_social_enabled" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Social Icons</span>
                        </label>
                    </div>

                    <!-- CTA Button -->
                    <div class="border-t border-gray-200 pt-6">
                        <label class="flex items-center mb-4">
                            <input type="checkbox" wire:model.live="header_cta_enabled" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm font-medium text-gray-700">Enable CTA Button</span>
                        </label>

                        @if($header_cta_enabled)
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <div>
                                    <label for="header_cta_text" class="block text-sm font-medium text-gray-700">Button Text</label>
                                    <input type="text" wire:model="header_cta_text" id="header_cta_text"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="header_cta_url" class="block text-sm font-medium text-gray-700">Button URL</label>
                                    <input type="text" wire:model="header_cta_url" id="header_cta_url"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">
                            Save Header Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer Settings -->
        <div class="rounded-lg bg-white shadow-sm ring-1 ring-gray-900/5">
            <div class="p-6">
                <h3 class="text-lg font-semibold leading-7 text-gray-900">Footer Settings</h3>
                <p class="mt-1 text-sm text-gray-500">Configure your website footer content and layout.</p>

                @if (session('footer_success'))
                    <div class="mt-4 rounded-md bg-green-50 p-4">
                        <p class="text-sm font-medium text-green-800">{{ session('footer_success') }}</p>
                    </div>
                @endif

                <form wire:submit="saveFooter" class="mt-6 space-y-6">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                        <div>
                            <label for="footer_style" class="block text-sm font-medium text-gray-700">Footer Style</label>
                            <select wire:model="footer_style" id="footer_style" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                @foreach($footerStyles as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="footer_columns" class="block text-sm font-medium text-gray-700">Number of Columns</label>
                            <select wire:model="footer_columns" id="footer_columns" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                @for($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}">{{ $i }} {{ $i === 1 ? 'Column' : 'Columns' }}</option>
                                @endfor
                            </select>
                        </div>

                        <div>
                            <label for="footer_menu" class="block text-sm font-medium text-gray-700">Footer Menu</label>
                            <select wire:model="footer_menu" id="footer_menu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                <option value="">Select a menu</option>
                                @foreach($menus as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="footer_description" class="block text-sm font-medium text-gray-700">Footer Description</label>
                        <textarea wire:model="footer_description" id="footer_description" rows="3"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                  placeholder="A brief description about your company..."></textarea>
                    </div>

                    <div>
                        <label for="footer_copyright" class="block text-sm font-medium text-gray-700">Copyright Text</label>
                        <input type="text" wire:model="footer_copyright" id="footer_copyright"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>

                    <label class="flex items-center">
                        <input type="checkbox" wire:model="footer_social_enabled" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Show Social Links in Footer</span>
                    </label>

                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">
                            Save Footer Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Social Links -->
        <div class="rounded-lg bg-white shadow-sm ring-1 ring-gray-900/5">
            <div class="p-6">
                <h3 class="text-lg font-semibold leading-7 text-gray-900">Social Links</h3>
                <p class="mt-1 text-sm text-gray-500">Add your social media profile URLs.</p>

                @if (session('social_success'))
                    <div class="mt-4 rounded-md bg-green-50 p-4">
                        <p class="text-sm font-medium text-green-800">{{ session('social_success') }}</p>
                    </div>
                @endif

                <form wire:submit="saveSocial" class="mt-6 space-y-4">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="social_facebook" class="block text-sm font-medium text-gray-700">
                                <span class="flex items-center gap-2">
                                    <svg class="h-4 w-4 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                    Facebook
                                </span>
                            </label>
                            <input type="url" wire:model="social_facebook" id="social_facebook" placeholder="https://facebook.com/..."
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="social_twitter" class="block text-sm font-medium text-gray-700">
                                <span class="flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                    X (Twitter)
                                </span>
                            </label>
                            <input type="url" wire:model="social_twitter" id="social_twitter" placeholder="https://x.com/..."
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="social_instagram" class="block text-sm font-medium text-gray-700">
                                <span class="flex items-center gap-2">
                                    <svg class="h-4 w-4 text-pink-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                    Instagram
                                </span>
                            </label>
                            <input type="url" wire:model="social_instagram" id="social_instagram" placeholder="https://instagram.com/..."
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="social_linkedin" class="block text-sm font-medium text-gray-700">
                                <span class="flex items-center gap-2">
                                    <svg class="h-4 w-4 text-blue-700" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                    LinkedIn
                                </span>
                            </label>
                            <input type="url" wire:model="social_linkedin" id="social_linkedin" placeholder="https://linkedin.com/company/..."
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="social_youtube" class="block text-sm font-medium text-gray-700">
                                <span class="flex items-center gap-2">
                                    <svg class="h-4 w-4 text-red-600" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                    YouTube
                                </span>
                            </label>
                            <input type="url" wire:model="social_youtube" id="social_youtube" placeholder="https://youtube.com/..."
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="social_github" class="block text-sm font-medium text-gray-700">
                                <span class="flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                    GitHub
                                </span>
                            </label>
                            <input type="url" wire:model="social_github" id="social_github" placeholder="https://github.com/..."
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">
                            Save Social Links
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
