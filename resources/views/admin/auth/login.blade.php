<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - {{ config('app.name', 'Muxsol') }} Admin</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
    <div class="flex min-h-full">
        <!-- Left Side - Branding -->
        <div class="hidden lg:flex lg:w-1/2 flex-col justify-center items-center p-12 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 to-purple-600/20"></div>
            <div class="absolute top-0 left-0 w-96 h-96 bg-blue-500/30 rounded-full filter blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-purple-500/30 rounded-full filter blur-3xl translate-x-1/2 translate-y-1/2"></div>

            <div class="relative z-10 text-center">
                <div class="flex items-center justify-center mb-8">
                    <span class="text-5xl font-bold text-white">Muxsol</span>
                </div>
                <h1 class="text-3xl font-bold text-white mb-4">Welcome Back</h1>
                <p class="text-lg text-gray-300 max-w-md">
                    Access your powerful admin dashboard to manage your website, content, and business operations.
                </p>

                <div class="mt-12 grid grid-cols-3 gap-6 text-center">
                    <div class="p-4 rounded-xl bg-white/10 backdrop-blur-sm">
                        <div class="text-2xl font-bold text-white">100%</div>
                        <div class="text-sm text-gray-400">Control</div>
                    </div>
                    <div class="p-4 rounded-xl bg-white/10 backdrop-blur-sm">
                        <div class="text-2xl font-bold text-white">24/7</div>
                        <div class="text-sm text-gray-400">Access</div>
                    </div>
                    <div class="p-4 rounded-xl bg-white/10 backdrop-blur-sm">
                        <div class="text-2xl font-bold text-white">Fast</div>
                        <div class="text-sm text-gray-400">Performance</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:max-w-md">
                <div class="lg:hidden flex items-center justify-center mb-8">
                    <span class="text-3xl font-bold text-white">Muxsol</span>
                    <span class="ml-2 rounded-lg bg-blue-600 px-2 py-1 text-xs font-semibold text-white">ADMIN</span>
                </div>

                <div class="bg-white/10 backdrop-blur-xl rounded-2xl shadow-2xl p-8 border border-white/20">
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-white">Sign In</h2>
                        <p class="mt-2 text-sm text-gray-400">Enter your credentials to access the admin panel</p>
                    </div>

                    @if (session('error'))
                        <div class="mb-6 rounded-lg bg-red-500/20 border border-red-500/50 p-4">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-red-400 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                </svg>
                                <p class="text-sm text-red-300">{{ session('error') }}</p>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 rounded-lg bg-red-500/20 border border-red-500/50 p-4">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-red-400 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                </svg>
                                <p class="text-sm text-red-300">{{ $errors->first() }}</p>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                </div>
                                <input id="email" name="email" type="email" autocomplete="email" required
                                       value="{{ old('email') }}"
                                       class="block w-full pl-10 pr-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                       placeholder="admin@muxsol.com">
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                    </svg>
                                </div>
                                <input id="password" name="password" type="password" autocomplete="current-password" required
                                       class="block w-full pl-10 pr-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                       placeholder="Enter your password">
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <input id="remember" name="remember" type="checkbox"
                                       class="h-4 w-4 rounded border-gray-600 bg-white/5 text-blue-600 focus:ring-blue-500 focus:ring-offset-0">
                                <span class="ml-2 text-sm text-gray-400">Remember me</span>
                            </label>
                        </div>

                        <button type="submit"
                                class="w-full flex justify-center items-center py-3 px-4 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-lg shadow-blue-500/25">
                            <span>Sign In</span>
                            <svg class="ml-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </button>
                    </form>
                </div>

                <p class="mt-8 text-center text-sm text-gray-500">
                    &copy; {{ date('Y') }} Muxsol. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
