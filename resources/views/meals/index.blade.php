<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-8">

        <div class="space-y-6">
            <div class="bg-slate-900 text-white p-6 rounded-2xl shadow">
                <h3 class="text-md font-bold text-indigo-400 uppercase tracking-wide">📋 Today's Plan Blueprint Menu</h3>
                <p class="text-xs text-slate-400 mt-1">Real nutritional items linked from your active challenge plan.</p>
            </div>

            @foreach (['breakfast', 'lunch', 'dinner', 'snacks'] as $type)
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                    <h4 class="text-xs font-black text-slate-400 uppercase tracking-wider mb-3">{{ $type }} Plan
                        Recommendation</h4>

                    @if (isset($plannedMeals[$type]) && $plannedMeals[$type]->count() > 0)
                        @foreach ($plannedMeals[$type] as $pFood)
                            <div
                                class="flex justify-between items-center bg-slate-50 p-3 rounded-xl text-sm mb-2 border border-slate-100">
                                <div>
                                    <p class="font-bold text-slate-800">{{ $pFood->food->name }}</p>
                                    <p class="text-[11px] text-slate-400">Specs: {{ $pFood->servings }} Servings
                                        ({{ $pFood->food->calories * $pFood->servings }} kcal | P:
                                        {{ $pFood->food->protein * $pFood->servings }}g)</p>
                                </div>
                                <a href="{{ route('meals.log.plan', $pFood->id) }}"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm transition">
                                    ＋ Eat This
                                </a>
                            </div>
                        @endforeach
                    @else
                        <p class="text-xs text-slate-400 italic">No scheduled item in the plan chart.</p>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="space-y-6">
            <div class="bg-emerald-900 text-emerald-100 p-6 rounded-2xl shadow flex justify-between items-center">
                <div>
                    <h3 class="text-md font-bold text-emerald-400 uppercase tracking-wide">🍳 Actual Intake Consumption
                    </h3>
                    <p class="text-xs text-emerald-200/70 mt-1">What you have legally logged and consumed today.</p>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-black text-white">{{ $summary['calories'] }}</p>
                    <p class="text-[10px] uppercase tracking-widest text-emerald-300">Total Kcal Intake</p>
                </div>
            </div>

            @foreach (['breakfast', 'lunch', 'dinner', 'snacks'] as $type)
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 mb-4">
                    <h4 class="text-xs font-black text-slate-700 uppercase tracking-wider mb-2">{{ $type }}
                        Journal Logs</h4>

                    @if (isset($loggedMeals[$type]) && $loggedMeals[$type]->count() > 0)
                        <div class="divide-y divide-slate-50">
                            @foreach ($loggedMeals[$type] as $log)
                                <div class="py-2.5 flex justify-between items-center text-sm last:border-none">
                                    <div>
                                        <span class="font-semibold text-slate-700">✓ {{ $log->food->name }}</span>
                                        <span class="text-[10px] text-slate-400 block">Servings:
                                            {{ $log->servings }}x</span>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <span class="font-bold text-slate-500">{{ $log->calculated_calories }}
                                            kcal</span>

                                        <!-- 🗑️ রিমুভ/রোলব্যাক করার জন্য ডিলিট ফর্ম ও বাটন -->
                                        <form action="{{ route('meals.destroy', $log->id) }}" method="POST"
                                            onsubmit="return confirm('Remove this item from today\'s intake?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-slate-400 hover:text-red-500 transition-colors text-xs p-1"
                                                title="Remove Item">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-slate-300 italic py-1">Nothing consumed yet.</p>
                    @endif
                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>
