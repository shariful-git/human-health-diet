<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('🎯 Health & Fitness Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-gradient-to-br from-blue-500 to-indigo-600 p-6 rounded-xl shadow-md text-white">
                    <p class="text-sm opacity-80 uppercase font-bold tracking-wider">Your BMI</p>
                    <h3 class="text-3xl font-extrabold mt-1">{{ $profile->bmi }}</h3>
                    <p class="text-xs mt-2 bg-white bg-opacity-20 inline-block px-2 py-1 rounded">
                        {{ $profile->bmi < 18.5 ? 'Underweight' : ($profile->bmi < 25 ? 'Normal Weight' : 'Overweight') }}
                    </p>
                </div>

                <div class="bg-gradient-to-br from-green-500 to-emerald-600 p-6 rounded-xl shadow-md text-white">
                    <p class="text-sm opacity-80 uppercase font-bold tracking-wider">BMR (Metabolism)</p>
                    <h3 class="text-3xl font-extrabold mt-1">{{ $profile->bmr }} <span
                            class="text-sm font-normal">kcal</span></h3>
                    <p class="text-xs mt-2">Basal Metabolic Rate</p>
                </div>

                <div class="bg-gradient-to-br from-orange-500 to-amber-600 p-6 rounded-xl shadow-md text-white">
                    <p class="text-sm opacity-80 uppercase font-bold tracking-wider">TDEE (Burn Goal)</p>
                    <h3 class="text-3xl font-extrabold mt-1">{{ $profile->tdee }} <span
                            class="text-sm font-normal">kcal</span></h3>
                    <p class="text-xs mt-2">Total Daily Energy Expenditure</p>
                </div>

                <div class="bg-gradient-to-br from-rose-500 to-pink-600 p-6 rounded-xl shadow-md text-white">
                    <p class="text-sm opacity-80 uppercase font-bold tracking-wider">Daily Budget Target</p>
                    <h3 class="text-3xl font-extrabold mt-1">{{ $profile->daily_calorie_target }} <span
                            class="text-sm font-normal">kcal</span></h3>
                    <p class="text-xs mt-2 capitalize">Goal: {{ str_replace('_', ' ', $profile->goal) }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-bold text-gray-700">🍳 Calories Budget consumed</h4>
                        <span class="text-sm font-semibold text-gray-500">{{ $todayLog->total_calories_intake }} /
                            {{ $calorieTarget }} kcal</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                        <div class="bg-rose-500 h-4 rounded-full transition-all duration-500"
                            style="width: {{ $caloriePercentage }}%"></div>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">{{ round($caloriePercentage) }}% of your daily limit reached.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-bold text-gray-700">💧 Water Hydration</h4>
                        <span class="text-sm font-semibold text-gray-500">{{ $todayLog->water_intake_ml }} /
                            {{ $waterGoal }} ml</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                        <div class="bg-blue-500 h-4 rounded-full transition-all duration-500"
                            style="width: {{ $waterPercentage }}%"></div>
                    </div>
                    <div class="flex justify-between items-center mt-3">
                        <p class="text-xs text-gray-400">{{ round($waterPercentage) }}% completed today.</p>
                        <a href="{{ route('fitness.index') }}"
                            class="bg-blue-50 text-blue-600 hover:bg-blue-100 text-xs font-bold px-3 py-1 rounded-lg transition">
                            + Log Water
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
