@php
    $items = $content['items'] ?? [];
    $columns = $settings['columns'] ?? 3;
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

        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-{{ $columns }}">
            @foreach($items as $item)
                <div class="group relative overflow-hidden rounded-2xl bg-gray-100">
                    @if(isset($item['image']))
                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['title'] ?? '' }}"
                             class="aspect-[4/3] w-full object-cover transition-transform duration-300 group-hover:scale-105">
                    @else
                        <div class="flex aspect-[4/3] items-center justify-center bg-gradient-to-br from-primary/20 to-purple-500/20">
                            <svg class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                        </div>
                    @endif

                    <div class="absolute inset-0 flex flex-col justify-end bg-gradient-to-t from-gray-900/80 to-transparent p-6 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                        <h3 class="text-lg font-semibold text-white">{{ $item['title'] ?? '' }}</h3>
                        @if(isset($item['category']))
                            <p class="mt-1 text-sm text-gray-300">{{ $item['category'] }}</p>
                        @endif
                        @if(isset($item['url']))
                            <a href="{{ $item['url'] }}" target="_blank"
                               class="mt-4 inline-flex items-center text-sm font-medium text-white hover:text-primary">
                                View Project
                                <svg class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
