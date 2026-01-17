@php
    $heading = $content['heading'] ?? $section->title;
    $description = $content['description'] ?? $section->subtitle;
    $buttonText = $content['button_text'] ?? 'Subscribe';
@endphp

<section class="py-16 sm:py-24 bg-primary">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            @if($heading)
                <h2 class="text-3xl font-bold text-white">
                    {{ $heading }}
                </h2>
            @endif

            @if($description)
                <p class="mt-4 text-lg text-white/80 max-w-2xl mx-auto">
                    {{ $description }}
                </p>
            @endif

            <div class="mt-8 flex justify-center">
                <livewire:frontend.newsletter-form />
            </div>
        </div>
    </div>
</section>
