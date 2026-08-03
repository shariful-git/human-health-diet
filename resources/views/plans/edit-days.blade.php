<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="font-extrabold text-xl text-slate-900 tracking-tight flex items-center gap-2">
                    <svg class="w-6 h-6 text-indigo-600 inline-block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Customizing Blueprint: {{ $plan->name }}
                </h2>
                <p class="text-xs font-semibold text-slate-500 mt-0.5">Assign target meal menus to each day of the challenge.</p>
            </div>
            <a href="{{ route('plans.index') }}"
                class="bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-extrabold px-4 py-2 rounded-xl transition-all hover:scale-105 inline-flex items-center gap-1.5">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Back to Plans</span>
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">

        @foreach ($plan->days as $day)
            <div class="bg-white p-7 rounded-2xl shadow-sm border border-slate-200/80 hover:shadow-md transition-all duration-300 space-y-6">
                <!-- Day Header -->
                <div class="flex justify-between items-center border-b border-slate-100 pb-4">
                    <div class="flex items-center gap-3">
                        <span class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center font-black text-xs font-mono border border-indigo-100 shadow-2xs">
                            {{ $day->day_number }}
                        </span>
                        <h4 class="text-base font-extrabold text-slate-900">Day {{ $day->day_number }} Schedule</h4>
                    </div>
                    <span class="text-xs font-extrabold text-slate-400 bg-slate-100 px-3 py-1 rounded-full border border-slate-200/50">Target: 3,000ml Water</span>
                </div>

                <!-- Meal Types Grid View -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach (['breakfast', 'lunch', 'dinner', 'snacks'] as $type)
                        <div class="bg-slate-50/80 p-4 rounded-xl border border-slate-200/60 flex flex-col justify-between space-y-3 hover:border-slate-300 transition-all">
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-wider text-slate-400 mb-2.5 capitalize flex items-center gap-1.5">
                                    @if($type == 'breakfast')
                                        <svg class="w-3.5 h-3.5 text-amber-500 inline-block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                    @elseif($type == 'lunch')
                                        <svg class="w-3.5 h-3.5 text-emerald-500 inline-block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    @elseif($type == 'dinner')
                                        <svg class="w-3.5 h-3.5 text-indigo-500 inline-block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                                    @else
                                        <svg class="w-3.5 h-3.5 text-rose-500 inline-block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                                    @endif
                                    <span>{{ $type }} Slot</span>
                                </p>
                                <div class="space-y-2">
                                    @php
                                        $dayFoods = $day->planFoods->where('meal_type', $type);
                                    @endphp
                                    @forelse($dayFoods as $pFood)
                                        <div class="text-xs font-medium text-slate-700 bg-white p-2.5 rounded-lg border border-slate-200/80 shadow-2xs flex justify-between items-center">
                                            <div>
                                                <p class="font-extrabold text-slate-900 text-xs">{{ $pFood->food->name }}</p>
                                                <p class="text-slate-400 text-[10px] font-semibold mt-0.5">
                                                    {{ $pFood->servings }}x ({{ number_format($pFood->food->calories * $pFood->servings) }} kcal)
                                                </p>
                                            </div>

                                            <form action="{{ route('plans.day.removeFood', $pFood->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Remove this food item from Day {{ $day->day_number }}?');">
                                                @csrf
                                                @method('DELETE')
                                                    <button type="submit"
                                                        class="text-slate-300 hover:text-rose-500 hover:bg-rose-50 p-1 rounded-md transition-colors flex items-center justify-center"
                                                        title="Remove Item">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                                    </button>
                                            </form>
                                        </div>
                                    @empty
                                        <p class="text-[11px] text-slate-400 italic py-1">No items assigned</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Add Food Form -->
                <form action="{{ route('plans.day.addFood', $day->id) }}" method="POST"
                    class="bg-indigo-50/50 p-4 sm:p-5 rounded-xl grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 items-end border border-indigo-100/80">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-500 tracking-wider mb-1">Choose Global Food</label>
                        <select name="food_id"
                            class="block w-full rounded-xl border-slate-200 bg-white text-xs font-semibold text-slate-800 shadow-2xs focus:ring-indigo-500 py-2.5">
                            @foreach ($allFoods as $food)
                                <option value="{{ $food->id }}">{{ $food->name }} ({{ $food->calories }} kcal / {{ $food->serving_size }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-500 tracking-wider mb-1">Meal Timeline Slot</label>
                        <select name="meal_type"
                            class="block w-full rounded-xl border-slate-200 bg-white text-xs font-semibold text-slate-800 shadow-2xs focus:ring-indigo-500 py-2.5">
                            <option value="breakfast">Breakfast</option>
                            <option value="lunch">Lunch</option>
                            <option value="dinner">Dinner</option>
                            <option value="snacks">Snacks</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-500 tracking-wider mb-1">Serving Multiplier</label>
                        <input type="number" name="servings" value="1" step="0.5" min="0.5"
                            class="block w-full rounded-xl border-slate-200 bg-white text-xs font-semibold text-slate-800 shadow-2xs focus:ring-indigo-500 py-2.5">
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-extrabold h-10 flex items-center justify-center gap-1.5 rounded-xl transition-all shadow-xs hover:scale-105">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                            <span>Link to Day {{ $day->day_number }}</span>
                        </button>
                    </div>
                </form>
            </div>
        @endforeach

    </div>
</x-app-layout>
