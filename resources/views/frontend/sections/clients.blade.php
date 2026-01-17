@php
    $items = $content['items'] ?? [];
@endphp

<section class="py-12 sm:py-16 bg-gray-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        @if($section->title)
            <h2 class="text-center text-sm font-semibold uppercase tracking-wide text-gray-500 mb-8">
                {{ $section->title }}
            </h2>
        @endif

        <div class="flex flex-wrap items-center justify-center gap-8 md:gap-12">
            @foreach($items as $item)
                @if(isset($item['logo']))
                    <img src="{{ asset('storage/' . $item['logo']) }}"
                         alt="{{ $item['name'] ?? 'Client' }}"
                         class="h-8 md:h-12 object-contain grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all">
                @else
                    <div class="text-lg font-bold text-gray-400 hover:text-gray-600 transition-colors">
                        {{ $item['name'] ?? 'Client' }}
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
