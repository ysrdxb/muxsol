<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Funnel;
use App\Models\FunnelStep;
use Illuminate\View\View;

class FunnelController extends Controller
{
    public function show(Funnel $funnel): View
    {
        if (!$funnel->is_active) {
            abort(404);
        }

        $step = $funnel->getFirstStep();

        if (!$step) {
            abort(404);
        }

        $step->recordView();

        return view('frontend.funnel.step', compact('funnel', 'step'));
    }

    public function step(Funnel $funnel, FunnelStep $step): View
    {
        if (!$funnel->is_active || !$step->is_active) {
            abort(404);
        }

        $step->recordView();

        return view('frontend.funnel.step', compact('funnel', 'step'));
    }
}
