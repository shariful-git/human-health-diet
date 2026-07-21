<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="font-extrabold text-xl text-slate-900 tracking-tight flex items-center gap-2">
                    📋 Daily Habit Checklist & Rewards
                </h2>
                <p class="text-xs font-semibold text-slate-500 mt-0.5">Complete your core daily health targets to build streaks and earn points.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Rewards & Streak Stats Column -->
            <div class="md:col-span-1 space-y-5">
                <!-- Rewards Points Card -->
                <div class="relative overflow-hidden bg-gradient-to-br from-amber-400 via-orange-500 to-amber-600 p-6 rounded-none shadow-xl text-white text-center border border-amber-300/30">
                    <div class="absolute -top-6 -right-6 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
                    <p class="text-xs uppercase font-black tracking-widest text-amber-100">Total Reward Points</p>
                    <h3 class="text-5xl font-black mt-2 font-mono drop-shadow-xs">⭐ {{ number_format($rewardPoints) }}</h3>
                    <div class="mt-4">
                        <span class="text-[11px] font-extrabold bg-black/20 backdrop-blur-md px-3.5 py-1.5 rounded-full inline-flex items-center gap-1.5 border border-white/20">
                            🔒 Tier Perks Locked
                        </span>
                    </div>
                </div>

                <!-- Streak Card -->
                <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-indigo-950 p-6 rounded-none shadow-xl text-white text-center border border-slate-700/50 space-y-2">
                    <span class="text-2xl">🔥</span>
                    <p class="text-xs uppercase font-black tracking-widest text-orange-400">Current Health Streak</p>
                    <h3 class="text-4xl font-black font-mono">
                        {{ $user->streak?->current_streak ?? 0 }}
                        <span class="text-base font-bold text-slate-400">Days</span>
                    </h3>
                    <p class="text-xs text-slate-400 font-medium pt-1 border-t border-slate-700/60 mt-3">
                        Personal Best Record: <span class="font-bold text-emerald-400">{{ $user->streak?->longest_streak ?? 0 }} Days</span>
                    </p>
                </div>
            </div>

            <!-- Daily Goals Checklist Card -->
            <div class="md:col-span-2 bg-white p-7 rounded-none shadow-sm border border-slate-200/80 hover:shadow-md transition-shadow flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
                        <div>
                            <h3 class="text-lg font-extrabold text-slate-900">Today's Essential Routine Checklist</h3>
                            <p class="text-xs text-slate-500 font-medium mt-0.5">Fulfill all 3 core targets to seal today's routine.</p>
                        </div>
                        <span class="text-xs font-bold text-indigo-700 bg-indigo-50 px-3 py-1 rounded-full border border-indigo-200/50">
                            Daily Quests
                        </span>
                    </div>

                    <div class="space-y-4">
                        <!-- Quest 1: Meals -->
                        <div class="flex items-center justify-between p-4 bg-slate-50/80 rounded-none border border-slate-200/60 transition-all">
                            <div class="flex items-center gap-3.5">
                                <div class="w-10 h-10 rounded-none bg-orange-100/70 text-orange-600 flex items-center justify-center text-xl font-bold">
                                    🍳
                                </div>
                                <div>
                                    <p class="font-extrabold text-slate-900 text-sm">Meal Journal Logging</p>
                                    <p class="text-xs text-slate-500 font-medium">Log breakfast, lunch, or dinner items</p>
                                </div>
                            </div>
                            <div>
                                @if($breakfastDone || $lunchDone || $dinnerDone || $snacksDone)
                                    <span class="inline-flex items-center gap-1 bg-emerald-100 text-emerald-700 font-extrabold text-xs px-3 py-1.5 rounded-none border border-emerald-200">
                                        ✓ Completed
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 bg-slate-200/60 text-slate-500 font-bold text-xs px-3 py-1.5 rounded-none">
                                        Pending
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Quest 2: Hydration -->
                        <div class="flex items-center justify-between p-4 bg-slate-50/80 rounded-none border border-slate-200/60 transition-all">
                            <div class="flex items-center gap-3.5">
                                <div class="w-10 h-10 rounded-none bg-cyan-100/70 text-cyan-600 flex items-center justify-center text-xl font-bold">
                                    💧
                                </div>
                                <div>
                                    <p class="font-extrabold text-slate-900 text-sm">Volumetric Hydration Target</p>
                                    <p class="text-xs text-slate-500 font-medium">Current: {{ number_format($dailyLog->water_intake_ml) }} ml</p>
                                </div>
                            </div>
                            <div>
                                @if($waterDone)
                                    <span class="inline-flex items-center gap-1 bg-emerald-100 text-emerald-700 font-extrabold text-xs px-3 py-1.5 rounded-none border border-emerald-200">
                                        ✓ Completed
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 bg-slate-200/60 text-slate-500 font-bold text-xs px-3 py-1.5 rounded-none">
                                        Pending
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Quest 3: Exercise -->
                        <div class="flex items-center justify-between p-4 bg-slate-50/80 rounded-none border border-slate-200/60 transition-all">
                            <div class="flex items-center gap-3.5">
                                <div class="w-10 h-10 rounded-none bg-amber-100/70 text-amber-600 flex items-center justify-center text-xl font-bold">
                                    🏃‍♂️
                                </div>
                                <div>
                                    <p class="font-extrabold text-slate-900 text-sm">Physical Workout Activity</p>
                                    <p class="text-xs text-slate-500 font-medium">Burned: {{ number_format($dailyLog->total_calories_burn ?? 0) }} kcal</p>
                                </div>
                            </div>
                            <div>
                                @if($exerciseDone)
                                    <span class="inline-flex items-center gap-1 bg-emerald-100 text-emerald-700 font-extrabold text-xs px-3 py-1.5 rounded-none border border-emerald-200">
                                        ✓ Completed
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 bg-slate-200/60 text-slate-500 font-bold text-xs px-3 py-1.5 rounded-none">
                                        Pending
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    @if ($dailyLog->is_completed)
                        <div class="w-full bg-emerald-50 border border-emerald-200 text-emerald-700 font-extrabold py-4 rounded-none text-center text-sm flex items-center justify-center gap-2 shadow-2xs">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>🎉 Day Successfully Completed & Rewards Logged!</span>
                        </div>
                    @else
                        <form action="{{ route('checklist.complete') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-emerald-600 to-teal-700 hover:from-emerald-700 hover:to-teal-800 text-white font-extrabold py-4 rounded-none text-center text-sm shadow-md shadow-emerald-600/20 transition-all flex items-center justify-center gap-2">
                                🚀 Complete My Day & Claim Reward Points
                            </button>
                        </form>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
