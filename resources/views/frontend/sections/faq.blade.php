@php
    $items = $content['items'] ?? [];
@endphp

<section class="py-16 sm:py-24 bg-white" x-data="{ openItem: null }">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        @if($section->title || $section->subtitle)
            <div class="text-center mb-12">
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

        <div class="divide-y divide-gray-200">
            @foreach($items as $index => $item)
                <div class="py-4">
                    <button @click="openItem = openItem === {{ $index }} ? null : {{ $index }}"
                            class="flex w-full items-center justify-between text-left">
                        <span class="text-lg font-medium text-gray-900">{{ $item['question'] ?? '' }}</span>
                        <span class="ml-4 flex-shrink-0">
                            <svg x-show="openItem !== {{ $index }}" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <svg x-show="openItem === {{ $index }}" x-cloak class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                            </svg>
                        </span>
                    </button>
                    <div x-show="openItem === {{ $index }}" x-collapse x-cloak>
                        <p class="mt-4 text-gray-600">{{ $item['answer'] ?? '' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
