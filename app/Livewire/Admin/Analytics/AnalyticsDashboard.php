<?php

namespace App\Livewire\Admin\Analytics;

use App\Models\Analytics;
use App\Models\Contact;
use App\Models\Page;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AnalyticsDashboard extends Component
{
    public string $period = '7';

    public function getChartData(): array
    {
        $days = (int) $this->period;
        $labels = [];
        $pageViews = [];
        $visitors = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels[] = $date->format('M d');

            $dayStats = Analytics::whereDate('created_at', $date->toDateString())
                ->where('type', 'page_view')
                ->selectRaw('COUNT(*) as views, COUNT(DISTINCT session_id) as visitors')
                ->first();

            $pageViews[] = $dayStats->views ?? 0;
            $visitors[] = $dayStats->visitors ?? 0;
        }

        return [
            'labels' => $labels,
            'pageViews' => $pageViews,
            'visitors' => $visitors,
        ];
    }

    public function render()
    {
        $startDate = now()->subDays((int) $this->period);

        // Chart data for ApexCharts
        $chartData = $this->getChartData();

        // Page views over time
        $pageViews = Analytics::where('type', 'page_view')
            ->where('created_at', '>=', $startDate)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as views')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Top pages
        $topPages = Analytics::where('type', 'page_view')
            ->where('created_at', '>=', $startDate)
            ->selectRaw('url, COUNT(*) as views')
            ->groupBy('url')
            ->orderByDesc('views')
            ->limit(10)
            ->get();

        // Device breakdown
        $devices = Analytics::where('type', 'page_view')
            ->where('created_at', '>=', $startDate)
            ->selectRaw('device, COUNT(*) as count')
            ->groupBy('device')
            ->get();

        // Browser breakdown
        $browsers = Analytics::where('type', 'page_view')
            ->where('created_at', '>=', $startDate)
            ->selectRaw('browser, COUNT(*) as count')
            ->groupBy('browser')
            ->orderByDesc('count')
            ->limit(5)
            ->get();

        // Referrers
        $referrers = Analytics::where('type', 'page_view')
            ->where('created_at', '>=', $startDate)
            ->whereNotNull('referrer')
            ->selectRaw('referrer, COUNT(*) as count')
            ->groupBy('referrer')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        // Stats
        $totalViews = Analytics::where('type', 'page_view')
            ->where('created_at', '>=', $startDate)
            ->count();

        $uniqueVisitors = Analytics::where('type', 'page_view')
            ->where('created_at', '>=', $startDate)
            ->distinct('session_id')
            ->count('session_id');

        $newContacts = Contact::where('created_at', '>=', $startDate)->count();

        return view('admin.livewire.analytics.analytics-dashboard', [
            'chartData' => $chartData,
            'pageViews' => $pageViews,
            'topPages' => $topPages,
            'devices' => $devices,
            'browsers' => $browsers,
            'referrers' => $referrers,
            'totalViews' => $totalViews,
            'uniqueVisitors' => $uniqueVisitors,
            'newContacts' => $newContacts,
        ])->layout('admin.layouts.app');
    }
}
