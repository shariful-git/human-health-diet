<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('🎯 HEALTH & FITNESS DASHBOARD') }}
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
                    <h3 class="text-3xl font-extrabold mt-1">{{ $profile->bmr }} <span class="text-sm font-normal">kcal</span></h3>
                    <p class="text-xs mt-2">Basal Metabolic Rate</p>
                </div>

                <div class="bg-gradient-to-br from-orange-500 to-amber-600 p-6 rounded-xl shadow-md text-white">
                    <p class="text-sm opacity-80 uppercase font-bold tracking-wider">Exercise Burn</p>
                    <h3 class="text-3xl font-extrabold mt-1">-{{ $todayLog->total_calories_burn ?? 0 }} <span class="text-sm font-normal">kcal</span></h3>
                    <p class="text-xs mt-2">Active Calories Burned Today</p>
                </div>

                <div class="bg-gradient-to-br from-rose-500 to-pink-600 p-6 rounded-xl shadow-md text-white">
                    <p class="text-sm opacity-80 uppercase font-bold tracking-wider">Current Streak</p>
                    <h3 class="text-3xl font-extrabold mt-1">🔥 {{ $user->streak?->current_streak ?? 0 }} <span class="text-sm font-normal">Days</span></h3>
                    <p class="text-xs mt-2 capitalize">Goal: {{ str_replace('_', ' ', $profile->goal) }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-lg font-bold text-gray-700">🍳 Calories Budget consumed</h4>
                            <span class="text-sm font-semibold text-gray-500">
                                {{ $summary['calories'] }} / {{ $calorieTarget }} kcal
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                            <div class="bg-rose-500 h-4 rounded-full transition-all duration-500" style="width: {{ $caloriePercentage }}%"></div>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">{{ round($caloriePercentage) }}% of your daily limit reached.</p>
                    </div>

                    <div class="grid grid-cols-3 gap-2 mt-6 pt-4 border-t border-gray-100 text-center">
                        <div>
                            <span class="text-xs font-bold text-gray-500 block">Protein</span>
                            <span class="text-sm font-extrabold text-indigo-600">{{ round($summary['protein']) }}g</span>
                        </div>
                        <div>
                            <span class="text-xs font-bold text-gray-500 block">Carbs</span>
                            <span class="text-sm font-extrabold text-amber-600">{{ round($summary['carbs']) }}g</span>
                        </div>
                        <div>
                            <span class="text-xs font-bold text-gray-500 block">Fats</span>
                            <span class="text-sm font-extrabold text-rose-600">{{ round($summary['fat']) }}g</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-lg font-bold text-gray-700">💧 Water Hydration</h4>
                            <span class="text-sm font-semibold text-gray-500">
                                {{ $todayLog->water_intake_ml }} / {{ $waterGoal }} ml
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                            <div class="bg-blue-500 h-4 rounded-full transition-all duration-500" style="width: {{ $waterPercentage }}%"></div>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center mt-6">
                        <p class="text-xs text-gray-400">{{ round($waterPercentage) }}% completed today.</p>
                        <a href="{{ route('fitness.index') }}" class="bg-blue-50 text-blue-600 hover:bg-blue-100 text-xs font-bold px-4 py-2 rounded-lg transition shadow-sm">
                            + Log Water
                        </a>
                    </div>
                </div>
            </div>

            @if ($currentDayPlan)
                <div class="bg-gradient-to-r from-slate-900 to-indigo-950 p-6 rounded-2xl shadow-lg text-white mb-6 border border-indigo-500/20">
                    <div class="flex justify-between items-center border-b border-slate-800 pb-3 mb-4">
                        <div>
                            <span class="text-xs uppercase tracking-widest text-indigo-400 font-bold">Currently Following</span>
                            <h3 class="text-xl font-black">{{ $user->activePlan->name }}</h3>
                        </div>
                        <span class="bg-indigo-600 text-xs font-black px-4 py-2 rounded-xl">
                            DAY {{ $user->current_plan_day_number }} OF {{ $user->activePlan->duration_days }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-sm">
                        @foreach(['breakfast', 'lunch', 'dinner', 'snacks'] as $mealType)
                            <div class="bg-white/5 p-4 rounded-xl border border-white/5 hover:border-indigo-500/30 transition">
                                <p class="text-xs font-bold text-indigo-400 uppercase tracking-wider">⏱️ {{ $mealType }} Menu</p>
                                <div class="mt-2 space-y-1">
                                    @if(isset($plannedMeals[$mealType]) && $plannedMeals[$mealType]->count() > 0)
                                        @foreach($plannedMeals[$mealType] as $pFood)
                                            <p class="font-semibold text-slate-200 text-xs">• {{ $pFood->food->name }} ({{ $pFood->servings }}x)</p>
                                        @endforeach
                                    @else
                                        <p class="text-xs text-slate-500 italic">No assigned items</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 text-right">
                        <a href="{{ route('meals.index') }}" class="text-xs font-bold text-indigo-400 hover:underline">Open Meals Journal to Log Content →</a>
                    </div>
                </div>
            @else
                <div class="bg-white p-8 rounded-2xl border border-dashed border-slate-300 text-center mb-6 shadow-sm">
                    <p class="text-sm text-slate-500 italic">
                        You don't have any active plan. 
                        <a href="{{ route('plans.index') }}" class="text-indigo-600 font-bold underline hover:text-indigo-800 transition">
                            Choose a Plan
                        </a> to start your structured diet journey!
                    </p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>