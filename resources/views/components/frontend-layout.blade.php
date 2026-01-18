@props(['title' => ''])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} - {{ \App\Models\Setting::get('general.site_name', config('app.name')) }}</title>
    <meta name="description" content="{{ $description ?? \App\Models\Setting::get('general.site_description', '') }}">

    <!-- Google Fonts - Industrial -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- DARK INDUSTRIAL RETRO-TECH CSS -->
    <style>
        :root {
            --midnight: #050B16;
            --onyx: #0A121E;
            --charcoal: #0D1520;
            --border-dark: #1E293B;
            --neon-blue: #006BFF;
            --neon-cyan: #00E5FF;
            --neon-green: #00FF88;
            --text-primary: #FFFFFF;
            --text-muted: #64748B;
            --font-main: 'Inter', sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
        }

        /* GLOBAL RESET - NO ROUNDED CORNERS */
        *, *::before, *::after {
            border-radius: 0 !important;
        }

        body {
            font-family: var(--font-main);
            background: var(--midnight);
            color: var(--text-primary);
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-main);
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: -0.02em;
        }

        /* Section Backgrounds */
        .section-midnight {
            background: var(--midnight);
            border-bottom: 1px solid var(--border-dark);
        }
        .section-onyx {
            background: var(--onyx);
            border-bottom: 1px solid var(--border-dark);
        }

        /* Section Padding */
        .section-padding {
            padding: 100px 0;
        }

        /* RETRO-TECH CARD - Blue Shadow */
        .card-retro {
            background: rgba(255, 255, 255, 0.03);
            border: 2px solid var(--border-dark);
            position: relative;
            transition: all 0.25s ease;
            box-shadow: 8px 8px 0 0 var(--neon-blue);
        }
        .card-retro:hover {
            transform: translate(-4px, -4px);
            box-shadow: 12px 12px 0 0 var(--neon-blue);
            border-color: var(--neon-blue);
        }

        /* RETRO-TECH CARD - Green Shadow Variant */
        .card-retro-green {
            background: rgba(255, 255, 255, 0.03);
            border: 2px solid var(--border-dark);
            position: relative;
            transition: all 0.25s ease;
            box-shadow: 8px 8px 0 0 var(--neon-green);
        }
        .card-retro-green:hover {
            transform: translate(-4px, -4px);
            box-shadow: 12px 12px 0 0 var(--neon-green);
            border-color: var(--neon-green);
        }

        /* Serial Number Tag */
        .serial-tag {
            position: absolute;
            top: 12px;
            right: 12px;
            font-family: var(--font-mono);
            font-size: 10px;
            color: var(--text-muted);
            letter-spacing: 0.1em;
        }

        /* Gradient Text - Blue to Green */
        .text-gradient {
            background: linear-gradient(135deg, var(--neon-blue) 0%, var(--neon-green) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* PHYSICAL-CLICK INDUSTRIAL BUTTONS */
        .btn-physical-click {
            background-color: var(--neon-blue);
            color: white;
            padding: 12px 28px;
            text-decoration: none;
            font-family: var(--font-mono);
            font-weight: 700;
            font-size: 11px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            border: none;
            box-shadow: 4px 4px 0 0 #000;
            transition: all 0.1s;
            display: inline-block;
        }
        .btn-physical-click:hover {
            transform: translate(2px, 2px);
            box-shadow: 0 0 0 0 #000;
            color: white;
        }

        .btn-physical-click-outline {
            background-color: transparent;
            color: white;
            padding: 12px 28px;
            text-decoration: none;
            font-family: var(--font-mono);
            font-weight: 700;
            font-size: 11px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            border: 2px solid var(--border-dark);
            box-shadow: 4px 4px 0 0 #000;
            transition: all 0.1s;
            display: inline-block;
        }
        .btn-physical-click-outline:hover {
            transform: translate(2px, 2px);
            box-shadow: 0 0 0 0 #000;
            border-color: var(--neon-green);
            color: var(--neon-green);
        }

        /* Monospace Labels */
        .mono-label {
            font-family: var(--font-mono);
            font-size: 10px;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        /* Scanline Effect */
        .scanline {
            position: absolute;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--neon-blue);
            opacity: 0.6;
            filter: blur(1px);
            z-index: 0;
        }

        /* Form Inputs - Industrial */
        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.03);
            border: 2px solid var(--border-dark);
            color: var(--text-primary);
            padding: 14px 16px;
            font-family: var(--font-main);
        }
        .form-control:focus, .form-select:focus {
            background: rgba(255, 255, 255, 0.05);
            border-color: var(--neon-blue);
            box-shadow: 0 0 0 3px rgba(0, 107, 255, 0.15);
            color: var(--text-primary);
        }
        .form-control::placeholder {
            color: var(--text-muted);
        }
        .form-select option {
            background: var(--midnight);
            color: var(--text-primary);
        }

        /* DOT-MATRIX LOGO UTILITY */
        .logo-dot-matrix {
            font-family: var(--font-mono);
            font-weight: 800; /* Slightly lighter than 900 for better legibility with masks */
            display: inline-flex;
            gap: 2px;
            text-decoration: none !important;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            letter-spacing: 0.05em;
        }
        .logo-dot-matrix .mux, .logo-dot-matrix .sol {
            mask-image: radial-gradient(circle at center, black 1px, transparent 1.2px);
            -webkit-mask-image: radial-gradient(circle at center, black 1px, transparent 1.2px);
            mask-size: 3px 3px;
            -webkit-mask-size: 3px 3px;
            transition: all 0.4s ease;
        }
        .logo-dot-matrix .mux {
            color: var(--neon-blue);
        }
        .logo-dot-matrix .sol {
            color: var(--neon-green);
        }
        
        /* 'Enlightened' Hover State */
        .logo-dot-matrix:hover {
            transform: scale(1.05);
        }
        .logo-dot-matrix:hover .mux, .logo-dot-matrix:hover .sol {
            mask-image: none;
            -webkit-mask-image: none;
        }
        .logo-dot-matrix:hover .mux {
            color: #4D9FFF;
            text-shadow: 0 0 20px rgba(0, 107, 255, 1), 0 0 40px rgba(0, 107, 255, 0.5);
        }
        .logo-dot-matrix:hover .sol {
            color: #50FFB0;
            text-shadow: 0 0 20px rgba(0, 255, 136, 1), 0 0 40px rgba(0, 255, 136, 0.5);
        }
    </style>

    @livewireStyles
    @stack('styles')
</head>
<body>
    @include('frontend.layouts.header')

    <main>
        {{ $slot }}
    </main>

    @include('frontend.layouts.footer')

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @livewireScripts
    @stack('scripts')
</body>
</html>
