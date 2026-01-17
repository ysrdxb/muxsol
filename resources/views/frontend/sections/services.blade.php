@php
    $items = $content['items'] ?? [];
    $columns = $settings['columns'] ?? 3;
    $sectionStyle = $settings['style'] ?? 'cards';
@endphp

<section class="services-section">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        @if($section->title || $section->subtitle)
            <div class="section-header">
                @if($section->subtitle)
                    <span class="section-eyebrow">{{ $section->subtitle }}</span>
                @endif
                @if($section->title)
                    <h2 class="section-title">{{ $section->title }}</h2>
                @endif
            </div>
        @endif

        <!-- Services Grid -->
        <div class="services-grid services-grid-{{ $columns }}">
            @foreach($items as $index => $item)
                <article class="service-card animate-fade-in-up" style="animation-delay: {{ $index * 80 }}ms">
                    <!-- Icon -->
                    @if(isset($item['icon']))
                        <div class="service-icon">
                            @switch($item['icon'])
                                @case('code-bracket')
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5" /></svg>
                                    @break
                                @case('device-phone-mobile')
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" /></svg>
                                    @break
                                @case('cpu-chip')
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 002.25-2.25V6.75a2.25 2.25 0 00-2.25-2.25H6.75A2.25 2.25 0 004.5 6.75v10.5a2.25 2.25 0 002.25 2.25zm.75-12h9v9h-9v-9z" /></svg>
                                    @break
                                @case('squares-2x2')
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" /></svg>
                                    @break
                                @case('server-stack')
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5.25 14.25h13.5m-13.5 0a3 3 0 01-3-3m3 3a3 3 0 100 6h13.5a3 3 0 100-6m-16.5-3a3 3 0 013-3h13.5a3 3 0 013 3m-19.5 0a4.5 4.5 0 01.9-2.7L5.737 5.1a3.375 3.375 0 012.7-1.35h7.126c1.062 0 2.062.5 2.7 1.35l2.587 3.45a4.5 4.5 0 01.9 2.7m0 0a3 3 0 01-3 3m0 3h.008v.008h-.008v-.008zm0-6h.008v.008h-.008v-.008zm-3 6h.008v.008h-.008v-.008zm0-6h.008v.008h-.008v-.008z" /></svg>
                                    @break
                                @case('chart-bar')
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" /></svg>
                                    @break
                                @case('paint-brush')
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42" /></svg>
                                    @break
                                @case('globe-alt')
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" /></svg>
                                    @break
                                @default
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" /></svg>
                            @endswitch
                        </div>
                    @endif

                    <!-- Content -->
                    <h3 class="service-title">{{ $item['title'] ?? '' }}</h3>

                    @if(isset($item['description']))
                        <p class="service-description">{{ $item['description'] }}</p>
                    @endif

                    <!-- Learn More Link -->
                    @if(isset($item['link']))
                        <a href="{{ $item['link'] }}" class="service-link">
                            Learn more
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    @endif
                </article>
            @endforeach
        </div>
    </div>
</section>

<style>
    /* Services Section */
    .services-section {
        padding: 96px 0;
        background: linear-gradient(180deg, white 0%, var(--gray-50) 100%);
    }

    /* Section Header */
    .section-header {
        text-align: center;
        max-width: 720px;
        margin: 0 auto 64px;
    }

    .section-eyebrow {
        display: inline-block;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--brand-primary);
        margin-bottom: 12px;
    }

    .section-title {
        font-size: clamp(1.875rem, 4vw, 2.5rem);
        font-weight: 700;
        line-height: 1.2;
        letter-spacing: -0.02em;
        color: var(--gray-900);
    }

    /* Services Grid */
    .services-grid {
        display: grid;
        gap: 24px;
    }

    .services-grid-2 {
        grid-template-columns: repeat(1, 1fr);
    }
    .services-grid-3 {
        grid-template-columns: repeat(1, 1fr);
    }
    .services-grid-4 {
        grid-template-columns: repeat(1, 1fr);
    }

    @media (min-width: 640px) {
        .services-grid-2, .services-grid-3, .services-grid-4 {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .services-grid-3 {
            grid-template-columns: repeat(3, 1fr);
        }
        .services-grid-4 {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    /* Service Card */
    .service-card {
        position: relative;
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-xl);
        padding: 32px;
        transition: all var(--duration-normal) var(--ease-out);
    }

    .service-card:hover {
        border-color: var(--gray-300);
        box-shadow: var(--shadow-lg);
        transform: translateY(-4px);
    }

    /* Service Icon */
    .service-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        background: var(--brand-50);
        border-radius: var(--radius-lg);
        margin-bottom: 20px;
        transition: all var(--duration-normal) var(--ease-out);
    }

    .service-icon svg {
        width: 24px;
        height: 24px;
        color: var(--brand-primary);
        transition: color var(--duration-fast);
    }

    .service-card:hover .service-icon {
        background: var(--brand-primary);
    }

    .service-card:hover .service-icon svg {
        color: white;
    }

    /* Service Title */
    .service-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 12px;
        transition: color var(--duration-fast);
    }

    .service-card:hover .service-title {
        color: var(--brand-primary);
    }

    /* Service Description */
    .service-description {
        font-size: 0.9375rem;
        line-height: 1.6;
        color: var(--gray-600);
    }

    /* Service Link */
    .service-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 16px;
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--brand-primary);
        transition: gap var(--duration-fast);
    }

    .service-link svg {
        width: 16px;
        height: 16px;
        transition: transform var(--duration-fast);
    }

    .service-link:hover {
        gap: 10px;
    }

    .service-link:hover svg {
        transform: translateX(2px);
    }
</style>
