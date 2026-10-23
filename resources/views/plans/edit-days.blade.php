<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-xs font-medium text-slate-500">Diet Plans</span>
                    <span class="text-slate-300">·</span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-slate-100 text-slate-700 border border-slate-200">
                        {{ $plan->name }}
                    </span>
                </div>
                <h2 class="text-xl font-semibold text-slate-900 tracking-tight">
                    Edit Meal Plan Days
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Assign foods and portion sizes for each day of {{ $plan->name }}.</p>
            </div>
            <a href="{{ route('plans.index') }}"
                class="inline-flex items-center gap-1.5 bg-white hover:bg-slate-50 text-slate-700 text-xs font-medium px-3.5 py-2 rounded-md border border-slate-300 shadow-2xs transition">
                <span>← Back to Plans</span>
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        @foreach ($plan->days as $day)
            <div class="bg-white p-6 rounded-lg border border-slate-200 shadow-2xs space-y-5">
                <!-- Day Header -->
                <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                    <div class="flex items-center gap-2.5">
                        <span class="w-7 h-7 rounded bg-slate-900 text-white flex items-center justify-center font-semibold text-xs font-mono">
                            {{ $day->day_number }}
                        </span>
                        <div>
                            <h4 class="text-sm font-semibold text-slate-900">Day {{ $day->day_number }} Meals</h4>
                            <p class="text-xs text-slate-500">Scheduled menu items</p>
                        </div>
                    </div>
                    <span class="text-xs font-medium text-slate-500 bg-slate-50 px-2.5 py-1 rounded border border-slate-200 font-mono">
                        Target: 3,000ml Water
                    </span>
                </div>

                <!-- Meal Types Grid View -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                    @foreach (['breakfast', 'lunch', 'dinner', 'snacks'] as $type)
                        <div class="bg-slate-50 p-3.5 rounded-md border border-slate-200 flex flex-col justify-between space-y-2">
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-700 mb-2 capitalize">
                                    {{ $type }}
                                </p>
                                <div class="space-y-1.5">
                                    @php
                                        $dayFoods = $day->planFoods->where('meal_type', $type);
                                    @endphp
                                    @forelse($dayFoods as $pFood)
                                        <div class="text-xs text-slate-700 bg-white p-2 rounded border border-slate-200 shadow-2xs flex justify-between items-center gap-2">
                                            <div>
                                                <p class="font-medium text-slate-900 text-xs truncate max-w-[120px]">{{ $pFood->food->name }}</p>
                                                <p class="text-slate-400 text-[10px] font-mono">
                                                    {{ $pFood->servings }}x ({{ number_format($pFood->food->calories * $pFood->servings) }} kcal)
                                                </p>
                                            </div>

                                            <form action="{{ route('plans.day.removeFood', $pFood->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Remove item from Day {{ $day->day_number }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-slate-400 hover:text-rose-600 hover:bg-slate-50 p-1 rounded transition"
                                                    title="Remove">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    @empty
                                        <p class="text-[11px] text-slate-400 italic py-0.5">No items assigned</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Add Food Form -->
                <form action="{{ route('plans.day.addFood', $day->id) }}" method="POST"
                    class="bg-slate-50 p-3.5 rounded-md grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-end border border-slate-200">
                    @csrf
                    <div>
                        <label class="block text-[11px] font-medium text-slate-700 mb-1">Food Item</label>
                        <select name="food_id"
                            class="block w-full rounded border-slate-300 bg-white text-xs text-slate-800 focus:border-emerald-600 focus:ring-emerald-600 py-1.5 px-2">
                            @foreach ($allFoods as $food)
                                <option value="{{ $food->id }}">{{ $food->name }} ({{ $food->calories }} kcal)</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-medium text-slate-700 mb-1">Meal Slot</label>
                        <select name="meal_type"
                            class="block w-full rounded border-slate-300 bg-white text-xs text-slate-800 focus:border-emerald-600 focus:ring-emerald-600 py-1.5 px-2">
                            <option value="breakfast">Breakfast</option>
                            <option value="lunch">Lunch</option>
                            <option value="dinner">Dinner</option>
                            <option value="snacks">Snacks</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-medium text-slate-700 mb-1">Servings</label>
                        <input type="number" name="servings" value="1" step="0.5" min="0.5"
                            class="block w-full rounded border-slate-300 bg-white text-xs text-slate-800 focus:border-emerald-600 focus:ring-emerald-600 py-1.5 px-2 font-mono">
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-medium h-[34px] flex items-center justify-center gap-1 rounded transition shadow-2xs">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            <span>Add to Day {{ $day->day_number }}</span>
                        </button>
                    </div>
                </form>
            </div>
        @endforeach

    </div>
</x-app-layout>
