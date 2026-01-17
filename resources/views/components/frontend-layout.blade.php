@props(['title' => ''])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} - {{ \App\Models\Setting::get('general.site_name', config('app.name')) }}</title>
    <meta name="description" content="{{ $description ?? \App\Models\Setting::get('general.site_description', '') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    @php
        $fontFamily = \App\Models\Setting::get('appearance.font_family', 'Inter');
    @endphp
    <link href="https://fonts.bunny.net/css?family={{ strtolower(str_replace(' ', '-', $fontFamily)) }}:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Dynamic CSS Variables -->
    <style>
        :root {
            --color-primary: {{ \App\Models\Setting::get('appearance.primary_color', '#3B82F6') }};
            --color-secondary: {{ \App\Models\Setting::get('appearance.secondary_color', '#10B981') }};
            --color-accent: {{ \App\Models\Setting::get('appearance.accent_color', '#8B5CF6') }};
            --font-family: '{{ $fontFamily }}', sans-serif;
        }
        body { font-family: var(--font-family); }
        .btn-primary { background-color: var(--color-primary); }
        .btn-primary:hover { background-color: color-mix(in srgb, var(--color-primary) 85%, black); }
        .text-primary { color: var(--color-primary); }
        .bg-primary { background-color: var(--color-primary); }
        .border-primary { border-color: var(--color-primary); }
        [x-cloak] { display: none !important; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>
<body class="antialiased bg-white" x-data>
    @include('frontend.layouts.header')

    <main>
        {{ $slot }}
    </main>

    @include('frontend.layouts.footer')

    @livewireScripts
    @stack('scripts')
</body>
</html>
