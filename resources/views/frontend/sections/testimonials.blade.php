@php
    $items = $content['items'] ?? [];
    $style = $settings['style'] ?? 'grid';
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

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach($items as $item)
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div class="flex items-center space-x-1 text-yellow-400">
                        @for($i = 0; $i < ($item['rating'] ?? 5); $i++)
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>

                    <blockquote class="mt-4">
                        <p class="text-gray-600 italic">"{{ $item['quote'] ?? '' }}"</p>
                    </blockquote>

                    <div class="mt-6 flex items-center">
                        @if(isset($item['image']))
                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] ?? '' }}"
                                 class="h-12 w-12 rounded-full object-cover">
                        @else
                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary text-white font-bold">
                                {{ substr($item['name'] ?? 'A', 0, 1) }}
                            </div>
                        @endif
                        <div class="ml-4">
                            <div class="font-semibold text-gray-900">{{ $item['name'] ?? '' }}</div>
                            @if(isset($item['title']))
                                <div class="text-sm text-gray-500">{{ $item['title'] }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
