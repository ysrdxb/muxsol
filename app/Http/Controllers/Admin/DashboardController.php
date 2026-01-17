<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Analytics;
use App\Models\Contact;
use App\Models\Page;
use App\Models\Media;
use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_pages' => Page::count(),
            'published_pages' => Page::published()->count(),
            'total_contacts' => Contact::count(),
            'new_contacts' => Contact::new()->count(),
            'total_media' => Media::count(),
        ];

        $analyticsStats = Analytics::getStats('today');
        $weeklyStats = Analytics::getStats('week');
        $monthlyStats = Analytics::getStats('month');

        // Get chart data for last 7 days
        $chartData = $this->getChartData();

        // Get top pages
        $topPages = $this->getTopPages();

        // Get browser stats
        $browserStats = $this->getBrowserStats();

        $recentActivity = ActivityLog::with('user')
            ->recent(10)
            ->get();

        $recentContacts = Contact::latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'stats',
            'analyticsStats',
            'weeklyStats',
            'monthlyStats',
            'chartData',
            'topPages',
            'browserStats',
            'recentActivity',
            'recentContacts'
        ));
    }

    protected function getChartData(): array
    {
        $days = collect();
        $pageViews = collect();
        $visitors = collect();

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $days->push($date->format('M d'));

            $dayStats = Analytics::whereDate('created_at', $date->toDateString())
                ->selectRaw('COUNT(*) as views, COUNT(DISTINCT session_id) as visitors')
                ->where('type', 'page_view')
                ->first();

            $pageViews->push($dayStats->views ?? 0);
            $visitors->push($dayStats->visitors ?? 0);
        }

        return [
            'labels' => $days->toArray(),
            'pageViews' => $pageViews->toArray(),
            'visitors' => $visitors->toArray(),
        ];
    }

    protected function getTopPages(): array
    {
        return Analytics::where('type', 'page_view')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->select('url', DB::raw('COUNT(*) as views'))
            ->groupBy('url')
            ->orderByDesc('views')
            ->limit(5)
            ->get()
            ->toArray();
    }

    protected function getBrowserStats(): array
    {
        $browsers = Analytics::where('type', 'page_view')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->whereNotNull('browser')
            ->select('browser', DB::raw('COUNT(*) as count'))
            ->groupBy('browser')
            ->orderByDesc('count')
            ->limit(5)
            ->get();

        return [
            'labels' => $browsers->pluck('browser')->toArray(),
            'data' => $browsers->pluck('count')->toArray(),
        ];
    }
}
