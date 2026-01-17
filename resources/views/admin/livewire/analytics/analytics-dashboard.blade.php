<div>
    <!-- ApexCharts CDN -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Analytics</h1>
            <p class="mt-1 text-sm text-gray-500">Track your website performance and visitor behavior</p>
        </div>
        <select wire:model.live="period"
                class="rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
            <option value="7">Last 7 days</option>
            <option value="30">Last 30 days</option>
            <option value="90">Last 90 days</option>
        </select>
    </div>

    <!-- Stats Cards -->
    <div class="mb-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-lg bg-white p-6 shadow-sm">
            <div class="flex items-center">
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Page Views</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($totalViews) }}</p>
                </div>
            </div>
        </div>

        <div class="rounded-lg bg-white p-6 shadow-sm">
            <div class="flex items-center">
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-green-100 text-green-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Unique Visitors</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($uniqueVisitors) }}</p>
                </div>
            </div>
        </div>

        <div class="rounded-lg bg-white p-6 shadow-sm">
            <div class="flex items-center">
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-purple-100 text-purple-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">New Contacts</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($newContacts) }}</p>
                </div>
            </div>
        </div>

        <div class="rounded-lg bg-white p-6 shadow-sm">
            <div class="flex items-center">
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-orange-100 text-orange-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Pages</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Page::count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Traffic Chart -->
    <div class="mb-6 rounded-lg bg-white p-6 shadow-sm">
        <h2 class="mb-4 text-lg font-semibold text-gray-900">Traffic Overview</h2>
        <div id="trafficChart" wire:ignore></div>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <!-- Top Pages -->
        <div class="rounded-lg bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-lg font-semibold text-gray-900">Top Pages</h2>
            @if($topPages->count() > 0)
                <div class="space-y-3">
                    @foreach($topPages as $page)
                        <div class="flex items-center justify-between">
                            <span class="truncate text-sm text-gray-600">{{ $page->url }}</span>
                            <span class="ml-4 text-sm font-medium text-gray-900">{{ number_format($page->views) }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-sm text-gray-500 py-8">No data available yet.</p>
            @endif
        </div>

        <!-- Referrers -->
        <div class="rounded-lg bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-lg font-semibold text-gray-900">Top Referrers</h2>
            @if($referrers->count() > 0)
                <div class="space-y-3">
                    @foreach($referrers as $referrer)
                        <div class="flex items-center justify-between">
                            <span class="truncate text-sm text-gray-600">{{ $referrer->referrer }}</span>
                            <span class="ml-4 text-sm font-medium text-gray-900">{{ number_format($referrer->count) }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-sm text-gray-500 py-8">No referrer data available.</p>
            @endif
        </div>

        <!-- Devices Chart -->
        <div class="rounded-lg bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-lg font-semibold text-gray-900">Devices</h2>
            @if($devices->count() > 0)
                <div id="devicesChart" wire:ignore class="flex justify-center"></div>
                <div class="mt-4 space-y-2">
                    @foreach($devices as $device)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">{{ $device->device ?: 'Unknown' }}</span>
                            <span class="text-sm font-medium text-gray-900">{{ number_format($device->count) }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-sm text-gray-500 py-8">No device data available.</p>
            @endif
        </div>

        <!-- Browsers Chart -->
        <div class="rounded-lg bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-lg font-semibold text-gray-900">Browsers</h2>
            @if($browsers->count() > 0)
                <div id="browsersChart" wire:ignore class="flex justify-center"></div>
                <div class="mt-4 space-y-2">
                    @foreach($browsers as $browser)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">{{ $browser->browser ?: 'Unknown' }}</span>
                            <span class="text-sm font-medium text-gray-900">{{ number_format($browser->count) }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-sm text-gray-500 py-8">No browser data available.</p>
            @endif
        </div>
    </div>

    <!-- ApexCharts Initialization -->
    <script>
        document.addEventListener('livewire:navigated', function() {
            initAnalyticsCharts();
        });

        document.addEventListener('DOMContentLoaded', function() {
            initAnalyticsCharts();
        });

        function initAnalyticsCharts() {
            // Traffic Chart
            const trafficChartEl = document.querySelector("#trafficChart");
            if (trafficChartEl && !trafficChartEl.classList.contains('chart-initialized')) {
                trafficChartEl.classList.add('chart-initialized');
                trafficChartEl.innerHTML = '';

                const trafficOptions = {
                    series: [{
                        name: 'Page Views',
                        data: @json($chartData['pageViews'])
                    }, {
                        name: 'Visitors',
                        data: @json($chartData['visitors'])
                    }],
                    chart: {
                        type: 'area',
                        height: 350,
                        toolbar: { show: false },
                        fontFamily: 'inherit'
                    },
                    colors: ['#3B82F6', '#10B981'],
                    dataLabels: { enabled: false },
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
                            style: { colors: '#6B7280', fontSize: '12px' }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: { colors: '#6B7280', fontSize: '12px' }
                        }
                    },
                    grid: {
                        borderColor: '#E5E7EB',
                        strokeDashArray: 4
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'right',
                        labels: { colors: '#374151' }
                    },
                    tooltip: {
                        y: { formatter: (val) => val + ' views' }
                    }
                };

                new ApexCharts(trafficChartEl, trafficOptions).render();
            }

            // Devices Chart
            const devicesChartEl = document.querySelector("#devicesChart");
            if (devicesChartEl && !devicesChartEl.classList.contains('chart-initialized')) {
                devicesChartEl.classList.add('chart-initialized');
                devicesChartEl.innerHTML = '';

                const deviceLabels = @json($devices->pluck('device')->map(fn($d) => $d ?: 'Unknown')->toArray());
                const deviceData = @json($devices->pluck('count')->toArray());

                if (deviceLabels.length > 0) {
                    const devicesOptions = {
                        series: deviceData,
                        chart: {
                            type: 'donut',
                            height: 250,
                            fontFamily: 'inherit'
                        },
                        labels: deviceLabels,
                        colors: ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6'],
                        legend: {
                            position: 'bottom',
                            labels: { colors: '#374151' }
                        },
                        plotOptions: {
                            pie: {
                                donut: {
                                    size: '60%',
                                    labels: {
                                        show: true,
                                        total: {
                                            show: true,
                                            label: 'Total',
                                            color: '#374151'
                                        }
                                    }
                                }
                            }
                        },
                        dataLabels: { enabled: false }
                    };

                    new ApexCharts(devicesChartEl, devicesOptions).render();
                }
            }

            // Browsers Chart
            const browsersChartEl = document.querySelector("#browsersChart");
            if (browsersChartEl && !browsersChartEl.classList.contains('chart-initialized')) {
                browsersChartEl.classList.add('chart-initialized');
                browsersChartEl.innerHTML = '';

                const browserLabels = @json($browsers->pluck('browser')->map(fn($b) => $b ?: 'Unknown')->toArray());
                const browserData = @json($browsers->pluck('count')->toArray());

                if (browserLabels.length > 0) {
                    const browsersOptions = {
                        series: browserData,
                        chart: {
                            type: 'donut',
                            height: 250,
                            fontFamily: 'inherit'
                        },
                        labels: browserLabels,
                        colors: ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6'],
                        legend: {
                            position: 'bottom',
                            labels: { colors: '#374151' }
                        },
                        plotOptions: {
                            pie: {
                                donut: {
                                    size: '60%',
                                    labels: {
                                        show: true,
                                        total: {
                                            show: true,
                                            label: 'Total',
                                            color: '#374151'
                                        }
                                    }
                                }
                            }
                        },
                        dataLabels: { enabled: false }
                    };

                    new ApexCharts(browsersChartEl, browsersOptions).render();
                }
            }
        }
    </script>
</div>
