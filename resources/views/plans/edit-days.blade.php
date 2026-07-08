<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                🛠️ Customizing Blueprint: {{ $plan->name }}
            </h2>
            <a href="{{ route('plans.index') }}"
                class="bg-gray-800 text-white text-xs font-bold px-4 py-2 rounded-xl">Back to Plans</a>
        </div>
    </x-slot>

    <div class="py-12 max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">

        @foreach ($plan->days as $day)
            <!-- প্রতিটি দিনের জন্য একটি ডেডিকেটেড কন্টেইনার বক্স -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 space-y-6">
                <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                    <h4 class="text-md font-black text-indigo-600">📅 Day Plan: Number {{ $day->day_number }}</h4>
                    <span class="text-xs font-bold text-slate-400">Target: 3000ml Water</span>
                </div>

                <!-- ১. কারেন্টলি এই দিনে যে যে খাবারগুলো ইউজার অ্যাসাইন করেছে তার লাইভ গ্রিড -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    @foreach (['breakfast', 'lunch', 'dinner', 'snacks'] as $type)
                        <div class="bg-slate-50 p-3 rounded-xl border border-slate-100 flex flex-col justify-between">
                            <div>
                                <p class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400 mb-2">
                                    {{ $type }} Menu
                                </p>
                                <div class="space-y-1.5">
                                    @php
                                        $dayFoods = $day->planFoods->where('meal_type', $type);
                                    @endphp
                                    @forelse($dayFoods as $pFood)
                                        <div
                                            class="text-[11px] font-medium text-slate-700 bg-white p-2 rounded-lg border border-slate-200 shadow-sm flex justify-between items-center">
                                            <div>
                                                <p class="font-bold text-slate-800">{{ $pFood->food->name }}</p>
                                                <p class="text-slate-400 text-[10px] mt-0.5">{{ $pFood->servings }}x
                                                    ({{ $pFood->food->calories * $pFood->servings }} kcal)</p>
                                            </div>

                                            <form action="{{ route('plans.day.removeFood', $pFood->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Remove this food from this plan day?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-slate-300 hover:text-red-500 transition-colors text-sm p-0.5"
                                                    title="Remove Link">
                                                    ✕
                                                </button>
                                            </form>
                                        </div>
                                    @empty
                                        <p class="text-[11px] text-slate-300 italic py-1">No items</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- ২. সাধারণ ইউজার এই দিনের বক্সে নতুন খাবার পুশ করার জন্য লাইভ ফর্ম ইনপুট -->
                <form action="{{ route('plans.day.addFood', $day->id) }}" method="POST"
                    class="bg-indigo-50/40 p-4 rounded-xl grid grid-cols-1 md:grid-cols-4 gap-4 items-end border border-indigo-100/30">
                    @csrf
                    <div>
                        <label class="block text-[11px] font-bold uppercase text-slate-500">Choose Global Food</label>
                        <select name="food_id"
                            class="mt-1 block w-full rounded-xl border-slate-200 text-xs shadow-sm focus:ring-indigo-500">
                            @foreach ($allFoods as $food)
                                <option value="{{ $food->id }}">{{ $food->name }} ({{ $food->calories }} kcal /
                                    {{ $food->serving_size }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold uppercase text-slate-500">Meal Timeline Slot</label>
                        <select name="meal_type"
                            class="mt-1 block w-full rounded-xl border-slate-200 text-xs shadow-sm focus:ring-indigo-500">
                            <option value="breakfast">Breakfast</option>
                            <option value="lunch">Lunch</option>
                            <option value="dinner">Dinner</option>
                            <option value="snacks">Snacks</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold uppercase text-slate-500">Serving Multiplier</label>
                        <input type="number" name="servings" value="1" step="0.5" min="0.5"
                            class="mt-1 block w-full rounded-xl border-slate-200 text-xs shadow-sm focus:ring-indigo-500">
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold h-9 flex items-center justify-center rounded-xl transition shadow-md shadow-indigo-100">
                            ＋ Link to Day {{ $day->day_number }}
                        </button>
                    </div>
                </form>
            </div>
        @endforeach

    </div>
</x-app-layout>
