<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-xs font-medium text-slate-500">{{ date('l, F j, Y') }}</span>
                    <span class="text-slate-300">·</span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                        Daily Meals
                    </span>
                </div>
                <h2 class="text-xl font-semibold text-slate-900 tracking-tight">
                    Meals Journal
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Compare planned meals with your actual logged intake today.</p>
            </div>
            
            <div class="inline-flex items-center gap-2 bg-white px-3.5 py-2 rounded-md border border-slate-200 shadow-2xs">
                <span class="text-xs font-medium text-slate-600">Total Intake:</span>
                <span class="text-emerald-700 font-mono font-semibold text-sm">{{ number_format($summary['calories']) }} <span class="text-xs font-normal text-slate-500">kcal</span></span>
            </div>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <!-- Summary Macro Row -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div class="bg-white p-4 rounded-lg border border-slate-200 shadow-2xs text-center">
                <span class="text-[11px] font-medium uppercase text-slate-500 tracking-wider">Calories</span>
                <p class="text-xl font-semibold text-slate-900 font-mono mt-0.5">{{ number_format($summary['calories']) }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg border border-slate-200 shadow-2xs text-center">
                <span class="text-[11px] font-medium uppercase text-slate-500 tracking-wider">Protein</span>
                <p class="text-xl font-semibold text-slate-900 font-mono mt-0.5">{{ round($summary['protein']) }}g</p>
            </div>
            <div class="bg-white p-4 rounded-lg border border-slate-200 shadow-2xs text-center">
                <span class="text-[11px] font-medium uppercase text-slate-500 tracking-wider">Carbs</span>
                <p class="text-xl font-semibold text-slate-900 font-mono mt-0.5">{{ round($summary['carbs']) }}g</p>
            </div>
            <div class="bg-white p-4 rounded-lg border border-slate-200 shadow-2xs text-center">
                <span class="text-[11px] font-medium uppercase text-slate-500 tracking-wider">Fats</span>
                <p class="text-xl font-semibold text-slate-900 font-mono mt-0.5">{{ round($summary['fat']) }}g</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Column 1: Planned Challenge Meals -->
            <div class="space-y-4">
                <div class="bg-white p-4 rounded-lg border border-slate-200 shadow-2xs flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-semibold text-slate-900">Planned Meals</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Items suggested by your current diet plan</p>
                    </div>
                    <span class="text-xs font-medium text-slate-600 bg-slate-50 border border-slate-200 px-2.5 py-1 rounded">
                        Active Plan
                    </span>
                </div>

                @foreach (['breakfast', 'lunch', 'dinner', 'snacks'] as $type)
                    <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-2xs space-y-3">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-2.5">
                            <h4 class="text-xs font-semibold text-slate-800 uppercase tracking-wider">{{ $type }}</h4>
                            <span class="text-[10px] text-slate-400 uppercase font-mono">Suggested</span>
                        </div>

                        @if (isset($plannedMeals[$type]) && $plannedMeals[$type]->count() > 0)
                            <div class="space-y-2">
                                @foreach ($plannedMeals[$type] as $pFood)
                                    <div class="flex justify-between items-center bg-slate-50 p-3 rounded-md border border-slate-200">
                                        <div>
                                            <p class="font-medium text-slate-900 text-xs">{{ $pFood->food->name }}</p>
                                            <div class="flex items-center gap-2 text-[11px] text-slate-500 mt-0.5">
                                                <span>{{ $pFood->servings }} Servings</span>
                                                <span>•</span>
                                                <span class="font-mono">{{ number_format($pFood->food->calories * $pFood->servings) }} kcal</span>
                                                <span>•</span>
                                                <span class="font-mono">P: {{ round($pFood->food->protein * $pFood->servings) }}g</span>
                                            </div>
                                        </div>
                                        <a href="{{ route('meals.log.plan', $pFood->id) }}"
                                            class="inline-flex items-center gap-1 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-medium px-2.5 py-1.5 rounded transition shadow-2xs">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            <span>Eat This</span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-xs text-slate-400 italic py-1">No scheduled plan items for this meal.</p>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Column 2: Logged Meals -->
            <div class="space-y-4">
                <div class="bg-white p-4 rounded-lg border border-slate-200 shadow-2xs flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-semibold text-slate-900">Logged Meals</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Actual items consumed today</p>
                    </div>
                    <span class="text-xs font-medium text-emerald-700 bg-emerald-50 border border-emerald-200 px-2.5 py-1 rounded">
                        Logged
                    </span>
                </div>

                @foreach (['breakfast', 'lunch', 'dinner', 'snacks'] as $type)
                    <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-2xs space-y-3">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-2.5">
                            <h4 class="text-xs font-semibold text-slate-800 uppercase tracking-wider">{{ $type }}</h4>
                            <span class="text-[10px] text-slate-400 font-mono uppercase">Logged</span>
                        </div>

                        @if (isset($loggedMeals[$type]) && $loggedMeals[$type]->count() > 0)
                            <div class="divide-y divide-slate-100">
                                @foreach ($loggedMeals[$type] as $log)
                                    <div class="py-2.5 flex justify-between items-center text-xs first:pt-0 last:pb-0">
                                        <div>
                                            <p class="font-medium text-slate-900 flex items-center gap-1.5">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                {{ $log->food->name }}
                                            </p>
                                            <span class="text-[11px] text-slate-400 font-mono block mt-0.5">Portion: {{ $log->servings }}x serving</span>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <span class="font-medium text-slate-700 bg-slate-50 px-2 py-0.5 rounded text-xs font-mono border border-slate-200">
                                                {{ number_format($log->calculated_calories) }} kcal
                                            </span>

                                            <form action="{{ route('meals.destroy', $log->id) }}" method="POST"
                                                onsubmit="return confirm('Remove this item from today\'s intake?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-slate-400 hover:text-rose-600 hover:bg-slate-100 p-1.5 rounded transition"
                                                    title="Remove item">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-xs text-slate-400 italic py-1">Nothing logged for this meal yet.</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</x-app-layout>
