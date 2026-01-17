@php
    $heading = $content['heading'] ?? $section->title;
    $subheading = $content['subheading'] ?? $section->subtitle;
    $description = $content['description'] ?? '';
    $primaryButtonText = $content['primary_button_text'] ?? '';
    $primaryButtonUrl = $content['primary_button_url'] ?? '';
    $secondaryButtonText = $content['secondary_button_text'] ?? '';
    $secondaryButtonUrl = $content['secondary_button_url'] ?? '';
    $backgroundImage = $content['background_image'] ?? null;
    $style = $settings['style'] ?? 'centered';
    $backgroundType = $settings['background_type'] ?? 'gradient';
@endphp

<section class="hero-section relative overflow-hidden">
    <!-- Sophisticated Background -->
    @if($backgroundImage)
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('storage/' . $backgroundImage) }}" alt="" class="h-full w-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-[var(--gray-950)]/80 via-[var(--gray-950)]/70 to-[var(--gray-950)]/90"></div>
        </div>
    @elseif($backgroundType === 'gradient')
        <div class="hero-gradient-bg">
            <!-- Ambient gradient orbs -->
            <div class="hero-orb hero-orb-1"></div>
            <div class="hero-orb hero-orb-2"></div>
            <div class="hero-orb hero-orb-3"></div>
            <!-- Subtle grid pattern -->
            <div class="hero-grid"></div>
        </div>
    @else
        <div class="absolute inset-0 bg-white"></div>
    @endif

    <!-- Content -->
    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="hero-content {{ $style === 'centered' ? 'text-center mx-auto' : 'text-left' }}">
            <!-- Badge/Tag -->
            @if($subheading)
                <div class="hero-badge animate-fade-in-up">
                    <span class="hero-badge-dot"></span>
                    {{ $subheading }}
                </div>
            @endif

            <!-- Main Headline -->
            <h1 class="hero-headline animate-fade-in-up delay-100 {{ $backgroundImage ? 'text-white' : '' }}">
                {!! nl2br(e($heading)) !!}
            </h1>

            <!-- Description -->
            @if($description)
                <p class="hero-description animate-fade-in-up delay-200 {{ $backgroundImage ? 'text-[var(--gray-300)]' : '' }} {{ $style === 'centered' ? 'mx-auto' : '' }}">
                    {{ $description }}
                </p>
            @endif

            <!-- CTA Buttons -->
            @if($primaryButtonText || $secondaryButtonText)
                <div class="hero-actions animate-fade-in-up delay-300 {{ $style === 'centered' ? 'justify-center' : 'justify-start' }}">
                    @if($primaryButtonText)
                        <a href="{{ $primaryButtonUrl }}" class="hero-btn-primary group">
                            {{ $primaryButtonText }}
                            <svg class="w-4 h-4 ml-2 transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    @endif

                    @if($secondaryButtonText)
                        <a href="{{ $secondaryButtonUrl }}" class="hero-btn-secondary {{ $backgroundImage ? 'hero-btn-secondary-dark' : '' }}">
                            {{ $secondaryButtonText }}
                        </a>
                    @endif
                </div>
            @endif

            <!-- Trust indicators (optional) -->
            <div class="hero-trust animate-fade-in-up delay-400 {{ $style === 'centered' ? 'justify-center' : 'justify-start' }}">
                <div class="hero-trust-item">
                    <svg class="w-4 h-4 text-[var(--success)]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="{{ $backgroundImage ? 'text-[var(--gray-400)]' : 'text-[var(--gray-500)]' }}">No setup required</span>
                </div>
                <div class="hero-trust-item">
                    <svg class="w-4 h-4 text-[var(--success)]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="{{ $backgroundImage ? 'text-[var(--gray-400)]' : 'text-[var(--gray-500)]' }}">Free consultation</span>
                </div>
                <div class="hero-trust-item">
                    <svg class="w-4 h-4 text-[var(--success)]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="{{ $backgroundImage ? 'text-[var(--gray-400)]' : 'text-[var(--gray-500)]' }}">Cancel anytime</span>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Hero Section Base */
    .hero-section {
        min-height: 85vh;
        display: flex;
        align-items: center;
        padding: 120px 0 140px;
    }

    /* Gradient Background */
    .hero-gradient-bg {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, var(--gray-50) 0%, white 50%, var(--gray-50) 100%);
        overflow: hidden;
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
        0%, 100% {
            transform: translate(0, 0) scale(1);
        }
        25% {
            transform: translate(30px, -20px) scale(1.05);
        }
        50% {
            transform: translate(-20px, 30px) scale(0.95);
        }
        75% {
            transform: translate(-30px, -10px) scale(1.02);
        }
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
    .hero-content {
        max-width: 900px;
    }

    /* Badge */
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

    /* Primary button */
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
    }

    .hero-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.35), 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .hero-btn-primary:active {
        transform: translateY(0);
    }

    /* Secondary button */
    .hero-btn-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 14px 28px;
        font-size: 0.9375rem;
        font-weight: 600;
        color: var(--gray-700);
        background-color: white;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-lg);
        transition: all var(--duration-normal) var(--ease-out);
    }

    .hero-btn-secondary:hover {
        background-color: var(--gray-50);
        border-color: var(--gray-300);
    }

    .hero-btn-secondary-dark {
        color: white;
        background-color: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
    }

    .hero-btn-secondary-dark:hover {
        background-color: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.3);
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

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .hero-section {
            min-height: auto;
            padding: 80px 0 100px;
        }

        .hero-badge {
            margin-bottom: 20px;
        }

        .hero-headline {
            margin-bottom: 20px;
        }

        .hero-description {
            font-size: 1rem;
            margin-bottom: 32px;
        }

        .hero-actions {
            flex-direction: column;
            margin-bottom: 40px;
        }

        .hero-btn-primary,
        .hero-btn-secondary {
            width: 100%;
            justify-content: center;
        }

        .hero-trust {
            flex-direction: column;
            gap: 12px;
        }
    }
</style>
