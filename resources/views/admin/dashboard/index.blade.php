@extends('admin.layouts.app')

@push('styles')
<style>
    .stat-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                Dashboard
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Welcome back, {{ auth()->user()->name }}!
            </p>
        </div>
        <div class="mt-4 flex md:ml-4 md:mt-0">
            <a href="{{ route('admin.pages.create') }}" class="ml-3 inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                </svg>
                New Page
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-5">
        <!-- Total Pages -->
        <div class="stat-card overflow-hidden rounded-xl bg-white px-4 py-5 shadow sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 rounded-lg bg-blue-500 p-3">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <dt class="truncate text-sm font-medium text-gray-500">Total Pages</dt>
                    <dd class="mt-1 text-2xl font-semibold tracking-tight text-gray-900">{{ $stats['total_pages'] }}</dd>
                </div>
            </div>
            <dd class="mt-3 text-sm text-gray-500">{{ $stats['published_pages'] }} published</dd>
        </div>

        <!-- Today's Visitors -->
        <div class="stat-card overflow-hidden rounded-xl bg-white px-4 py-5 shadow sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 rounded-lg bg-green-500 p-3">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <dt class="truncate text-sm font-medium text-gray-500">Today's Visitors</dt>
                    <dd class="mt-1 text-2xl font-semibold tracking-tight text-gray-900">{{ $analyticsStats['unique_visitors'] ?? 0 }}</dd>
                </div>
            </div>
            <dd class="mt-3 text-sm text-gray-500">{{ $analyticsStats['page_views'] ?? 0 }} page views</dd>
        </div>

        <!-- Weekly Stats -->
        <div class="stat-card overflow-hidden rounded-xl bg-white px-4 py-5 shadow sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 rounded-lg bg-purple-500 p-3">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <dt class="truncate text-sm font-medium text-gray-500">This Week</dt>
                    <dd class="mt-1 text-2xl font-semibold tracking-tight text-gray-900">{{ $weeklyStats['page_views'] ?? 0 }}</dd>
                </div>
            </div>
            <dd class="mt-3 text-sm text-gray-500">{{ $weeklyStats['unique_visitors'] ?? 0 }} unique visitors</dd>
        </div>

        <!-- Total Contacts -->
        <div class="stat-card overflow-hidden rounded-xl bg-white px-4 py-5 shadow sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 rounded-lg bg-yellow-500 p-3">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                </div>
                <div class="ml-4">
                    <dt class="truncate text-sm font-medium text-gray-500">Contacts</dt>
                    <dd class="mt-1 text-2xl font-semibold tracking-tight text-gray-900">{{ $stats['total_contacts'] }}</dd>
                </div>
            </div>
            <dd class="mt-3 text-sm text-green-600 font-medium">{{ $stats['new_contacts'] }} new</dd>
        </div>

        <!-- Media Files -->
        <div class="stat-card overflow-hidden rounded-xl bg-white px-4 py-5 shadow sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 rounded-lg bg-pink-500 p-3">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <dt class="truncate text-sm font-medium text-gray-500">Media Files</dt>
                    <dd class="mt-1 text-2xl font-semibold tracking-tight text-gray-900">{{ $stats['total_media'] ?? 0 }}</dd>
                </div>
            </div>
            <dd class="mt-3 text-sm text-gray-500">Uploaded files</dd>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Traffic Chart -->
        <div class="lg:col-span-2 overflow-hidden rounded-xl bg-white shadow">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Traffic Overview</h3>
                    <span class="text-sm text-gray-500">Last 7 days</span>
                </div>
                <div id="traffic-chart" class="h-80"></div>
            </div>
        </div>

        <!-- Browser Stats -->
        <div class="overflow-hidden rounded-xl bg-white shadow">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Browsers</h3>
                @if(count($browserStats['labels'] ?? []) > 0)
                    <div id="browser-chart" class="h-64"></div>
                @else
                    <div class="flex items-center justify-center h-64 text-gray-500">
                        <p>No browser data yet</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Second Row -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Top Pages -->
        <div class="overflow-hidden rounded-xl bg-white shadow">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Top Pages</h3>
                @if(count($topPages) > 0)
                    <ul class="space-y-3">
                        @foreach($topPages as $page)
                            <li class="flex items-center justify-between">
                                <span class="text-sm text-gray-600 truncate max-w-[200px]" title="{{ $page['url'] }}">{{ $page['url'] }}</span>
                                <span class="text-sm font-medium text-gray-900">{{ number_format($page['views']) }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-sm text-gray-500">No page data yet</p>
                @endif
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="overflow-hidden rounded-xl bg-white shadow">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h3>
                <div class="flow-root">
                    <ul role="list" class="-mb-8">
                        @forelse ($recentActivity->take(5) as $activity)
                            <li>
                                <div class="relative pb-8">
                                    @if (!$loop->last)
                                        <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    @endif
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                                <svg class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.99 5.99 0 00-4.793 2.39A6.483 6.483 0 0010 16.5a6.483 6.483 0 004.793-2.11A5.99 5.99 0 0010 12z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                            <div>
                                                <p class="text-sm text-gray-600">{{ Str::limit($activity->description, 30) }}</p>
                                            </div>
                                            <div class="whitespace-nowrap text-right text-xs text-gray-500">
                                                {{ $activity->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="text-sm text-gray-500">No recent activity</li>
                        @endforelse
                    </ul>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.activity-log.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                        View all activity &rarr;
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Contacts -->
        <div class="overflow-hidden rounded-xl bg-white shadow">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Contacts</h3>
                <div class="flow-root">
                    <ul role="list" class="divide-y divide-gray-200">
                        @forelse ($recentContacts as $contact)
                            <li class="py-3">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-purple-600">
                                            <span class="text-sm font-medium leading-none text-white">{{ strtoupper(substr($contact->name, 0, 2)) }}</span>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="truncate text-sm font-medium text-gray-900">{{ $contact->name }}</p>
                                        <p class="truncate text-sm text-gray-500">{{ $contact->email }}</p>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="py-4 text-sm text-gray-500">No contacts yet</li>
                        @endforelse
                    </ul>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.contacts.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                        View all contacts &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="overflow-hidden rounded-xl bg-white shadow">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                <a href="{{ route('admin.pages.create') }}" class="relative flex flex-col items-center rounded-lg border border-gray-200 bg-white p-4 shadow-sm hover:border-blue-500 hover:shadow-md transition-all">
                    <div class="rounded-full bg-blue-100 p-3 mb-2">
                        <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-900">Create Page</span>
                </a>

                <a href="{{ route('admin.media.index') }}" class="relative flex flex-col items-center rounded-lg border border-gray-200 bg-white p-4 shadow-sm hover:border-green-500 hover:shadow-md transition-all">
                    <div class="rounded-full bg-green-100 p-3 mb-2">
                        <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-900">Upload Media</span>
                </a>

                <a href="{{ route('admin.settings.appearance') }}" class="relative flex flex-col items-center rounded-lg border border-gray-200 bg-white p-4 shadow-sm hover:border-purple-500 hover:shadow-md transition-all">
                    <div class="rounded-full bg-purple-100 p-3 mb-2">
                        <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-900">Appearance</span>
                </a>

                <a href="{{ route('admin.analytics.index') }}" class="relative flex flex-col items-center rounded-lg border border-gray-200 bg-white p-4 shadow-sm hover:border-orange-500 hover:shadow-md transition-all">
                    <div class="rounded-full bg-orange-100 p-3 mb-2">
                        <svg class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-900">Analytics</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Traffic Chart
    var trafficOptions = {
        series: [{
            name: 'Page Views',
            data: @json($chartData['pageViews'])
        }, {
            name: 'Visitors',
            data: @json($chartData['visitors'])
        }],
        chart: {
            type: 'area',
            height: 320,
            toolbar: {
                show: false
            },
            fontFamily: 'Inter, sans-serif'
        },
        colors: ['#3b82f6', '#10b981'],
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 2
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.4,
                opacityTo: 0.1,
                stops: [0, 90, 100]
            }
        },
        xaxis: {
            categories: @json($chartData['labels']),
            labels: {
                style: {
                    colors: '#64748b',
                    fontSize: '12px'
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: '#64748b',
                    fontSize: '12px'
                }
            }
        },
        legend: {
            position: 'top',
            horizontalAlign: 'right'
        },
        tooltip: {
            x: {
                format: 'dd MMM'
            }
        },
        grid: {
            borderColor: '#e2e8f0',
            strokeDashArray: 4
        }
    };

    var trafficChart = new ApexCharts(document.querySelector("#traffic-chart"), trafficOptions);
    trafficChart.render();

    // Browser Chart
    @if(count($browserStats['labels'] ?? []) > 0)
    var browserOptions = {
        series: @json($browserStats['data']),
        chart: {
            type: 'donut',
            height: 256,
            fontFamily: 'Inter, sans-serif'
        },
        labels: @json($browserStats['labels']),
        colors: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'],
        legend: {
            position: 'bottom'
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '60%'
                }
            }
        },
        dataLabels: {
            enabled: false
        }
    };

    var browserChart = new ApexCharts(document.querySelector("#browser-chart"), browserOptions);
    browserChart.render();
    @endif
});
</script>
@endpush
