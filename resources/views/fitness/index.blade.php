<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-xs font-medium text-slate-500">{{ date('l, F j, Y') }}</span>
                    <span class="text-slate-300">·</span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                        Tracking
                    </span>
                </div>
                <h2 class="text-xl font-semibold text-slate-900 tracking-tight">
                    Fitness & Water Tracker
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Track daily hydration progress and log physical exercise workouts.</p>
            </div>
            
            <div class="flex items-center gap-3 bg-white px-3.5 py-2 rounded-md border border-slate-200 shadow-2xs">
                <div class="flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-sky-500"></span>
                    <span class="text-xs font-medium text-slate-700 font-mono">{{ number_format($dailyLog->water_intake_ml) }} ml</span>
                </div>
                <span class="text-slate-300">|</span>
                <div class="flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                    <span class="text-xs font-medium text-slate-700 font-mono">-{{ number_format($dailyLog->total_calories_burn ?? 0) }} kcal</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- Water Hydration Card -->
            <div class="bg-white p-6 rounded-lg border border-slate-200 shadow-2xs flex flex-col justify-between space-y-6">
                <div>
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <div>
                            <h3 class="text-sm font-semibold text-slate-900">Daily Water Intake</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Recommended Goal: 3,000 ml</p>
                        </div>
                        <span class="text-xs font-medium text-slate-700 bg-slate-50 px-2.5 py-1 rounded border border-slate-200 font-mono">
                            Goal: 3,000 ml
                        </span>
                    </div>

                    <!-- Water Counter -->
                    <div class="text-center my-6 p-6 rounded-lg bg-slate-50 border border-slate-200">
                        <div class="inline-flex items-baseline gap-2">
                            <span class="text-4xl font-semibold text-slate-900 font-mono">{{ number_format($dailyLog->water_intake_ml) }}</span>
                            <span class="text-sm text-slate-500 font-mono">/ 3,000 ml</span>
                        </div>
                        <div class="w-full bg-slate-200 h-2.5 rounded overflow-hidden mt-4">
                            <div class="bg-sky-500 h-full rounded transition-all duration-300" style="width: {{ min(100, ($dailyLog->water_intake_ml / 3000) * 100) }}%"></div>
                        </div>
                        <p class="text-xs text-slate-500 mt-2 font-mono">
                            {{ round(($dailyLog->water_intake_ml / 3000) * 100) }}% of daily goal reached
                        </p>
                    </div>
                </div>

                <!-- Quick Buttons -->
                <div class="grid grid-cols-3 gap-3">
                    <form action="{{ route('fitness.water.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="amount" value="250">
                        <button type="submit"
                            class="w-full bg-sky-50 hover:bg-sky-100 text-sky-800 font-medium py-2 px-3 rounded-md transition text-xs border border-sky-200 flex items-center justify-center gap-1 shadow-2xs">
                            <span>+250ml Glass</span>
                        </button>
                    </form>

                    <form action="{{ route('fitness.water.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="amount" value="500">
                        <button type="submit"
                            class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2 px-3 rounded-md transition text-xs flex items-center justify-center gap-1 shadow-2xs">
                            <span>+500ml Bottle</span>
                        </button>
                    </form>

                    <form action="{{ route('fitness.water.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="amount" value="-250">
                        <button type="submit"
                            class="w-full bg-white hover:bg-slate-50 text-slate-600 font-medium py-2 px-3 rounded-md transition text-xs flex items-center justify-center gap-1 border border-slate-300 shadow-2xs">
                            <span>Undo 250ml</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Workout Logger Card -->
            <div class="bg-white p-6 rounded-lg border border-slate-200 shadow-2xs space-y-5">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <div>
                        <h3 class="text-sm font-semibold text-slate-900">Log Physical Activity</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Record workouts and calculate calories burned</p>
                    </div>
                </div>

                <!-- Activity Form -->
                <form action="{{ route('fitness.exercise.store') }}" method="POST" class="space-y-3 bg-slate-50 p-4 rounded-md border border-slate-200">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-700 mb-1">Exercise Type</label>
                            <select name="exercise_id"
                                class="block w-full rounded border-slate-300 bg-white text-xs text-slate-800 focus:border-emerald-600 focus:ring-emerald-600 py-1.5 px-2.5">
                                @foreach ($allExercises as $ex)
                                    <option value="{{ $ex->id }}">{{ $ex->name }} ({{ $ex->calories_burn_per_minute }} cal/min)</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-700 mb-1">Duration (Minutes)</label>
                            <input type="number" name="duration_minutes" value="15" min="1"
                                class="block w-full rounded border-slate-300 bg-white text-xs text-slate-800 focus:border-emerald-600 focus:ring-emerald-600 py-1.5 px-2.5 font-mono">
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-slate-900 hover:bg-slate-800 text-white font-medium py-2 px-3 rounded-md transition text-xs flex items-center justify-center gap-1.5 shadow-2xs">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        <span>Log Workout</span>
                    </button>
                </form>

                <!-- Workout Log History -->
                <div>
                    <div class="flex items-center justify-between border-b border-slate-100 pb-2 mb-3">
                        <h4 class="text-xs font-semibold text-slate-700">Today's Workouts</h4>
                        <span class="text-xs font-semibold text-amber-700 font-mono">
                            -{{ number_format($dailyLog->total_calories_burn ?? 0) }} kcal
                        </span>
                    </div>

                    <div class="space-y-2 max-h-[220px] overflow-y-auto pr-1">
                        @forelse($exerciseLogs as $log)
                            <div class="flex justify-between items-center bg-slate-50 p-3 rounded-md border border-slate-200 text-xs">
                                <div>
                                    <p class="font-medium text-slate-900">{{ $log->exercise->name }}</p>
                                    <p class="text-[11px] text-slate-500 font-mono mt-0.5">{{ $log->duration_minutes }} minutes</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="font-medium text-amber-700 bg-amber-50 border border-amber-200 px-2 py-0.5 rounded font-mono text-xs">
                                        -{{ number_format($log->calculated_calories_burn) }} kcal
                                    </span>
                                    <form action="{{ route('fitness.exercise.destroy', $log->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-slate-400 hover:text-rose-600 hover:bg-slate-100 p-1 rounded transition" title="Remove">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 italic text-center py-5">No exercises logged today yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
