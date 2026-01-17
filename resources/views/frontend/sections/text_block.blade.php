@php
    $text = $content['text'] ?? '';
    $alignment = $settings['alignment'] ?? 'left';
@endphp

<section class="py-16 sm:py-24 bg-white">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        @if($section->title)
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl text-{{ $alignment }}">
                {{ $section->title }}
            </h2>
        @endif

        @if($text)
            <div class="mt-6 prose prose-lg max-w-none text-{{ $alignment }}">
                {!! $text !!}
            </div>
        @endif
    </div>
</section>
