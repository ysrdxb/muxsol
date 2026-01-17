<x-frontend-layout :title="$page->getSeoTitle()">
    @foreach($sections as $section)
        @include($section->getViewName(), ['section' => $section, 'content' => $section->content, 'settings' => $section->settings])
    @endforeach
</x-frontend-layout>
