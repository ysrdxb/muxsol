@php
    $items = $content['items'] ?? [];
    $background = $settings['background'] ?? 'primary';
@endphp

<section class="{{ $background === 'primary' ? 'bg-primary' : ($background === 'dark' ? 'bg-gray-900' : 'bg-gray-50') }} py-16 sm:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        @if($section->title)
            <h2 class="text-center text-3xl font-bold {{ $background === 'light' ? 'text-gray-900' : 'text-white' }} mb-12">
                {{ $section->title }}
            </h2>
        @endif

        <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
            @foreach($items as $item)
                <div class="text-center">
                    <div class="text-4xl font-bold {{ $background === 'light' ? 'text-primary' : 'text-white' }} sm:text-5xl">
                        {{ $item['value'] ?? '' }}
                    </div>
                    <div class="mt-2 text-sm font-medium {{ $background === 'light' ? 'text-gray-600' : 'text-white/80' }}">
                        {{ $item['label'] ?? '' }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
