@php
    $headerMenu = \App\Models\Menu::getByLocation('header');
    $siteName = \App\Models\Setting::get('general.site_name', config('app.name'));
    $logo = \App\Models\Setting::get('header.logo');
    $ctaText = \App\Models\Setting::get('header.cta_button_text');
    $ctaUrl = \App\Models\Setting::get('header.cta_button_url');
    $stickyHeader = \App\Models\Setting::get('header.sticky_header', true);
@endphp

<header
    x-data="{
        mobileMenuOpen: false,
        scrolled: false,
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 20;
            });
        }
    }"
    :class="{ 'header-scrolled': scrolled }"
    class="site-header {{ $stickyHeader ? 'sticky top-0 z-50' : '' }}"
>
    <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 lg:h-18 items-center justify-between">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                    @if($logo)
                        <img src="{{ asset('storage/' . $logo) }}" alt="{{ $siteName }}" class="h-8 w-auto transition-transform duration-200 group-hover:scale-105">
                    @else
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-[var(--brand-primary)] to-[var(--brand-accent)] flex items-center justify-center shadow-sm">
                                <span class="text-white font-bold text-sm">{{ strtoupper(substr($siteName, 0, 1)) }}</span>
                            </div>
                            <span class="text-lg font-semibold text-[var(--gray-900)] tracking-tight">{{ $siteName }}</span>
                        </div>
                    @endif
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex lg:items-center lg:gap-1">
                @if($headerMenu)
                    @foreach($headerMenu->items as $item)
                        <a href="{{ $item->url }}"
                           class="nav-link {{ $item->isActive() ? 'nav-link-active' : '' }}"
                           {{ $item->target === '_blank' ? 'target="_blank" rel="noopener noreferrer"' : '' }}>
                            {{ $item->title }}
                        </a>
                    @endforeach
                @endif
            </div>

            <!-- Desktop CTA -->
            <div class="hidden lg:flex lg:items-center lg:gap-4">
                @if($ctaText && $ctaUrl)
                    <a href="{{ $ctaUrl }}" class="header-cta">
                        {{ $ctaText }}
                        <svg class="w-4 h-4 ml-1.5 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                @endif
            </div>

            <!-- Mobile menu button -->
            <button
                type="button"
                @click="mobileMenuOpen = !mobileMenuOpen"
                class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg text-[var(--gray-600)] hover:text-[var(--gray-900)] hover:bg-[var(--gray-100)] transition-colors duration-200"
                :aria-expanded="mobileMenuOpen"
                aria-label="Toggle navigation menu"
            >
                <svg x-show="!mobileMenuOpen" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <svg x-show="mobileMenuOpen" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </nav>

    <!-- Mobile Navigation Overlay -->
    <div
        x-show="mobileMenuOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-40 bg-[var(--gray-900)]/20 backdrop-blur-sm lg:hidden"
        @click="mobileMenuOpen = false"
        x-cloak
    ></div>

    <!-- Mobile Navigation Panel -->
    <div
        x-show="mobileMenuOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-x-full"
        x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-0 translate-x-full"
        class="fixed top-0 right-0 z-50 h-full w-full max-w-sm bg-white shadow-2xl lg:hidden"
        x-cloak
    >
        <div class="flex flex-col h-full">
            <!-- Mobile Header -->
            <div class="flex items-center justify-between px-4 h-16 border-b border-[var(--gray-100)]">
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    @if($logo)
                        <img src="{{ asset('storage/' . $logo) }}" alt="{{ $siteName }}" class="h-7 w-auto">
                    @else
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-[var(--brand-primary)] to-[var(--brand-accent)] flex items-center justify-center">
                                <span class="text-white font-bold text-xs">{{ strtoupper(substr($siteName, 0, 1)) }}</span>
                            </div>
                            <span class="text-base font-semibold text-[var(--gray-900)]">{{ $siteName }}</span>
                        </div>
                    @endif
                </a>
                <button
                    type="button"
                    @click="mobileMenuOpen = false"
                    class="inline-flex items-center justify-center w-10 h-10 rounded-lg text-[var(--gray-500)] hover:text-[var(--gray-700)] hover:bg-[var(--gray-100)] transition-colors"
                >
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu Items -->
            <div class="flex-1 overflow-y-auto py-4 px-4">
                <nav class="space-y-1">
                    @if($headerMenu)
                        @foreach($headerMenu->items as $item)
                            <a href="{{ $item->url }}"
                               @click="mobileMenuOpen = false"
                               class="mobile-nav-link {{ $item->isActive() ? 'mobile-nav-link-active' : '' }}"
                               {{ $item->target === '_blank' ? 'target="_blank" rel="noopener noreferrer"' : '' }}>
                                {{ $item->title }}
                                @if($item->target === '_blank')
                                    <svg class="w-4 h-4 ml-auto text-[var(--gray-400)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                @endif
                            </a>
                        @endforeach
                    @endif
                </nav>
            </div>

            <!-- Mobile CTA -->
            @if($ctaText && $ctaUrl)
                <div class="p-4 border-t border-[var(--gray-100)]">
                    <a href="{{ $ctaUrl }}"
                       @click="mobileMenuOpen = false"
                       class="flex items-center justify-center w-full px-6 py-3 text-sm font-semibold text-white bg-[var(--brand-primary)] rounded-lg hover:bg-[var(--brand-600)] transition-colors duration-200">
                        {{ $ctaText }}
                        <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </div>
</header>

<style>
    /* Header Base Styles */
    .site-header {
        background-color: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-bottom: 1px solid transparent;
        transition: all var(--duration-normal) var(--ease-out);
    }

    .site-header.header-scrolled {
        background-color: rgba(255, 255, 255, 0.95);
        border-bottom-color: var(--gray-200);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    }

    /* Desktop Navigation Links */
    .nav-link {
        display: inline-flex;
        align-items: center;
        padding: 8px 14px;
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--gray-600);
        border-radius: var(--radius-md);
        transition: all var(--duration-fast) var(--ease-out);
    }

    .nav-link:hover {
        color: var(--gray-900);
        background-color: var(--gray-100);
    }

    .nav-link-active {
        color: var(--brand-primary);
        background-color: var(--brand-50);
    }

    .nav-link-active:hover {
        color: var(--brand-600);
        background-color: var(--brand-100);
    }

    /* Header CTA Button */
    .header-cta {
        display: inline-flex;
        align-items: center;
        padding: 10px 20px;
        font-size: 0.875rem;
        font-weight: 600;
        color: white;
        background-color: var(--brand-primary);
        border-radius: var(--radius-md);
        transition: all var(--duration-normal) var(--ease-out);
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .header-cta:hover {
        background-color: var(--brand-600);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
    }

    .header-cta:active {
        transform: translateY(0);
    }

    /* Mobile Navigation Links */
    .mobile-nav-link {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        font-size: 0.9375rem;
        font-weight: 500;
        color: var(--gray-700);
        border-radius: var(--radius-lg);
        transition: all var(--duration-fast) var(--ease-out);
    }

    .mobile-nav-link:hover {
        color: var(--gray-900);
        background-color: var(--gray-50);
    }

    .mobile-nav-link-active {
        color: var(--brand-primary);
        background-color: var(--brand-50);
    }

    /* Adjust header height on larger screens */
    @media (min-width: 1024px) {
        .lg\:h-18 {
            height: 4.5rem;
        }
    }
</style>
