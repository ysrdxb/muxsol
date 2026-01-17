@php
    $heading = $content['heading'] ?? $section->title;
    $description = $content['description'] ?? $section->subtitle;
    $buttonText = $content['button_text'] ?? '';
    $buttonUrl = $content['button_url'] ?? '';
    $secondaryButtonText = $content['secondary_button_text'] ?? '';
    $secondaryButtonUrl = $content['secondary_button_url'] ?? '';
    $style = $settings['style'] ?? 'centered';
    $background = $settings['background'] ?? 'gradient';
@endphp

<section class="cta-section cta-bg-{{ $background }}">
    <!-- Background decoration -->
    <div class="cta-decoration">
        <div class="cta-orb cta-orb-1"></div>
        <div class="cta-orb cta-orb-2"></div>
        <div class="cta-pattern"></div>
    </div>

    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="cta-content {{ $style === 'centered' ? 'cta-centered' : 'cta-split' }}">
            <!-- Text Content -->
            <div class="cta-text {{ $style !== 'centered' ? 'max-w-xl' : '' }}">
                @if($heading)
                    <h2 class="cta-heading">{{ $heading }}</h2>
                @endif

                @if($description)
                    <p class="cta-description {{ $style === 'centered' ? 'mx-auto' : '' }}">
                        {{ $description }}
                    </p>
                @endif
            </div>

            <!-- Buttons -->
            @if($buttonText)
                <div class="cta-actions {{ $style === 'centered' ? 'justify-center' : '' }}">
                    <a href="{{ $buttonUrl }}" class="cta-btn-primary group">
                        {{ $buttonText }}
                        <svg class="cta-btn-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>

                    @if($secondaryButtonText)
                        <a href="{{ $secondaryButtonUrl }}" class="cta-btn-secondary">
                            {{ $secondaryButtonText }}
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</section>

<style>
    /* CTA Section Base */
    .cta-section {
        position: relative;
        padding: 80px 0;
        overflow: hidden;
    }

    /* Background Variants */
    .cta-bg-gradient {
        background: linear-gradient(135deg, var(--brand-primary) 0%, var(--brand-700) 50%, var(--brand-accent) 100%);
    }

    .cta-bg-dark {
        background: linear-gradient(135deg, var(--gray-900) 0%, var(--gray-950) 100%);
    }

    .cta-bg-light {
        background: linear-gradient(180deg, var(--gray-50) 0%, white 100%);
    }

    .cta-bg-brand {
        background: var(--brand-primary);
    }

    /* Decoration */
    .cta-decoration {
        position: absolute;
        inset: 0;
        overflow: hidden;
        pointer-events: none;
    }

    .cta-orb {
        position: absolute;
        border-radius: 50%;
        opacity: 0.15;
    }

    .cta-orb-1 {
        top: -100px;
        right: -50px;
        width: 400px;
        height: 400px;
        background: white;
    }

    .cta-orb-2 {
        bottom: -80px;
        left: -60px;
        width: 300px;
        height: 300px;
        background: white;
        opacity: 0.1;
    }

    .cta-pattern {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        background-size: 24px 24px;
    }

    /* Light background adjustments */
    .cta-bg-light .cta-orb-1,
    .cta-bg-light .cta-orb-2 {
        background: var(--brand-primary);
        opacity: 0.05;
    }

    .cta-bg-light .cta-pattern {
        background-image: radial-gradient(var(--gray-300) 1px, transparent 1px);
        opacity: 0.5;
    }

    /* Content Layout */
    .cta-content.cta-centered {
        text-align: center;
    }

    .cta-content.cta-split {
        display: flex;
        flex-direction: column;
        gap: 32px;
    }

    @media (min-width: 1024px) {
        .cta-content.cta-split {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }
    }

    /* Heading */
    .cta-heading {
        font-size: clamp(1.75rem, 4vw, 2.5rem);
        font-weight: 700;
        line-height: 1.2;
        letter-spacing: -0.02em;
        color: white;
        margin-bottom: 16px;
    }

    .cta-bg-light .cta-heading {
        color: var(--gray-900);
    }

    /* Description */
    .cta-description {
        font-size: 1.0625rem;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.9);
        max-width: 600px;
    }

    .cta-bg-light .cta-description {
        color: var(--gray-600);
    }

    /* Actions */
    .cta-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        margin-top: 32px;
    }

    .cta-content.cta-split .cta-actions {
        margin-top: 0;
        flex-shrink: 0;
    }

    /* Primary Button */
    .cta-btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 14px 28px;
        font-size: 0.9375rem;
        font-weight: 600;
        color: var(--brand-primary);
        background-color: white;
        border-radius: var(--radius-lg);
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
        transition: all var(--duration-normal) var(--ease-out);
    }

    .cta-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    .cta-bg-light .cta-btn-primary {
        color: white;
        background: linear-gradient(135deg, var(--brand-primary) 0%, var(--brand-600) 100%);
        box-shadow: 0 4px 14px rgba(99, 102, 241, 0.3);
    }

    .cta-bg-light .cta-btn-primary:hover {
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.35);
    }

    .cta-btn-icon {
        width: 18px;
        height: 18px;
        margin-left: 8px;
        transition: transform var(--duration-fast);
    }

    .cta-btn-primary:hover .cta-btn-icon {
        transform: translateX(3px);
    }

    /* Secondary Button */
    .cta-btn-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 14px 28px;
        font-size: 0.9375rem;
        font-weight: 600;
        color: white;
        background-color: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: var(--radius-lg);
        backdrop-filter: blur(8px);
        transition: all var(--duration-normal) var(--ease-out);
    }

    .cta-btn-secondary:hover {
        background-color: rgba(255, 255, 255, 0.25);
        border-color: rgba(255, 255, 255, 0.35);
    }

    .cta-bg-light .cta-btn-secondary {
        color: var(--gray-700);
        background-color: white;
        border-color: var(--gray-200);
    }

    .cta-bg-light .cta-btn-secondary:hover {
        background-color: var(--gray-50);
        border-color: var(--gray-300);
    }

    /* Responsive */
    @media (max-width: 640px) {
        .cta-actions {
            flex-direction: column;
        }

        .cta-btn-primary,
        .cta-btn-secondary {
            width: 100%;
        }
    }
</style>
