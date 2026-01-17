<header class="admin-header sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 px-4 sm:gap-x-6 sm:px-6 lg:px-8">
    <!-- Mobile menu button -->
    <button type="button" class="header-action-btn lg:hidden" @click="sidebarOpen = true">
        <span class="sr-only">Open sidebar</span>
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>

    <!-- Separator -->
    <div class="h-6 w-px bg-gray-200 lg:hidden" aria-hidden="true"></div>

    <div class="flex flex-1 items-center gap-x-4 lg:gap-x-6">
        <!-- Search -->
        <div class="admin-search">
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
            </svg>
            <input type="search" placeholder="Search pages, settings..." class="w-full">
            <kbd class="hidden sm:inline-flex items-center gap-1 rounded bg-gray-200 px-1.5 py-0.5 text-[10px] font-medium text-gray-500">
                <span class="text-xs">⌘</span>K
            </kbd>
        </div>

        <div class="flex flex-1 justify-end items-center gap-x-2 lg:gap-x-4">
            <!-- Notifications -->
            <button type="button" class="header-action-btn relative">
                <span class="sr-only">View notifications</span>
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                </svg>
                {{-- Notification badge - uncomment when needed --}}
                {{-- <span class="notification-badge"></span> --}}
            </button>

            <!-- View Site Button -->
            <a href="{{ url('/') }}" target="_blank"
               class="hidden sm:inline-flex items-center gap-x-1.5 rounded-lg bg-gray-100 px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-200 transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                </svg>
                View Site
            </a>

            <!-- Separator -->
            <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-200" aria-hidden="true"></div>

            <!-- Profile dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button type="button"
                        class="flex items-center gap-x-2 rounded-lg p-1.5 hover:bg-gray-100 transition-colors"
                        @click="open = !open"
                        @click.away="open = false">
                    <span class="sr-only">Open user menu</span>
                    @if(auth()->user()->avatar_url && !str_contains(auth()->user()->avatar_url, 'ui-avatars'))
                        <img class="h-8 w-8 rounded-full object-cover ring-2 ring-white"
                             src="{{ auth()->user()->avatar_url }}"
                             alt="{{ auth()->user()->name }}">
                    @else
                        <div class="user-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                    @endif
                    <span class="hidden lg:flex lg:items-center">
                        <span class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                        <svg class="ml-1 h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>

                <div x-show="open"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-xl bg-white shadow-lg ring-1 ring-black/5 focus:outline-none overflow-hidden"
                     x-cloak>
                    <!-- User info header -->
                    <div class="px-4 py-3 bg-gray-50 border-b border-gray-100">
                        <div class="flex items-center gap-3">
                            @if(auth()->user()->avatar_url && !str_contains(auth()->user()->avatar_url, 'ui-avatars'))
                                <img class="h-10 w-10 rounded-full object-cover"
                                     src="{{ auth()->user()->avatar_url }}"
                                     alt="{{ auth()->user()->name }}">
                            @else
                                <div class="user-avatar" style="width: 2.5rem; height: 2.5rem;">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <div class="mt-2">
                            <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium bg-blue-50 text-blue-700">
                                {{ auth()->user()->role->label() }}
                            </span>
                        </div>
                    </div>

                    <!-- Menu items -->
                    <div class="py-1">
                        <a href="{{ route('admin.settings.index') }}"
                           class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Settings
                        </a>
                        <a href="{{ route('admin.activity-log.index') }}"
                           class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Activity Log
                        </a>
                    </div>

                    <!-- Sign out -->
                    <div class="border-t border-gray-100">
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit"
                                    class="flex w-full items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                                Sign out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
