<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? '' }} - {{ \App\Models\Setting::get('general.site_name', config('app.name')) }}</title>
    <meta name="description" content="{{ $description ?? \App\Models\Setting::get('general.site_description', '') }}">

    <!-- Fonts - Inter for UI, clean and professional -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    @php
        $fontFamily = \App\Models\Setting::get('appearance.font_family', 'Inter');
        $primaryColor = \App\Models\Setting::get('appearance.primary_color', '#6366F1');
        $secondaryColor = \App\Models\Setting::get('appearance.secondary_color', '#10B981');
        $accentColor = \App\Models\Setting::get('appearance.accent_color', '#8B5CF6');
    @endphp
    <link href="https://fonts.bunny.net/css?family={{ strtolower(str_replace(' ', '-', $fontFamily)) }}:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Frontend Design System CSS Variables -->
    <style>
        :root {
            /* Typography */
            --font-sans: '{{ $fontFamily }}', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            --font-mono: 'JetBrains Mono', 'Fira Code', 'Consolas', monospace;

            /* Brand Colors - Dynamic from settings */
            --brand-primary: {{ $primaryColor }};
            --brand-secondary: {{ $secondaryColor }};
            --brand-accent: {{ $accentColor }};

            /* Neutral Palette - The Foundation */
            --gray-50:  #FAFAFA;
            --gray-100: #F4F4F5;
            --gray-200: #E4E4E7;
            --gray-300: #D4D4D8;
            --gray-400: #A1A1AA;
            --gray-500: #71717A;
            --gray-600: #52525B;
            --gray-700: #3F3F46;
            --gray-800: #27272A;
            --gray-900: #18181B;
            --gray-950: #09090B;

            /* Brand Color Scales */
            --brand-50:  #EEF2FF;
            --brand-100: #E0E7FF;
            --brand-200: #C7D2FE;
            --brand-300: #A5B4FC;
            --brand-400: #818CF8;
            --brand-500: var(--brand-primary);
            --brand-600: #4F46E5;
            --brand-700: #4338CA;
            --brand-800: #3730A3;
            --brand-900: #312E81;

            /* Semantic Colors */
            --success: #10B981;
            --warning: #F59E0B;
            --error:   #EF4444;
            --info:    #3B82F6;

            /* Spacing Scale (4px base) */
            --space-1:  4px;
            --space-2:  8px;
            --space-3:  12px;
            --space-4:  16px;
            --space-5:  20px;
            --space-6:  24px;
            --space-8:  32px;
            --space-10: 40px;
            --space-12: 48px;
            --space-16: 64px;
            --space-20: 80px;
            --space-24: 96px;
            --space-32: 128px;

            /* Shadows - Subtle and sophisticated */
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.04);
            --shadow: 0 1px 3px rgba(0, 0, 0, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.05), 0 2px 4px rgba(0, 0, 0, 0.03);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.05), 0 4px 6px rgba(0, 0, 0, 0.03);
            --shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.08), 0 10px 10px rgba(0, 0, 0, 0.04);

            /* Timing Functions */
            --ease-out: cubic-bezier(0.16, 1, 0.3, 1);
            --ease-in-out: cubic-bezier(0.65, 0, 0.35, 1);
            --ease-bounce: cubic-bezier(0.34, 1.56, 0.64, 1);

            /* Duration Scale */
            --duration-fast:   100ms;
            --duration-normal: 200ms;
            --duration-slow:   300ms;
            --duration-slower: 500ms;

            /* Border Radius */
            --radius-sm: 4px;
            --radius-md: 8px;
            --radius-lg: 12px;
            --radius-xl: 16px;
            --radius-full: 9999px;

            /* Z-Index Scale */
            --z-dropdown: 10;
            --z-sticky: 20;
            --z-overlay: 30;
            --z-modal: 40;
            --z-toast: 50;
        }

        /* Base Styles */
        html {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body {
            font-family: var(--font-sans);
            color: var(--gray-800);
            background-color: white;
            line-height: 1.6;
        }

        /* Typography Utilities */
        .text-display { font-size: 4.5rem; font-weight: 700; line-height: 1.1; letter-spacing: -0.02em; }
        .text-h1 { font-size: 3rem; font-weight: 700; line-height: 1.2; letter-spacing: -0.02em; }
        .text-h2 { font-size: 2.25rem; font-weight: 600; line-height: 1.25; letter-spacing: -0.01em; }
        .text-h3 { font-size: 1.5rem; font-weight: 600; line-height: 1.3; }
        .text-h4 { font-size: 1.25rem; font-weight: 600; line-height: 1.4; }
        .text-body-lg { font-size: 1.125rem; font-weight: 400; line-height: 1.6; }
        .text-body { font-size: 1rem; font-weight: 400; line-height: 1.6; }
        .text-small { font-size: 0.875rem; font-weight: 400; line-height: 1.5; }
        .text-xsmall { font-size: 0.75rem; font-weight: 500; line-height: 1.4; }

        /* Color Utilities */
        .text-muted { color: var(--gray-500); }
        .text-secondary { color: var(--gray-600); }
        .text-primary-brand { color: var(--brand-500); }
        .bg-subtle { background-color: var(--gray-50); }

        /* Brand Button Styles */
        .btn-brand {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            font-size: 0.875rem;
            font-weight: 600;
            color: white;
            background-color: var(--brand-primary);
            border: none;
            border-radius: var(--radius-md);
            transition: all var(--duration-normal) var(--ease-out);
            cursor: pointer;
        }
        .btn-brand:hover {
            background-color: var(--brand-600);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }
        .btn-brand:active {
            transform: translateY(0);
        }

        .btn-secondary-brand {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--gray-700);
            background-color: transparent;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-md);
            transition: all var(--duration-normal) var(--ease-out);
            cursor: pointer;
        }
        .btn-secondary-brand:hover {
            background-color: var(--gray-50);
            border-color: var(--gray-300);
        }

        .btn-ghost-brand {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--brand-primary);
            background-color: transparent;
            border: none;
            border-radius: var(--radius-md);
            transition: all var(--duration-normal) var(--ease-out);
            cursor: pointer;
        }
        .btn-ghost-brand:hover {
            background-color: var(--brand-50);
        }

        /* Card Styles */
        .card-modern {
            background: white;
            border-radius: var(--radius-lg);
            border: 1px solid var(--gray-200);
            padding: var(--space-6);
            transition: all var(--duration-normal) var(--ease-out);
        }
        .card-modern:hover {
            border-color: var(--gray-300);
            box-shadow: var(--shadow-md);
        }

        /* Badge Styles */
        .badge-brand {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            font-size: 0.75rem;
            font-weight: 500;
            border-radius: var(--radius-full);
            background-color: var(--brand-50);
            color: var(--brand-600);
        }

        /* Section Spacing */
        .section-hero { padding: 120px 0 160px; }
        .section-standard { padding: 80px 0 96px; }
        .section-compact { padding: 48px 0 64px; }
        .section-cta { padding: 64px 0 80px; }

        /* Container */
        .container-narrow { max-width: 640px; margin: 0 auto; padding: 0 var(--space-4); }
        .container-default { max-width: 1024px; margin: 0 auto; padding: 0 var(--space-4); }
        .container-wide { max-width: 1280px; margin: 0 auto; padding: 0 var(--space-4); }
        .container-full { max-width: 1440px; margin: 0 auto; padding: 0 var(--space-4); }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes float {
            0%, 100% { transform: translate(-50%, -50%) scale(1); }
            50% { transform: translate(-50%, -50%) scale(1.05); }
        }

        @keyframes pulse-soft {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s var(--ease-out) forwards;
        }
        .animate-fade-in {
            animation: fadeIn 0.4s var(--ease-out) forwards;
        }
        .animate-scale-in {
            animation: scaleIn 0.3s var(--ease-out) forwards;
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        /* Delay utilities */
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
        .delay-400 { animation-delay: 400ms; }
        .delay-500 { animation-delay: 500ms; }

        /* Focus States - Accessibility */
        :focus-visible {
            outline: 2px solid var(--brand-primary);
            outline-offset: 2px;
        }

        /* Smooth scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--gray-100);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--gray-300);
            border-radius: var(--radius-full);
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--gray-400);
        }

        /* Selection color */
        ::selection {
            background-color: var(--brand-100);
            color: var(--brand-900);
        }

        /* Link styles */
        a {
            color: inherit;
            text-decoration: none;
        }
        .link-underline {
            color: var(--brand-primary);
            text-decoration: none;
            transition: all var(--duration-fast);
        }
        .link-underline:hover {
            text-decoration: underline;
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, var(--brand-primary) 0%, var(--brand-accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Gradient backgrounds */
        .gradient-subtle {
            background: linear-gradient(180deg, var(--gray-50) 0%, white 100%);
        }
        .gradient-brand {
            background: linear-gradient(135deg, var(--brand-primary) 0%, var(--brand-600) 100%);
        }

        /* Hide element visually but keep accessible */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        /* Responsive typography adjustments */
        @media (max-width: 640px) {
            .text-display { font-size: 2.5rem; }
            .text-h1 { font-size: 2rem; }
            .text-h2 { font-size: 1.75rem; }
            .section-hero { padding: 80px 0 100px; }
            .section-standard { padding: 60px 0 72px; }
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
    @stack('styles')
</head>
<body class="antialiased">
    <!-- Skip to content link for accessibility -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-white focus:rounded-md focus:shadow-lg">
        Skip to content
    </a>

    @include('frontend.layouts.header')

    <main id="main-content">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    @include('frontend.layouts.footer')

    @livewireScripts
    @stack('scripts')
</body>
</html>
