<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-xl text-slate-900 tracking-tight flex items-center gap-2">
                    📊 Weekly Analytics & Visual Reports
                </h2>
                <p class="text-xs font-semibold text-slate-500 mt-0.5">Metabolic trends, calorie balance, and hydration data (Past 7 Days).</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('reports.csv') }}"
                    class="inline-flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-extrabold px-3.5 py-2.5 rounded-none shadow-xs transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>Export Excel (CSV)</span>
                </a>
                <a href="{{ route('reports.pdf') }}" target="_blank"
                    class="inline-flex items-center gap-1.5 bg-rose-600 hover:bg-rose-700 text-white text-xs font-extrabold px-3.5 py-2.5 rounded-none shadow-xs transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    <span>Export PDF Report</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Calorie Balance Chart -->
                <div class="bg-white p-7 rounded-none shadow-sm border border-slate-200/80 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-none bg-rose-50 text-rose-600 flex items-center justify-center text-xl font-bold">
                                🔥
                            </div>
                            <div>
                                <h3 class="text-base font-extrabold text-slate-900">Calorie Balance Matrix</h3>
                                <p class="text-xs text-slate-500 font-medium">Daily Intake vs Workout Calories Burned</p>
                            </div>
                        </div>
                    </div>
                    <div class="h-72">
                        <canvas id="calorieChart"></canvas>
                    </div>
                </div>

                <!-- Water Intake Trend Chart -->
                <div class="bg-white p-7 rounded-none shadow-sm border border-slate-200/80 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-none bg-cyan-50 text-cyan-600 flex items-center justify-center text-xl font-bold">
                                💧
                            </div>
                            <div>
                                <h3 class="text-base font-extrabold text-slate-900">Volumetric Hydration Trend</h3>
                                <p class="text-xs text-slate-500 font-medium">Daily Liquid Consumption (ml)</p>
                            </div>
                        </div>
                    </div>
                    <div class="h-72">
                        <canvas id="waterChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // 1. Calorie Chart Configuration
        const calorieCtx = document.getElementById('calorieChart').getContext('2d');
        new Chart(calorieCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                        label: 'Intake (kcal)',
                        data: {!! json_encode($caloriesIntake) !!},
                        backgroundColor: '#f43f5e',
                        borderRadius: 8,
                    },
                    {
                        label: 'Burned (kcal)',
                        data: {!! json_encode($caloriesBurn) !!},
                        backgroundColor: '#f97316',
                        borderRadius: 8,
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
                            font: { family: 'Ubuntu', weight: 'bold', size: 11 },
                            usePointStyle: true,
                            boxWidth: 8
                        }
                    }
                },
                scales: {
                    x: { grid: { display: false } },
                    y: { grid: { color: 'rgba(226, 232, 240, 0.6)' } }
                }
            }
        });

        // 2. Water Intake Chart Configuration
        const waterCtx = document.getElementById('waterChart').getContext('2d');
        new Chart(waterCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Water (ml)',
                    data: {!! json_encode($waterIntake) !!},
                    borderColor: '#06b6d4',
                    backgroundColor: 'rgba(6, 182, 212, 0.12)',
                    fill: true,
                    tension: 0.35,
                    borderWidth: 3,
                    pointBackgroundColor: '#0891b2',
                    pointRadius: 4
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
                    y: { grid: { color: 'rgba(226, 232, 240, 0.6)' } }
                }
            }
        });
    </script>
</x-app-layout>
