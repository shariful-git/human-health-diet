<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('📊 WEEKLY ANALYTICS & REPORTS') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('reports.csv') }}"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-3 py-2 rounded-lg shadow-sm transition">
                    📥 Export Excel
                </a>
                <a href="{{ route('reports.pdf') }}" target="_blank"
                    class="bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold px-3 py-2 rounded-lg shadow-sm transition">
                    📄 Export PDF
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-md font-bold text-gray-700 mb-4">🔥 Calorie Balance (Past 7 Days)</h3>
                    <div class="h-64">
                        <canvas id="calorieChart"></canvas>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-md font-bold text-gray-700 mb-4">💧 Water Intake Trend (ml)</h3>
                    <div class="h-64">
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
                        backgroundColor: 'rgba(244, 63, 94, 0.85)', // Rose
                        borderRadius: 6,
                    },
                    {
                        label: 'Burned (kcal)',
                        data: {!! json_encode($caloriesBurn) !!},
                        backgroundColor: 'rgba(249, 115, 22, 0.85)', // Orange
                        borderRadius: 6,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top'
                    }
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
                    borderColor: 'rgba(59, 130, 246, 1)', // Blue
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true,
                    tension: 0.3,
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
</x-app-layout>
