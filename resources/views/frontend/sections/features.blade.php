@php
    $items = $content['items'] ?? [];
    $columns = $settings['columns'] ?? 3;
    $style = $settings['style'] ?? 'list';
@endphp

<section class="features-section">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        @if($section->title || $section->subtitle)
            <div class="features-header">
                @if($section->subtitle)
                    <span class="features-eyebrow">{{ $section->subtitle }}</span>
                @endif
                @if($section->title)
                    <h2 class="features-title">{{ $section->title }}</h2>
                @endif
            </div>
        @endif

        <!-- Features Grid -->
        <div class="features-grid features-grid-{{ $columns }}">
            @foreach($items as $index => $item)
                <div class="feature-item animate-fade-in-up" style="animation-delay: {{ $index * 60 }}ms">
                    <!-- Check Icon -->
                    <div class="feature-check">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </div>

                    <!-- Content -->
                    <div class="feature-content">
                        <h3 class="feature-title">{{ $item['title'] ?? '' }}</h3>
                        @if(isset($item['description']))
                            <p class="feature-description">{{ $item['description'] }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    /* Features Section */
    .features-section {
        padding: 96px 0;
        background-color: white;
    }

    /* Header */
    .features-header {
        text-align: center;
        max-width: 720px;
        margin: 0 auto 56px;
    }

    .features-eyebrow {
        display: inline-block;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--brand-primary);
        margin-bottom: 12px;
    }

    .features-title {
        font-size: clamp(1.75rem, 4vw, 2.25rem);
        font-weight: 700;
        line-height: 1.2;
        letter-spacing: -0.02em;
        color: var(--gray-900);
    }

    /* Features Grid */
    .features-grid {
        display: grid;
        gap: 32px 24px;
    }

    .features-grid-2 {
        grid-template-columns: repeat(1, 1fr);
    }
    .features-grid-3 {
        grid-template-columns: repeat(1, 1fr);
    }
    .features-grid-4 {
        grid-template-columns: repeat(1, 1fr);
    }

    @media (min-width: 640px) {
        .features-grid-2, .features-grid-3, .features-grid-4 {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .features-grid-3 {
            grid-template-columns: repeat(3, 1fr);
        }
        .features-grid-4 {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    /* Feature Item */
    .feature-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
    }

    /* Check Icon */
    .feature-check {
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
        border-radius: var(--radius-md);
        box-shadow: 0 2px 4px rgba(16, 185, 129, 0.2);
    }

    .feature-check svg {
        width: 14px;
        height: 14px;
        color: white;
    }

    /* Feature Content */
    .feature-content {
        flex: 1;
        padding-top: 2px;
    }

    .feature-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 4px;
    }

    .feature-description {
        font-size: 0.9375rem;
        line-height: 1.5;
        color: var(--gray-600);
    }

    /* Responsive */
    @media (max-width: 640px) {
        .features-grid {
            gap: 24px;
        }
    }
</style>
