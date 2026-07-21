<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="font-extrabold text-xl text-slate-900 tracking-tight flex items-center gap-2">
                    🛠️ Customizing Blueprint: {{ $plan->name }}
                </h2>
                <p class="text-xs font-semibold text-slate-500 mt-0.5">Assign target meal menus to each day of the challenge.</p>
            </div>
            <a href="{{ route('plans.index') }}"
                class="bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-extrabold px-3.5 py-2 rounded-none transition-all inline-flex items-center gap-1">
                ← Back to Plans
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">

        @foreach ($plan->days as $day)
            <div class="bg-white p-7 rounded-none shadow-sm border border-slate-200/80 hover:shadow-md transition-shadow space-y-6">
                <!-- Day Header -->
                <div class="flex justify-between items-center border-b border-slate-100 pb-4">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-none bg-indigo-50 text-indigo-700 flex items-center justify-center font-black text-xs font-mono border border-indigo-100">
                            {{ $day->day_number }}
                        </span>
                        <h4 class="text-base font-extrabold text-slate-900">Day {{ $day->day_number }} Schedule</h4>
                    </div>
                    <span class="text-xs font-extrabold text-slate-400 bg-slate-100 px-3 py-1 rounded-full">Target: 3,000ml Water</span>
                </div>

                <!-- Meal Types Grid View -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach (['breakfast', 'lunch', 'dinner', 'snacks'] as $type)
                        <div class="bg-slate-50/80 p-4 rounded-none border border-slate-200/60 flex flex-col justify-between space-y-3">
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-wider text-slate-400 mb-2.5 capitalize flex items-center gap-1">
                                    <span>{{ $type == 'breakfast' ? '🍳' : ($type == 'lunch' ? '🥗' : ($type == 'dinner' ? '🍲' : '🍎')) }}</span>
                                    {{ $type }} Slot
                                </p>
                                <div class="space-y-2">
                                    @php
                                        $dayFoods = $day->planFoods->where('meal_type', $type);
                                    @endphp
                                    @forelse($dayFoods as $pFood)
                                        <div class="text-xs font-medium text-slate-700 bg-white p-2.5 rounded-none border border-slate-200/80 shadow-2xs flex justify-between items-center">
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
                                                    class="text-slate-300 hover:text-rose-500 hover:bg-rose-50 p-1 rounded-none transition-colors"
                                                    title="Remove Item">
                                                    ✕
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
                    class="bg-indigo-50/50 p-4 sm:p-5 rounded-none grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 items-end border border-indigo-100">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-500 tracking-wider mb-1">Choose Global Food</label>
                        <select name="food_id"
                            class="block w-full rounded-none border-slate-200 bg-white text-xs font-semibold text-slate-800 shadow-2xs focus:ring-indigo-500 py-2">
                            @foreach ($allFoods as $food)
                                <option value="{{ $food->id }}">{{ $food->name }} ({{ $food->calories }} kcal / {{ $food->serving_size }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-500 tracking-wider mb-1">Meal Timeline Slot</label>
                        <select name="meal_type"
                            class="block w-full rounded-none border-slate-200 bg-white text-xs font-semibold text-slate-800 shadow-2xs focus:ring-indigo-500 py-2">
                            <option value="breakfast">Breakfast</option>
                            <option value="lunch">Lunch</option>
                            <option value="dinner">Dinner</option>
                            <option value="snacks">Snacks</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-slate-500 tracking-wider mb-1">Serving Multiplier</label>
                        <input type="number" name="servings" value="1" step="0.5" min="0.5"
                            class="block w-full rounded-none border-slate-200 bg-white text-xs font-semibold text-slate-800 shadow-2xs focus:ring-indigo-500 py-2">
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-extrabold h-9 flex items-center justify-center rounded-none transition-all shadow-xs">
                            ＋ Link to Day {{ $day->day_number }}
                        </button>
                    </div>
                </form>
            </div>
        @endforeach

    </div>
</x-app-layout>
