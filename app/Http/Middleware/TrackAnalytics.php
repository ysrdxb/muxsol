<?php

namespace App\Http\Middleware;

use App\Models\Analytics;
use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackAnalytics
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($this->shouldTrack($request, $response)) {
            $this->recordPageView($request);
        }

        return $response;
    }

    protected function shouldTrack(Request $request, Response $response): bool
    {
        // Only track GET requests
        if (!$request->isMethod('GET')) {
            return false;
        }

        // Only track successful responses
        if ($response->getStatusCode() !== 200) {
            return false;
        }

        // Don't track admin routes
        if ($request->is('admin/*') || $request->is('admin')) {
            return false;
        }

        // Don't track API routes
        if ($request->is('api/*')) {
            return false;
        }

        // Don't track if analytics is disabled
        if (!Setting::get('general.enable_analytics', true)) {
            return false;
        }

        // Don't track bots
        if ($this->isBot($request)) {
            return false;
        }

        return true;
    }

    protected function isBot(Request $request): bool
    {
        $userAgent = strtolower($request->userAgent() ?? '');
        $bots = ['bot', 'spider', 'crawler', 'slurp', 'googlebot', 'bingbot'];

        foreach ($bots as $bot) {
            if (str_contains($userAgent, $bot)) {
                return true;
            }
        }

        return false;
    }

    protected function recordPageView(Request $request): void
    {
        try {
            Analytics::recordPageView(
                $request->url(),
                $request->route('page')?->id ?? null
            );
        } catch (\Exception $e) {
            // Silently fail - don't break the request
            report($e);
        }
    }
}
