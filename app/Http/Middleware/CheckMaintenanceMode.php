<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next): Response
    {
        $maintenanceMode = Setting::get('general.maintenance_mode', false);

        if ($maintenanceMode && !$this->shouldBypass($request)) {
            return response()->view('frontend.maintenance', [], 503);
        }

        return $next($request);
    }

    protected function shouldBypass(Request $request): bool
    {
        // Allow admin routes
        if ($request->is('admin/*') || $request->is('admin')) {
            return true;
        }

        // Allow logged in admins
        if (auth()->check() && auth()->user()->isAdmin()) {
            return true;
        }

        // Check for bypass cookie/token
        $bypassToken = Setting::get('general.maintenance_bypass_token');
        if ($bypassToken && $request->cookie('maintenance_bypass') === $bypassToken) {
            return true;
        }

        return false;
    }
}
