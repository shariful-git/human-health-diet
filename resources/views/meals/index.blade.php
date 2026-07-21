<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="font-extrabold text-xl text-slate-900 tracking-tight flex items-center gap-2">
                    🍳 Meal Planning & Daily Intake Journal
                </h2>
                <p class="text-xs font-semibold text-slate-500 mt-0.5">Compare your scheduled blueprint menu against logged intake.</p>
            </div>
            <div class="inline-flex items-center gap-2 bg-slate-900 text-white text-xs font-extrabold px-3.5 py-2 rounded-none shadow-xs">
                <span>Today's Intake:</span>
                <span class="text-emerald-400 font-mono text-sm">{{ number_format($summary['calories']) }} kcal</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- Column 1: Plan Blueprint Menu -->
        <div class="space-y-6">
            <div class="bg-gradient-to-br from-slate-900 to-indigo-950 text-white p-6 rounded-none shadow-lg border border-indigo-500/20">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-indigo-400">Blueprint Target</span>
                        <h3 class="text-lg font-black text-white mt-0.5">📋 Recommended Challenge Menu</h3>
                    </div>
                    <span class="text-xs font-extrabold bg-indigo-500/20 text-indigo-200 border border-indigo-400/30 px-3 py-1 rounded-full">
                        Active Plan
                    </span>
                </div>
                <p class="text-xs text-slate-300 mt-2">Nutritional items automatically generated from your active fitness & diet plan.</p>
            </div>

            @foreach (['breakfast', 'lunch', 'dinner', 'snacks'] as $type)
                <div class="bg-white p-6 rounded-none shadow-sm border border-slate-200/80 hover:shadow-md transition-shadow space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <div class="flex items-center gap-2">
                            <span class="text-base">{{ $type == 'breakfast' ? '🍳' : ($type == 'lunch' ? '🥗' : ($type == 'dinner' ? '🍲' : '🍎')) }}</span>
                            <h4 class="text-xs font-black text-slate-900 uppercase tracking-wider">{{ $type }} Blueprint</h4>
                        </div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase">Recommended</span>
                    </div>

                    @if (isset($plannedMeals[$type]) && $plannedMeals[$type]->count() > 0)
                        <div class="space-y-2.5">
                            @foreach ($plannedMeals[$type] as $pFood)
                                <div class="flex justify-between items-center bg-slate-50/80 p-3.5 rounded-none border border-slate-200/60 hover:border-slate-300 transition-all">
                                    <div>
                                        <p class="font-extrabold text-slate-800 text-sm">{{ $pFood->food->name }}</p>
                                        <div class="flex items-center gap-2 text-[11px] text-slate-500 mt-0.5">
                                            <span class="font-bold text-slate-700">{{ $pFood->servings }} Servings</span>
                                            <span>•</span>
                                            <span class="font-semibold text-emerald-600">{{ number_format($pFood->food->calories * $pFood->servings) }} kcal</span>
                                            <span>•</span>
                                            <span class="font-semibold text-indigo-600">P: {{ round($pFood->food->protein * $pFood->servings) }}g</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('meals.log.plan', $pFood->id) }}"
                                        class="inline-flex items-center gap-1 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-extrabold px-3 py-1.5 rounded-none shadow-xs transition-all">
                                        <span>＋ Eat This</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-slate-400 italic py-2">No scheduled items in this menu slot.</p>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Column 2: Actual Intake Consumption -->
        <div class="space-y-6">
            <div class="bg-gradient-to-br from-emerald-700 via-teal-800 to-slate-900 text-white p-6 rounded-none shadow-lg border border-emerald-500/20 flex justify-between items-center">
                <div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-emerald-300">Verified Consumption</span>
                    <h3 class="text-lg font-black text-white mt-0.5">🍳 Actual Intake Logs</h3>
                    <p class="text-xs text-emerald-200/80 mt-1">Real-time record of consumed nutrients today.</p>
                </div>
                <div class="text-right bg-white/10 backdrop-blur-md px-4 py-2 rounded-none border border-white/15">
                    <p class="text-2xl font-black text-white font-mono">{{ number_format($summary['calories']) }}</p>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-emerald-200">Kcal Consumed</p>
                </div>
            </div>

            @foreach (['breakfast', 'lunch', 'dinner', 'snacks'] as $type)
                <div class="bg-white p-6 rounded-none shadow-sm border border-slate-200/80 hover:shadow-md transition-shadow space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <div class="flex items-center gap-2">
                            <span class="text-base">{{ $type == 'breakfast' ? '🍳' : ($type == 'lunch' ? '🥗' : ($type == 'dinner' ? '🍲' : '🍎')) }}</span>
                            <h4 class="text-xs font-black text-slate-900 uppercase tracking-wider">{{ $type }} Consumed</h4>
                        </div>
                        <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full uppercase">Logged</span>
                    </div>

                    @if (isset($loggedMeals[$type]) && $loggedMeals[$type]->count() > 0)
                        <div class="divide-y divide-slate-100">
                            @foreach ($loggedMeals[$type] as $log)
                                <div class="py-3 flex justify-between items-center text-sm first:pt-0 last:pb-0">
                                    <div>
                                        <p class="font-extrabold text-slate-800 flex items-center gap-1.5">
                                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                            {{ $log->food->name }}
                                        </p>
                                        <span class="text-[11px] text-slate-400 font-semibold block mt-0.5">Quantity: {{ $log->servings }}x serving</span>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <span class="font-black text-slate-900 bg-slate-100 px-2.5 py-1 rounded-none text-xs font-mono">
                                            {{ number_format($log->calculated_calories) }} kcal
                                        </span>

                                        <form action="{{ route('meals.destroy', $log->id) }}" method="POST"
                                            onsubmit="return confirm('Remove this item from today\'s intake?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-slate-300 hover:text-rose-500 hover:bg-rose-50 p-1.5 rounded-none transition-colors"
                                                title="Remove Item">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <p class="text-xs text-slate-400 italic py-2">Nothing logged for this meal slot yet.</p>
                    @endif
                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>
