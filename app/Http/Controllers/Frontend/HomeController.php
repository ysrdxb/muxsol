<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $page = Page::getHomepage();

        if (!$page) {
            abort(404);
        }

        $sections = $page->activeSections()->get();

        return view('frontend.home', compact('page', 'sections'));
    }
}
