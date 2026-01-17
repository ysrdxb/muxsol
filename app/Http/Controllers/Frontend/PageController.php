<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    public function show(string $slug): View
    {
        $page = Page::where('slug', $slug)
            ->published()
            ->firstOrFail();

        $sections = $page->activeSections()->get();

        return view('frontend.page', compact('page', 'sections'));
    }
}
