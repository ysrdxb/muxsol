<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? '' }} - {{ \App\Models\Setting::get('general.site_name', config('app.name')) }}</title>
    <meta name="description" content="{{ $description ?? \App\Models\Setting::get('general.site_description', '') }}">

    <!-- Fonts - Inter for UI, Playfair Display for headlines -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    @php
        $fontFamily = \App\Models\Setting::get('appearance.font_family', 'Inter');
        $primaryColor = \App\Models\Setting::get('appearance.primary_color', '#6366F1');
        $secondaryColor = \App\Models\Setting::get('appearance.secondary_color', '#10B981');
        $accentColor = \App\Models\Setting::get('appearance.accent_color', '#8B5CF6');
    @endphp
    <link href="https://fonts.bunny.net/css?family={{ strtolower(str_replace(' ', '-', $fontFamily)) }}:400,500,600,700|playfair-display:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Frontend Design System CSS Variables -->
    <style>
        :root {
            /* Typography */
            --font-sans: '{{ $fontFamily }}', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            --font-serif: 'Playfair Display', Georgia, 'Times New Roman', serif;
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

            /* Warm Color Palette - Inspired by Aetherfield */
            --color-cream: #FEF3C7;
            --color-sand: #FDE68A;
            --color-warm-white: #FFFBEB;
            --color-soft-blue: #E0F2FE;
            --color-dark-button: #18181B;

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

        /* Serif Typography - Elegant Headlines */
        .text-serif { font-family: var(--font-serif); }
        .text-serif-display { font-family: var(--font-serif); font-size: 4.5rem; font-weight: 600; line-height: 1.1; letter-spacing: -0.01em; }
        .text-serif-h1 { font-family: var(--font-serif); font-size: 3.5rem; font-weight: 600; line-height: 1.15; letter-spacing: -0.01em; }
        .text-serif-h2 { font-family: var(--font-serif); font-size: 2.5rem; font-weight: 600; line-height: 1.2; letter-spacing: -0.01em; }
        .text-serif-h3 { font-family: var(--font-serif); font-size: 1.875rem; font-weight: 500; line-height: 1.25; }

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

        /* Dark Button - Aetherfield Style */
        .btn-dark {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            font-size: 0.875rem;
            font-weight: 600;
            color: white;
            background-color: var(--color-dark-button);
            border: none;
            border-radius: var(--radius-md);
            transition: all var(--duration-normal) var(--ease-out);
            cursor: pointer;
        }
        .btn-dark:hover {
            background-color: var(--gray-800);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }
        .btn-dark:active {
            transform: translateY(0);
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
        /* Soft warm gradient - Aetherfield inspired */
        .gradient-soft {
            background: linear-gradient(135deg, var(--color-soft-blue) 0%, var(--color-cream) 100%);
        }
        .gradient-warm {
            background: linear-gradient(180deg, var(--color-warm-white) 0%, white 100%);
        }
        .gradient-cream {
            background: linear-gradient(180deg, var(--color-cream) 0%, var(--color-warm-white) 100%);
        }
        /* Background utilities */
        .bg-cream { background-color: var(--color-cream); }
        .bg-warm-white { background-color: var(--color-warm-white); }
        .bg-soft-blue { background-color: var(--color-soft-blue); }

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

        /* ================================================================
           HERO SECTION STYLES
           ================================================================ */
        .hero-section {
            min-height: 85vh;
            display: flex;
            align-items: center;
            padding: 120px 0 140px;
            position: relative;
            overflow: hidden;
        }

        /* Gradient Background */
        .hero-gradient-bg {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, var(--gray-50) 0%, white 50%, var(--gray-50) 100%);
            overflow: hidden;
        }

        /* Soft Gradient Background - Aetherfield Inspired */
        .hero-gradient-soft {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--color-soft-blue) 0%, var(--color-warm-white) 50%, var(--color-cream) 100%);
            overflow: hidden;
        }

        .hero-soft-pattern {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle at 20% 80%, rgba(99, 102, 241, 0.05) 0%, transparent 50%),
                              radial-gradient(circle at 80% 20%, rgba(251, 191, 36, 0.05) 0%, transparent 50%);
        }

        /* Ambient gradient orbs */
        .hero-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.5;
            animation: float-orb 20s ease-in-out infinite;
        }

        .hero-orb-1 {
            top: -10%;
            left: 10%;
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, var(--brand-primary) 0%, var(--brand-300) 100%);
            opacity: 0.15;
            animation-delay: 0s;
        }

        .hero-orb-2 {
            bottom: -20%;
            right: 5%;
            width: 600px;
            height: 600px;
            background: linear-gradient(135deg, var(--brand-accent) 0%, var(--brand-400) 100%);
            opacity: 0.12;
            animation-delay: -7s;
        }

        .hero-orb-3 {
            top: 30%;
            right: 30%;
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, var(--brand-secondary) 0%, var(--success) 100%);
            opacity: 0.08;
            animation-delay: -14s;
        }

        @keyframes float-orb {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(30px, -20px) scale(1.05); }
            50% { transform: translate(-20px, 30px) scale(0.95); }
            75% { transform: translate(-30px, -10px) scale(1.02); }
        }

        /* Subtle grid pattern */
        .hero-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(var(--gray-200) 1px, transparent 1px),
                linear-gradient(90deg, var(--gray-200) 1px, transparent 1px);
            background-size: 60px 60px;
            opacity: 0.3;
            mask-image: radial-gradient(ellipse 80% 50% at 50% 50%, black, transparent);
            -webkit-mask-image: radial-gradient(ellipse 80% 50% at 50% 50%, black, transparent);
        }

        /* Content container */
        .hero-content { max-width: 900px; }

        /* Badge Styles */
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px 6px 10px;
            font-size: 0.8125rem;
            font-weight: 500;
            color: var(--brand-600);
            background-color: var(--brand-50);
            border: 1px solid var(--brand-100);
            border-radius: var(--radius-full);
            margin-bottom: 24px;
        }

        .hero-badge-soft {
            background-color: white;
            border-color: var(--gray-200);
            color: var(--gray-700);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .hero-badge-dot {
            width: 6px;
            height: 6px;
            background-color: var(--brand-primary);
            border-radius: 50%;
            animation: pulse-dot 2s ease-in-out infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.8); }
        }

        /* Headline */
        .hero-headline {
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 700;
            line-height: 1.1;
            letter-spacing: -0.025em;
            color: var(--gray-900);
            margin-bottom: 24px;
        }

        .hero-headline-serif {
            font-family: var(--font-serif);
            font-weight: 600;
            letter-spacing: -0.01em;
        }

        /* Description */
        .hero-description {
            font-size: 1.125rem;
            line-height: 1.7;
            color: var(--gray-600);
            max-width: 640px;
            margin-bottom: 40px;
        }

        /* Action buttons container */
        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 48px;
        }

        /* Primary button - Brand Color */
        .hero-btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 14px 28px;
            font-size: 0.9375rem;
            font-weight: 600;
            color: white;
            background: linear-gradient(135deg, var(--brand-primary) 0%, var(--brand-600) 100%);
            border-radius: var(--radius-lg);
            box-shadow: 0 4px 14px rgba(99, 102, 241, 0.3), 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all var(--duration-normal) var(--ease-out);
            text-decoration: none;
        }

        .hero-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.35), 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        /* Dark Secondary Button */
        .hero-btn-dark {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 14px 28px;
            font-size: 0.9375rem;
            font-weight: 600;
            color: white;
            background-color: var(--color-dark-button);
            border-radius: var(--radius-lg);
            transition: all var(--duration-normal) var(--ease-out);
            text-decoration: none;
        }

        .hero-btn-dark:hover {
            background-color: var(--gray-800);
            transform: translateY(-2px);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.2);
        }

        /* Trust indicators */
        .hero-trust {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
        }

        .hero-trust-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.875rem;
        }

        /* Showcase Image */
        .hero-showcase {
            margin-top: 64px;
            display: flex;
            justify-content: center;
        }

        .hero-showcase-wrapper {
            position: relative;
            max-width: 1000px;
            width: 100%;
        }

        .hero-showcase-image {
            width: 100%;
            height: auto;
            border-radius: var(--radius-xl);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(0, 0, 0, 0.05);
        }

        .hero-showcase-glow {
            position: absolute;
            inset: -20px;
            background: linear-gradient(135deg, var(--brand-primary), var(--brand-accent));
            opacity: 0.1;
            filter: blur(40px);
            border-radius: var(--radius-xl);
            z-index: -1;
        }

        @media (max-width: 768px) {
            .hero-section {
                min-height: auto;
                padding: 80px 0 100px;
            }
            .hero-actions {
                flex-direction: column;
            }
            .hero-btn-primary, .hero-btn-dark {
                width: 100%;
                justify-content: center;
            }
            .hero-trust {
                flex-direction: column;
                gap: 12px;
            }
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
