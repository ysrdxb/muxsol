@php
    $items = $content['items'] ?? [];
@endphp

<section class="py-16 sm:py-24 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        @if($section->title || $section->subtitle)
            <div class="text-center max-w-3xl mx-auto mb-16">
                @if($section->subtitle)
                    <p class="text-sm font-semibold uppercase tracking-wide text-primary">
                        {{ $section->subtitle }}
                    </p>
                @endif
                @if($section->title)
                    <h2 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                        {{ $section->title }}
                    </h2>
                @endif
            </div>
        @endif

        <div class="grid gap-8 lg:grid-cols-3">
            @foreach($items as $item)
                <div class="relative rounded-2xl border {{ ($item['featured'] ?? false) ? 'border-primary shadow-xl scale-105' : 'border-gray-200' }} bg-white p-8">
                    @if($item['featured'] ?? false)
                        <span class="absolute -top-4 left-1/2 -translate-x-1/2 rounded-full bg-primary px-4 py-1 text-xs font-semibold text-white">
                            Most Popular
                        </span>
                    @endif

                    <h3 class="text-xl font-semibold text-gray-900">{{ $item['name'] ?? '' }}</h3>

                    @if(isset($item['description']))
                        <p class="mt-2 text-sm text-gray-500">{{ $item['description'] }}</p>
                    @endif

                    <div class="mt-6">
                        <span class="text-4xl font-bold text-gray-900">{{ $item['price'] ?? '$0' }}</span>
                        @if(isset($item['period']))
                            <span class="text-gray-500">/{{ $item['period'] }}</span>
                        @endif
                    </div>

                    @if(isset($item['features']) && is_array($item['features']))
                        <ul class="mt-8 space-y-3">
                            @foreach($item['features'] as $feature)
                                <li class="flex items-center text-sm text-gray-600">
                                    <svg class="mr-3 h-5 w-5 flex-shrink-0 text-primary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <a href="{{ $item['button_url'] ?? '/contact' }}"
                       class="mt-8 block w-full rounded-lg {{ ($item['featured'] ?? false) ? 'bg-primary text-white' : 'border border-primary text-primary' }} px-4 py-3 text-center text-sm font-semibold hover:opacity-90 transition-opacity">
                        {{ $item['button_text'] ?? 'Get Started' }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
