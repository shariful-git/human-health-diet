<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="font-extrabold text-xl text-slate-900 tracking-tight flex items-center gap-2">
                    💪 Fitness Workouts & Water Hydration
                </h2>
                <p class="text-xs font-semibold text-slate-500 mt-0.5">Track daily liquid intake goals and workout energy burn.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Water Hydration Journal Card -->
            <div class="bg-white p-7 rounded-2xl shadow-sm border border-slate-200/80 hover:shadow-md transition-all duration-300 flex flex-col justify-between space-y-6">
                <div>
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center text-xl font-bold shadow-xs">
                                💧
                            </div>
                            <div>
                                <h3 class="text-base font-extrabold text-slate-900">Hydration Journal</h3>
                                <p class="text-xs text-slate-500 font-medium">Daily Fluid Tracking Target (3,000 ml)</p>
                            </div>
                        </div>
                        <span class="text-xs font-black text-cyan-700 bg-cyan-50 px-3 py-1 rounded-full border border-cyan-200/60 shadow-xs">
                            Goal: 3000ml
                        </span>
                    </div>

                    <!-- Visual Water Counter Display -->
                    <div class="text-center my-8 p-6 rounded-2xl bg-gradient-to-br from-cyan-500/10 via-blue-500/5 to-transparent border border-cyan-200/50 shadow-inner">
                        <div class="inline-flex items-baseline gap-2">
                            <span class="text-5xl font-black text-cyan-600 tracking-tight font-mono">{{ number_format($dailyLog->water_intake_ml) }}</span>
                            <span class="text-xl font-bold text-slate-400">/ 3,000 ml</span>
                        </div>
                        <div class="w-full bg-slate-200/70 h-3.5 rounded-full overflow-hidden mt-4 p-0.5 border border-slate-300/40">
                            <div class="bg-gradient-to-r from-cyan-400 to-blue-600 h-full rounded-full transition-all duration-700 shadow-xs" style="width: {{ min(100, ($dailyLog->water_intake_ml / 3000) * 100) }}%"></div>
                        </div>
                        <p class="text-xs font-extrabold text-slate-500 mt-2.5">
                            {{ round(($dailyLog->water_intake_ml / 3000) * 100) }}% completed today
                        </p>
                    </div>
                </div>

                <!-- Quick Intake Action Controls -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                    <form action="{{ route('fitness.water.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="amount" value="250">
                        <button type="submit"
                            class="w-full bg-cyan-50 hover:bg-cyan-100/80 text-cyan-700 font-extrabold py-3.5 px-4 rounded-xl transition-all duration-200 text-center text-xs border border-cyan-200/60 flex items-center justify-center gap-1.5 shadow-2xs hover:scale-105">
                            <span>💧 +250ml Glass</span>
                        </button>
                    </form>

                    <form action="{{ route('fitness.water.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="amount" value="500">
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-700 hover:to-blue-700 text-white font-extrabold py-3.5 px-4 rounded-xl transition-all duration-200 text-center text-xs flex items-center justify-center gap-1.5 shadow-md shadow-cyan-600/20 hover:scale-105">
                            <span>🍾 +500ml Bottle</span>
                        </button>
                    </form>

                    <form action="{{ route('fitness.water.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="amount" value="-250">
                        <button type="submit"
                            class="w-full bg-slate-100 hover:bg-slate-200 text-slate-600 font-extrabold py-3.5 px-4 rounded-xl transition-all duration-200 text-center text-xs flex items-center justify-center gap-1.5 border border-slate-200 hover:scale-105">
                            <span>↩️ Undo 250ml</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Fitness Workout Activity Logger Card -->
            <div class="bg-white p-7 rounded-2xl shadow-sm border border-slate-200/80 hover:shadow-md transition-all duration-300 space-y-6">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl font-bold shadow-xs">
                            🏃‍♂️
                        </div>
                        <div>
                            <h3 class="text-base font-extrabold text-slate-900">Workout Activity Logger</h3>
                            <p class="text-xs text-slate-500 font-medium">Record physical exercises and energy expenditure</p>
                        </div>
                    </div>
                </div>

                <!-- Activity Form -->
                <form action="{{ route('fitness.exercise.store') }}" method="POST" class="space-y-4 bg-slate-50/80 p-5 rounded-2xl border border-slate-200/60">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Workout Type</label>
                            <select name="exercise_id"
                                class="block w-full rounded-xl border-slate-200 bg-white text-xs font-semibold text-slate-800 shadow-2xs focus:border-amber-500 focus:ring-amber-500 py-2.5">
                                @foreach ($allExercises as $ex)
                                    <option value="{{ $ex->id }}">{{ $ex->name }} ({{ $ex->calories_burn_per_minute }} cal/min)</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Duration (Minutes)</label>
                            <input type="number" name="duration_minutes" value="15" min="1"
                                class="block w-full rounded-xl border-slate-200 bg-white text-xs font-semibold text-slate-800 shadow-2xs focus:border-amber-500 focus:ring-amber-500 py-2.5">
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-slate-900 hover:bg-slate-800 text-white font-extrabold py-3.5 px-4 rounded-xl transition-all duration-200 text-xs shadow-sm flex items-center justify-center gap-2 hover:scale-[1.01]">
                        <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        <span>Log Physical Workout Activity</span>
                    </button>
                </form>

                <!-- Active Burn & Log History -->
                <div>
                    <div class="flex items-center justify-between border-b border-slate-100 pb-2.5 mb-3">
                        <h4 class="text-xs font-black text-slate-700 uppercase tracking-wider">Today's Active Burn</h4>
                        <span class="text-sm font-black text-amber-600 font-mono">
                            -{{ number_format($dailyLog->total_calories_burn ?? 0) }} kcal
                        </span>
                    </div>

                    <div class="space-y-2 max-h-[220px] overflow-y-auto pr-1">
                        @forelse($exerciseLogs as $log)
                            <div class="flex justify-between items-center bg-slate-50/80 p-3.5 rounded-xl border border-slate-200/60 text-xs hover:border-slate-300 transition-all">
                                <div>
                                    <p class="font-extrabold text-slate-900">{{ $log->exercise->name }}</p>
                                    <p class="text-[11px] text-slate-400 font-semibold mt-0.5">{{ $log->duration_minutes }} minutes duration</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="font-black text-amber-600 bg-amber-50 border border-amber-200/60 px-2.5 py-1 rounded-lg font-mono">
                                        -{{ number_format($log->calculated_calories_burn) }} kcal
                                    </span>
                                    <form action="{{ route('fitness.exercise.destroy', $log->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-slate-300 hover:text-rose-500 hover:bg-rose-50 p-1.5 rounded-lg transition-colors" title="Remove Activity">
                                            ✕
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 italic text-center py-6">No physical workouts logged today yet. Keep moving!</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
