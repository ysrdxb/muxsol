@php
    $items = $content['items'] ?? [];
    $columns = $settings['columns'] ?? 4;
@endphp

<section class="py-16 sm:py-24 bg-gray-50">
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
                <div class="text-center">
                    <div class="relative mx-auto h-40 w-40 overflow-hidden rounded-full">
                        @if(isset($item['image']))
                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] ?? '' }}"
                                 class="h-full w-full object-cover">
                        @else
                            <div class="flex h-full w-full items-center justify-center bg-primary text-4xl font-bold text-white">
                                {{ substr($item['name'] ?? 'T', 0, 1) }}
                            </div>
                        @endif
                    </div>

                    <h3 class="mt-4 text-lg font-semibold text-gray-900">{{ $item['name'] ?? '' }}</h3>

                    @if(isset($item['title']))
                        <p class="text-sm text-primary">{{ $item['title'] }}</p>
                    @endif

                    @if(isset($item['bio']))
                        <p class="mt-2 text-sm text-gray-600">{{ $item['bio'] }}</p>
                    @endif

                    @if(isset($item['social']) && is_array($item['social']))
                        <div class="mt-4 flex justify-center space-x-4">
                            @if(isset($item['social']['linkedin']))
                                <a href="{{ $item['social']['linkedin'] }}" target="_blank" class="text-gray-400 hover:text-primary">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                    </svg>
                                </a>
                            @endif
                            @if(isset($item['social']['twitter']))
                                <a href="{{ $item['social']['twitter'] }}" target="_blank" class="text-gray-400 hover:text-primary">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
