<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="font-extrabold text-xl text-slate-900 tracking-tight flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-emerald-500 inline-block animate-pulse"></span>
                    Dashboard Analytics & Control
                </h2>
                <p class="text-xs font-semibold text-slate-500 mt-0.5">Welcome back, {{ Auth::user()->name }} — Here is your biometrics and daily activity summary.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('meals.index') }}" class="inline-flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-extrabold px-3.5 py-2 rounded-none shadow-xs transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Log Meal
                </a>
                <a href="{{ route('fitness.index') }}" class="inline-flex items-center gap-1.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-extrabold px-3.5 py-2 rounded-none shadow-xs transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    Log Activity
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Key Metric Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- BMI Card -->
                <div class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-indigo-700 to-slate-900 p-6 rounded-2xl shadow-xl shadow-indigo-600/10 text-white border border-indigo-500/20 group hover:-translate-y-1 hover:shadow-2xl transition-all duration-300">
                    <div class="absolute top-0 right-0 p-6 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                    </div>
                    <p class="text-xs font-extrabold uppercase tracking-wider text-indigo-200">Body Mass Index</p>
                    <div class="flex items-baseline gap-2 mt-2">
                        <h3 class="text-4xl font-black tracking-tight">{{ number_format($profile->bmi, 1) }}</h3>
                        <span class="text-xs text-indigo-300 font-bold">kg/m²</span>
                    </div>
                    <div class="mt-3">
                        <span class="text-[11px] font-extrabold uppercase tracking-wider px-3 py-1 rounded-full bg-white/15 backdrop-blur-md border border-white/20 inline-block shadow-xs">
                            {{ $profile->bmi < 18.5 ? 'Underweight' : ($profile->bmi < 25 ? 'Normal Weight' : 'Overweight') }}
                        </span>
                    </div>
                </div>

                <!-- BMR Card -->
                <div class="relative overflow-hidden bg-gradient-to-br from-emerald-600 via-teal-700 to-slate-900 p-6 rounded-2xl shadow-xl shadow-emerald-600/10 text-white border border-emerald-500/20 group hover:-translate-y-1 hover:shadow-2xl transition-all duration-300">
                    <div class="absolute top-0 right-0 p-6 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24"><path d="M13 3h-2v10h2V3zm4.83 2.17l-1.42 1.42C17.99 7.86 19 9.81 19 12c0 3.87-3.13 7-7 7s-7-3.13-7-7c0-2.19 1.01-4.14 2.58-5.42L6.17 5.17C4.23 6.82 3 9.26 3 12c0 4.97 4.03 9 9 9s9-4.03 9-9c0-2.74-1.23-5.18-3.17-6.83z"/></svg>
                    </div>
                    <p class="text-xs font-extrabold uppercase tracking-wider text-emerald-200">Basal Metabolism (BMR)</p>
                    <div class="flex items-baseline gap-2 mt-2">
                        <h3 class="text-4xl font-black tracking-tight">{{ number_format($profile->bmr) }}</h3>
                        <span class="text-xs text-emerald-300 font-bold">kcal / day</span>
                    </div>
                    <p class="text-[11px] font-semibold text-emerald-200/80 mt-3">Basal Resting Energy Expenditure</p>
                </div>

                <!-- Exercise Burn Card -->
                <div class="relative overflow-hidden bg-gradient-to-br from-amber-500 via-orange-600 to-slate-900 p-6 rounded-2xl shadow-xl shadow-orange-500/10 text-white border border-orange-500/20 group hover:-translate-y-1 hover:shadow-2xl transition-all duration-300">
                    <div class="absolute top-0 right-0 p-6 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24"><path d="M13.5 5.5c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zM9.8 8.9L7 23h2.1l1.8-8 2.1 2v6h2v-7.5l-2.1-2 .6-3C14.8 12 16.8 13 19 13v-2c-1.9 0-3.5-1-4.3-2.4l-1-1.6c-.4-.6-1-1-1.7-1-.3 0-.5.1-.8.1L6 8.3V13h2V9.6l1.8-.7z"/></svg>
                    </div>
                    <p class="text-xs font-extrabold uppercase tracking-wider text-amber-200">Active Calories Burned</p>
                    <div class="flex items-baseline gap-2 mt-2">
                        <h3 class="text-4xl font-black tracking-tight">{{ number_format($todayLog->total_calories_burn ?? 0) }}</h3>
                        <span class="text-xs text-amber-300 font-bold">kcal Today</span>
                    </div>
                    <p class="text-[11px] font-semibold text-amber-200/80 mt-3">From Logged Fitness Workouts</p>
                </div>

                <!-- Streak Card -->
                <div class="relative overflow-hidden bg-gradient-to-br from-rose-600 via-pink-700 to-slate-900 p-6 rounded-2xl shadow-xl shadow-rose-600/10 text-white border border-rose-500/20 group hover:-translate-y-1 hover:shadow-2xl transition-all duration-300">
                    <div class="absolute top-0 right-0 p-6 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24"><path d="M13.5 2.1c0 2.2-1.8 4-4 4s-4-1.8-4-4S7.3.1 9.5.1s4 1.8 4 2zm5 10c0 2.2-1.8 4-4 4s-4-1.8-4-4 1.8-4 4-4 4 1.8 4 4z"/></svg>
                    </div>
                    <p class="text-xs font-extrabold uppercase tracking-wider text-rose-200">Current Health Streak</p>
                    <div class="flex items-baseline gap-2 mt-2">
                        <h3 class="text-4xl font-black tracking-tight flex items-center">
                            <svg class="w-8 h-8 text-rose-400 inline-block me-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 1-4 4-6 1.236 1.6 3.5 4.6 3.5 7.5 0 1.268-.396 2.37-1.071 3.238.455.518.728 1.192.728 1.919z"/></svg>
                            {{ $user->streak?->current_streak ?? 0 }}
                        </h3>
                        <span class="text-xs text-rose-300 font-bold">Days</span>
                    </div>
                    <div class="mt-3">
                        <span class="text-[11px] font-extrabold capitalize px-3 py-1 rounded-full bg-white/15 backdrop-blur-md border border-white/20 inline-block shadow-xs">
                            Goal: {{ str_replace('_', ' ', $profile->goal) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Main Progress Section: Calorie Budget & Water Hydration -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Calories Budget Card -->
                <div class="bg-white p-7 rounded-2xl shadow-sm border border-slate-200/80 flex flex-col justify-between hover:shadow-md transition-all duration-300">
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center font-bold text-lg shadow-2xs">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 1-4 4-6 1.236 1.6 3.5 4.6 3.5 7.5 0 1.268-.396 2.37-1.071 3.238.455.518.728 1.192.728 1.919z"/></svg>
                                </div>
                                <div>
                                    <h4 class="text-base font-extrabold text-slate-900">Calories Budget</h4>
                                    <p class="text-xs text-slate-500 font-medium">Daily Target Matrix</p>
                                </div>
                            </div>
                            <span class="text-xs font-black text-slate-900 bg-slate-100 px-3.5 py-1.5 rounded-xl border border-slate-200/60 shadow-2xs">
                                {{ number_format($summary['calories']) }} / {{ number_format($calorieTarget) }} <span class="text-xs text-slate-500 font-normal">kcal</span>
                            </span>
                        </div>

                        <!-- Progress Bar -->
                        <div class="space-y-2 mt-6">
                            <div class="flex justify-between text-xs font-extrabold text-slate-600">
                                <span>Progress</span>
                                <span>{{ round($caloriePercentage) }}%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-3.5 overflow-hidden p-0.5 border border-slate-200/60 shadow-inner">
                                <div class="bg-gradient-to-r from-rose-500 via-orange-500 to-amber-500 h-full rounded-full transition-all duration-700 shadow-xs" style="width: {{ min(100, $caloriePercentage) }}%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Macro Breakdown Pills -->
                    <div class="grid grid-cols-3 gap-3 mt-8 pt-5 border-t border-slate-100 text-center">
                        <div class="bg-indigo-50/70 p-3.5 rounded-xl border border-indigo-100/70 hover:scale-[1.02] transition-transform">
                            <span class="text-[11px] font-extrabold uppercase text-indigo-600 tracking-wider block">Protein</span>
                            <span class="text-xl font-black text-indigo-950 mt-0.5 block">{{ round($summary['protein']) }}g</span>
                        </div>
                        <div class="bg-amber-50/70 p-3.5 rounded-xl border border-amber-100/70 hover:scale-[1.02] transition-transform">
                            <span class="text-[11px] font-extrabold uppercase text-amber-600 tracking-wider block">Carbs</span>
                            <span class="text-xl font-black text-amber-950 mt-0.5 block">{{ round($summary['carbs']) }}g</span>
                        </div>
                        <div class="bg-rose-50/70 p-3.5 rounded-xl border border-rose-100/70 hover:scale-[1.02] transition-transform">
                            <span class="text-[11px] font-extrabold uppercase text-rose-600 tracking-wider block">Fats</span>
                            <span class="text-xl font-black text-rose-950 mt-0.5 block">{{ round($summary['fat']) }}g</span>
                        </div>
                    </div>
                </div>

                <!-- Water Hydration Card -->
                <div class="bg-white p-7 rounded-2xl shadow-sm border border-slate-200/80 flex flex-col justify-between hover:shadow-md transition-all duration-300">
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center font-bold text-lg shadow-2xs">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2.69l5.66 5.66a8 8 0 11-11.31 0z"/></svg>
                                </div>
                                <div>
                                    <h4 class="text-base font-extrabold text-slate-900">Volumetric Hydration</h4>
                                    <p class="text-xs text-slate-500 font-medium">Daily Fluid Tracking</p>
                                </div>
                            </div>
                            <span class="text-xs font-black text-slate-900 bg-slate-100 px-3.5 py-1.5 rounded-xl border border-slate-200/60 shadow-2xs">
                                {{ number_format($todayLog->water_intake_ml) }} / {{ number_format($waterGoal) }} <span class="text-xs text-slate-500 font-normal">ml</span>
                            </span>
                        </div>

                        <!-- Progress Bar -->
                        <div class="space-y-2 mt-6">
                            <div class="flex justify-between text-xs font-extrabold text-slate-600">
                                <span>Hydration Baseline</span>
                                <span>{{ round($waterPercentage) }}%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-3.5 overflow-hidden p-0.5 border border-slate-200/60 shadow-inner">
                                <div class="bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-600 h-full rounded-full transition-all duration-700 shadow-xs" style="width: {{ min(100, $waterPercentage) }}%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-8 pt-5 border-t border-slate-100">
                        <p class="text-xs font-semibold text-slate-500">{{ round($waterPercentage) }}% of target reached today</p>
                        <a href="{{ route('fitness.index') }}" class="inline-flex items-center gap-1.5 bg-cyan-50 hover:bg-cyan-100/80 text-cyan-700 border border-cyan-200/60 text-xs font-extrabold px-4 py-2 rounded-xl transition-all shadow-2xs hover:scale-105">
                            + Quick Log Water
                        </a>
                    </div>
                </div>
            </div>

            <!-- Active Plan Section -->
            @if ($currentDayPlan)
                <div class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 p-8 rounded-2xl shadow-xl text-white border border-indigo-500/30">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-indigo-500/20 pb-5 mb-6 gap-4">
                        <div>
                            <span class="text-[11px] font-black uppercase tracking-widest text-indigo-400">Currently Active Challenge</span>
                            <h3 class="text-2xl font-black tracking-tight text-white mt-0.5">{{ $user->activePlan->name }}</h3>
                        </div>
                        <div class="inline-flex items-center gap-2 bg-indigo-500/20 border border-indigo-400/30 px-4 py-2 rounded-xl backdrop-blur-md shadow-xs">
                            <span class="w-2 h-2 rounded-full bg-indigo-400 animate-ping"></span>
                            <span class="text-xs font-black tracking-wider text-indigo-200 uppercase">
                                DAY {{ $user->current_plan_day_number }} OF {{ $user->activePlan->duration_days }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        @foreach(['breakfast', 'lunch', 'dinner', 'snacks'] as $mealType)
                            <div class="bg-white/5 p-4 rounded-xl border border-white/10 hover:border-indigo-400/40 hover:bg-white/10 transition-all duration-200 space-y-2">
                                <div class="flex items-center justify-between">
                                    <p class="text-xs font-extrabold text-indigo-300 uppercase tracking-wider capitalize flex items-center gap-1.5">
                                        @if($mealType == 'breakfast')
                                            <svg class="w-4 h-4 text-amber-400 inline-block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                        @elseif($mealType == 'lunch')
                                            <svg class="w-4 h-4 text-emerald-400 inline-block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                        @elseif($mealType == 'dinner')
                                            <svg class="w-4 h-4 text-indigo-400 inline-block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                                        @else
                                            <svg class="w-4 h-4 text-rose-400 inline-block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                                        @endif
                                        <span>{{ $mealType }}</span>
                                    </p>
                                    <span class="text-[10px] text-slate-400 uppercase font-bold">Planned</span>
                                </div>
                                <div class="space-y-1.5 pt-1">
                                    @if(isset($plannedMeals[$mealType]) && $plannedMeals[$mealType]->count() > 0)
                                        @foreach($plannedMeals[$mealType] as $pFood)
                                            <p class="font-semibold text-slate-200 text-xs flex items-center gap-1.5">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                                                <span class="truncate">{{ $pFood->food->name }}</span>
                                                <span class="text-[10px] text-slate-400 shrink-0">({{ $pFood->servings }}x)</span>
                                            </p>
                                        @endforeach
                                    @else
                                        <p class="text-xs text-slate-400 italic">No assigned menu items</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6 text-right">
                        <a href="{{ route('meals.index') }}" class="inline-flex items-center gap-1.5 text-xs font-extrabold text-indigo-400 hover:text-indigo-300 transition-colors">
                            Open Meals Journal to Log Items →
                        </a>
                    </div>
                </div>
            @else
                <div class="bg-white p-10 rounded-2xl border border-dashed border-slate-300 text-center shadow-2xs space-y-3">
                    <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto shadow-2xs">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    </div>
                    <h4 class="text-base font-extrabold text-slate-900">No Active Diet Plan Selected</h4>
                    <p class="text-xs text-slate-500 max-w-md mx-auto">Select or design a custom challenge plan to generate real-time dietary target menus for your daily routines.</p>
                    <div class="pt-2">
                        <a href="{{ route('plans.index') }}" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-extrabold px-5 py-2.5 rounded-xl shadow-xs transition-all hover:scale-105">
                            Browse All Plans & Challenge Models →
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>