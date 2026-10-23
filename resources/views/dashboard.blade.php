<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-xs font-medium text-slate-500">{{ date('l, F j, Y') }}</span>
                    <span class="text-slate-300">·</span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                        Active
                    </span>
                </div>
                <h2 class="text-xl font-semibold text-slate-900 tracking-tight">
                    Dashboard
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Welcome back, {{ Auth::user()->name }}. Here is your health and nutrition overview for today.</p>
            </div>
            
            <div class="flex items-center gap-2">
                <a href="{{ route('meals.index') }}" class="inline-flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-medium px-3.5 py-2 rounded-md transition border border-transparent shadow-2xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>Log Meal</span>
                </a>
                <a href="{{ route('fitness.index') }}" class="inline-flex items-center gap-1.5 bg-white hover:bg-slate-50 text-slate-700 text-xs font-medium px-3.5 py-2 rounded-md transition border border-slate-300 shadow-2xs">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    <span>Log Activity</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <!-- Metric Cards Box Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                
                <!-- BMI Card -->
                <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-2xs flex flex-col justify-between">
                    <div class="flex items-center justify-between text-slate-500">
                        <span class="text-xs font-medium uppercase tracking-wider">BMI</span>
                        <div class="w-8 h-8 rounded-md bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="flex items-baseline gap-2">
                            <span class="text-3xl font-semibold text-slate-900 font-mono">{{ number_format($profile->bmi, 1) }}</span>
                            <span class="text-xs text-slate-500 font-medium">kg/m²</span>
                        </div>
                        <div class="mt-3">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium border {{ $profile->bmi < 18.5 ? 'bg-amber-50 text-amber-700 border-amber-200' : ($profile->bmi < 25 ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-rose-50 text-rose-700 border-rose-200') }}">
                                {{ $profile->bmi < 18.5 ? 'Underweight' : ($profile->bmi < 25 ? 'Normal weight' : 'Overweight') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- BMR Card -->
                <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-2xs flex flex-col justify-between">
                    <div class="flex items-center justify-between text-slate-500">
                        <span class="text-xs font-medium uppercase tracking-wider">Basal Metabolic Rate</span>
                        <div class="w-8 h-8 rounded-md bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="flex items-baseline gap-2">
                            <span class="text-3xl font-semibold text-slate-900 font-mono">{{ number_format($profile->bmr) }}</span>
                            <span class="text-xs text-slate-500 font-medium">kcal/day</span>
                        </div>
                        <p class="text-xs text-slate-500 mt-3">Estimated baseline calories at rest</p>
                    </div>
                </div>

                <!-- Exercise Burn Card -->
                <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-2xs flex flex-col justify-between">
                    <div class="flex items-center justify-between text-slate-500">
                        <span class="text-xs font-medium uppercase tracking-wider">Workout Burn</span>
                        <div class="w-8 h-8 rounded-md bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 1-4 4-6 1.236 1.6 3.5 4.6 3.5 7.5 0 1.268-.396 2.37-1.071 3.238.455.518.728 1.192.728 1.919z"/></svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="flex items-baseline gap-2">
                            <span class="text-3xl font-semibold text-slate-900 font-mono">{{ number_format($todayLog->total_calories_burn ?? 0) }}</span>
                            <span class="text-xs text-slate-500 font-medium">kcal burned</span>
                        </div>
                        <p class="text-xs text-slate-500 mt-3">Total logged activities today</p>
                    </div>
                </div>

                <!-- Streak Card -->
                <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-2xs flex flex-col justify-between">
                    <div class="flex items-center justify-between text-slate-500">
                        <span class="text-xs font-medium uppercase tracking-wider">Logging Streak</span>
                        <div class="w-8 h-8 rounded-md bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="flex items-baseline gap-2">
                            <span class="text-3xl font-semibold text-slate-900 font-mono">{{ $user->streak?->current_streak ?? 0 }}</span>
                            <span class="text-xs text-slate-500 font-medium">consecutive days</span>
                        </div>
                        <div class="mt-3">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-slate-100 text-slate-700 border border-slate-200 capitalize">
                                Goal: {{ str_replace('_', ' ', $profile->goal) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Sections: Calorie Budget & Water Intake -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Calories Budget Card -->
                <div class="bg-white p-6 rounded-lg border border-slate-200 shadow-2xs flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-sm font-semibold text-slate-900">Calorie Budget</h3>
                                <p class="text-xs text-slate-500 mt-0.5">Daily consumption vs target goal</p>
                            </div>
                            <span class="text-xs font-semibold text-slate-700 bg-slate-50 px-2.5 py-1 rounded border border-slate-200 font-mono">
                                {{ number_format($summary['calories']) }} / {{ number_format($calorieTarget) }} kcal
                            </span>
                        </div>

                        <!-- Progress Bar -->
                        <div class="space-y-1.5 mt-5">
                            <div class="flex justify-between text-xs text-slate-600 font-medium">
                                <span>Intake</span>
                                <span class="font-mono">{{ round($caloriePercentage) }}%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded h-2.5 overflow-hidden">
                                <div class="bg-emerald-600 h-full rounded transition-all duration-300" style="width: {{ min(100, $caloriePercentage) }}%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Macro Breakdown -->
                    <div class="grid grid-cols-3 gap-3 mt-6 pt-5 border-t border-slate-100 text-center">
                        <div class="bg-slate-50 p-3 rounded border border-slate-200">
                            <span class="text-[11px] font-medium uppercase text-slate-500 tracking-wider block">Protein</span>
                            <span class="text-lg font-semibold text-slate-900 font-mono mt-0.5 block">{{ round($summary['protein']) }}g</span>
                        </div>
                        <div class="bg-slate-50 p-3 rounded border border-slate-200">
                            <span class="text-[11px] font-medium uppercase text-slate-500 tracking-wider block">Carbs</span>
                            <span class="text-lg font-semibold text-slate-900 font-mono mt-0.5 block">{{ round($summary['carbs']) }}g</span>
                        </div>
                        <div class="bg-slate-50 p-3 rounded border border-slate-200">
                            <span class="text-[11px] font-medium uppercase text-slate-500 tracking-wider block">Fats</span>
                            <span class="text-lg font-semibold text-slate-900 font-mono mt-0.5 block">{{ round($summary['fat']) }}g</span>
                        </div>
                    </div>
                </div>

                <!-- Water Tracker Card -->
                <div class="bg-white p-6 rounded-lg border border-slate-200 shadow-2xs flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-sm font-semibold text-slate-900">Water Intake</h3>
                                <p class="text-xs text-slate-500 mt-0.5">Hydration status for today</p>
                            </div>
                            <span class="text-xs font-semibold text-slate-700 bg-slate-50 px-2.5 py-1 rounded border border-slate-200 font-mono">
                                {{ number_format($todayLog->water_intake_ml) }} / {{ number_format($waterGoal) }} ml
                            </span>
                        </div>

                        <!-- Progress Bar -->
                        <div class="space-y-1.5 mt-5">
                            <div class="flex justify-between text-xs text-slate-600 font-medium">
                                <span>Hydration Target</span>
                                <span class="font-mono">{{ round($waterPercentage) }}%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded h-2.5 overflow-hidden">
                                <div class="bg-sky-500 h-full rounded transition-all duration-300" style="width: {{ min(100, $waterPercentage) }}%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-3 mt-6 pt-5 border-t border-slate-100">
                        <p class="text-xs text-slate-500">{{ round($waterPercentage) }}% of your daily water goal achieved</p>
                        <a href="{{ route('fitness.index') }}" class="inline-flex items-center justify-center gap-1.5 bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-300 text-xs font-medium px-3 py-1.5 rounded-md transition shadow-2xs">
                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            <span>Add Water</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Active Diet Plan Box -->
            @if ($currentDayPlan)
                <div class="bg-white p-6 rounded-lg border border-slate-200 shadow-2xs">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-slate-100 pb-4 mb-5 gap-3">
                        <div>
                            <span class="text-[11px] font-semibold uppercase tracking-wider text-emerald-700">Active Diet Plan</span>
                            <h3 class="text-base font-semibold text-slate-900 mt-0.5">{{ $user->activePlan->name }}</h3>
                        </div>
                        <div class="inline-flex items-center gap-2 bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-md">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span class="text-xs font-medium text-slate-700 uppercase font-mono">
                                Day {{ $user->current_plan_day_number }} of {{ $user->activePlan->duration_days }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        @foreach(['breakfast', 'lunch', 'dinner', 'snacks'] as $mealType)
                            <div class="bg-slate-50 p-4 rounded-md border border-slate-200 space-y-2">
                                <div class="flex items-center justify-between border-b border-slate-200/60 pb-2">
                                    <p class="text-xs font-semibold text-slate-700 uppercase tracking-wider capitalize">
                                        {{ $mealType }}
                                    </p>
                                    <span class="text-[10px] text-slate-400 font-mono">Planned</span>
                                </div>
                                <div class="space-y-1.5 pt-1">
                                    @if(isset($plannedMeals[$mealType]) && $plannedMeals[$mealType]->count() > 0)
                                        @foreach($plannedMeals[$mealType] as $pFood)
                                            <p class="font-medium text-slate-700 text-xs flex items-center justify-between gap-2">
                                                <span class="truncate">{{ $pFood->food->name }}</span>
                                                <span class="text-[10px] text-slate-400 shrink-0 font-mono">{{ $pFood->servings }}x</span>
                                            </p>
                                        @endforeach
                                    @else
                                        <p class="text-xs text-slate-400 italic">No items scheduled</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 text-right">
                        <a href="{{ route('meals.index') }}" class="inline-flex items-center gap-1 text-xs font-medium text-slate-600 hover:text-slate-900 transition-colors">
                            <span>Go to Meals Journal</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            @else
                <div class="bg-white p-8 rounded-lg border border-dashed border-slate-300 text-center space-y-3">
                    <div class="w-10 h-10 rounded-md bg-slate-100 text-slate-600 flex items-center justify-center mx-auto border border-slate-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-slate-900">No active diet plan</h4>
                        <p class="text-xs text-slate-500 max-w-sm mx-auto mt-0.5">Select an existing meal plan or build a custom diet schedule to track daily planned meals.</p>
                    </div>
                    <div class="pt-1">
                        <a href="{{ route('plans.index') }}" class="inline-flex items-center gap-1.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-medium px-4 py-2 rounded-md transition shadow-2xs">
                            <span>Browse Meal Plans</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>