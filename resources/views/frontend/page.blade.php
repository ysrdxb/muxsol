<x-frontend-layout :title="$page->getSeoTitle()">
    @if($sections->isEmpty())
        <div class="py-16">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h1 class="text-4xl font-bold text-gray-900">{{ $page->title }}</h1>
                @if($page->content)
                    <div class="mt-8 prose prose-lg max-w-none">
                        {!! $page->content !!}
                    </div>
                @endif
            </div>
        </div>
    @else
        @foreach($sections as $section)
            @include($section->getViewName(), ['section' => $section, 'content' => $section->content, 'settings' => $section->settings])
        @endforeach
    @endif
</x-frontend-layout>
