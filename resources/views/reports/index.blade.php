<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-xs font-medium text-slate-500">History</span>
                    <span class="text-slate-300">·</span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                        7-Day Trends
                    </span>
                </div>
                <h2 class="text-xl font-semibold text-slate-900 tracking-tight">
                    Reports & Analytics
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Review your weekly calorie balance, workout burn, and water intake.</p>
            </div>
            
            <div class="flex items-center gap-2">
                <a href="{{ route('reports.csv') }}"
                    class="inline-flex items-center gap-1.5 bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 text-xs font-medium px-3.5 py-2 rounded-md shadow-2xs transition">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>Export CSV</span>
                </a>
                <a href="{{ route('reports.pdf') }}" target="_blank"
                    class="inline-flex items-center gap-1.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-medium px-3.5 py-2 rounded-md shadow-2xs transition">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    <span>Export PDF</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Calorie Chart Box -->
                <div class="bg-white p-6 rounded-lg border border-slate-200 shadow-2xs">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-5">
                        <div>
                            <h3 class="text-sm font-semibold text-slate-900">Calorie Balance</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Daily intake vs exercise calories burned</p>
                        </div>
                    </div>
                    <div class="h-64">
                        <canvas id="calorieChart"></canvas>
                    </div>
                </div>

                <!-- Water Intake Chart Box -->
                <div class="bg-white p-6 rounded-lg border border-slate-200 shadow-2xs">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-5">
                        <div>
                            <h3 class="text-sm font-semibold text-slate-900">Water Intake Trend</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Daily fluid intake in milliliters (ml)</p>
                        </div>
                    </div>
                    <div class="h-64">
                        <canvas id="waterChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // 1. Calorie Chart
        const calorieCtx = document.getElementById('calorieChart').getContext('2d');
        new Chart(calorieCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                        label: 'Intake (kcal)',
                        data: {!! json_encode($caloriesIntake) !!},
                        backgroundColor: '#10b981',
                        borderRadius: 4,
                    },
                    {
                        label: 'Burned (kcal)',
                        data: {!! json_encode($caloriesBurn) !!},
                        backgroundColor: '#f59e0b',
                        borderRadius: 4,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: { family: 'Inter', weight: '500', size: 11 },
                            usePointStyle: true,
                            boxWidth: 6
                        }
                    }
                },
                scales: {
                    x: { grid: { display: false } },
                    y: { grid: { color: 'rgba(226, 232, 240, 0.8)' } }
                }
            }
        });

        // 2. Water Chart
        const waterCtx = document.getElementById('waterChart').getContext('2d');
        new Chart(waterCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Water (ml)',
                    data: {!! json_encode($waterIntake) !!},
                    borderColor: '#0284c7',
                    backgroundColor: 'rgba(2, 132, 199, 0.08)',
                    fill: true,
                    tension: 0.3,
                    borderWidth: 2,
                    pointBackgroundColor: '#0284c7',
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: { grid: { display: false } },
                    y: { grid: { color: 'rgba(226, 232, 240, 0.8)' } }
                }
            }
        });
    </script>
</x-app-layout>
