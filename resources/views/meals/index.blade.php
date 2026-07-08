<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('🍳 Daily Meal Tracker') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white p-6 rounded-xl shadow-sm h-fit">
                <h3 class="text-lg font-bold text-gray-700 mb-4">Log a Meal</h3>
                <form action="{{ route('meals.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Select Food</label>
                        <select name="food_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @foreach ($allFoods as $food)
                                <option value="{{ $food->id }}">{{ $food->name }} ({{ $food->calories }} kcal /
                                    {{ $food->serving_size }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Meal Type</label>
                        <select name="meal_type"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="breakfast">Breakfast</option>
                            <option value="lunch">Lunch</option>
                            <option value="dinner">Dinner</option>
                            <option value="snacks">Snacks</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Servings (Multiplier)</label>
                        <input type="number" name="servings" step="0.1" value="1"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition font-bold">
                        + Add to Journal
                    </button>
                </form>
            </div>

            <div class="md:col-span-2 space-y-4">
                <div class="bg-gray-800 text-white p-4 rounded-xl flex justify-between items-center shadow-sm">
                    <span class="font-bold text-lg">Today's Total Intake:</span>
                    <span class="text-2xl font-black text-green-400">{{ $dailyLog->total_calories_intake }} kcal</span>
                </div>

                @foreach (['breakfast', 'lunch', 'dinner', 'snacks'] as $type)
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                        <h4
                            class="text-md font-extrabold text-gray-800 uppercase tracking-wider mb-2 flex items-center justify-between">
                            <span>{{ $type }}</span>
                            <span class="text-sm font-normal text-gray-500">
                                Total: {{ isset($meals[$type]) ? $meals[$type]->sum('calculated_calories') : 0 }} kcal
                            </span>
                        </h4>

                        @if (isset($meals[$type]) && $meals[$type]->count() > 0)
                            <div class="divide-y divide-gray-100">
                                @foreach ($meals[$type] as $log)
                                    <div class="py-3 flex justify-between items-center">
                                        <div>
                                            <p class="font-semibold text-gray-700">{{ $log->food->name }}</p>
                                            <p class="text-xs text-gray-400">Servings: {{ $log->servings }}
                                                ({{ $log->food->serving_size }})</p>
                                        </div>
                                        <div class="flex items-center gap-4">
                                            <span class="font-bold text-gray-700">{{ $log->calculated_calories }}
                                                kcal</span>
                                            <form action="{{ route('meals.destroy', $log->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-500 hover:text-red-700 text-sm">✕</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-400 italic py-2">No food logged for this meal yet.</p>
                        @endif
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
