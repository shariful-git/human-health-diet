<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-xs font-medium text-slate-500">{{ date('l, F j, Y') }}</span>
                    <span class="text-slate-300">·</span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                        Daily Habits
                    </span>
                </div>
                <h2 class="text-xl font-semibold text-slate-900 tracking-tight">
                    Daily Checklist & Streaks
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Complete your daily nutrition and activity habits to keep your streak active.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Stats Column -->
            <div class="md:col-span-1 space-y-4">
                <!-- Rewards Points Box -->
                <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-2xs text-center">
                    <p class="text-xs uppercase font-medium tracking-wider text-slate-500">Reward Points</p>
                    <h3 class="text-3xl font-semibold text-slate-900 mt-2 font-mono">
                        {{ number_format($rewardPoints) }}
                    </h3>
                    <div class="mt-3">
                        <span class="text-[11px] font-medium bg-slate-100 text-slate-700 px-2.5 py-1 rounded border border-slate-200 inline-block">
                            Points Balance
                        </span>
                    </div>
                </div>

                <!-- Streak Box -->
                <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-2xs text-center space-y-2">
                    <div class="w-8 h-8 rounded-md bg-slate-50 text-slate-600 flex items-center justify-center mx-auto border border-slate-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 1-4 4-6 1.236 1.6 3.5 4.6 3.5 7.5 0 1.268-.396 2.37-1.071 3.238.455.518.728 1.192.728 1.919z"/></svg>
                    </div>
                    <p class="text-xs uppercase font-medium tracking-wider text-slate-500">Current Streak</p>
                    <h3 class="text-3xl font-semibold text-slate-900 font-mono">
                        {{ $user->streak?->current_streak ?? 0 }}
                        <span class="text-xs font-normal text-slate-500">days</span>
                    </h3>
                    <div class="pt-2 border-t border-slate-100 text-xs text-slate-500">
                        Longest streak: <span class="font-medium text-slate-800 font-mono">{{ $user->streak?->longest_streak ?? 0 }} days</span>
                    </div>
                </div>
            </div>

            <!-- Daily Goals Checklist Box -->
            <div class="md:col-span-2 bg-white p-6 rounded-lg border border-slate-200 shadow-2xs flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-5">
                        <div>
                            <h3 class="text-sm font-semibold text-slate-900">Today's Checklist</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Complete all 3 core targets for today</p>
                        </div>
                        <span class="text-xs font-medium text-slate-600 bg-slate-50 px-2.5 py-1 rounded border border-slate-200">
                            Daily Targets
                        </span>
                    </div>

                    <div class="space-y-3">
                        <!-- Item 1: Meals -->
                        <div class="flex items-center justify-between p-3.5 bg-slate-50 rounded-md border border-slate-200">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-md bg-white text-slate-600 flex items-center justify-center border border-slate-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                </div>
                                <div>
                                    <p class="font-medium text-slate-900 text-xs">Meal Journal Entry</p>
                                    <p class="text-xs text-slate-500">Log at least one meal to maintain nutrition records</p>
                                </div>
                            </div>
                            <div>
                                @if($breakfastDone || $lunchDone || $dinnerDone || $snacksDone)
                                    <span class="inline-flex items-center gap-1 bg-emerald-50 text-emerald-700 font-medium text-xs px-2.5 py-1 rounded border border-emerald-200">
                                        ✓ Completed
                                    </span>
                                @else
                                    <span class="inline-flex items-center bg-slate-100 text-slate-500 font-medium text-xs px-2.5 py-1 rounded border border-slate-200">
                                        Pending
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Item 2: Hydration -->
                        <div class="flex items-center justify-between p-3.5 bg-slate-50 rounded-md border border-slate-200">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-md bg-white text-slate-600 flex items-center justify-center border border-slate-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2.69l5.66 5.66a8 8 0 11-11.31 0z"/></svg>
                                </div>
                                <div>
                                    <p class="font-medium text-slate-900 text-xs">Water Intake Goal</p>
                                    <p class="text-xs text-slate-500 font-mono">Logged: {{ number_format($dailyLog->water_intake_ml) }} / 3,000 ml</p>
                                </div>
                            </div>
                            <div>
                                @if($waterDone)
                                    <span class="inline-flex items-center gap-1 bg-emerald-50 text-emerald-700 font-medium text-xs px-2.5 py-1 rounded border border-emerald-200">
                                        ✓ Completed
                                    </span>
                                @else
                                    <span class="inline-flex items-center bg-slate-100 text-slate-500 font-medium text-xs px-2.5 py-1 rounded border border-slate-200">
                                        Pending
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Item 3: Exercise -->
                        <div class="flex items-center justify-between p-3.5 bg-slate-50 rounded-md border border-slate-200">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-md bg-white text-slate-600 flex items-center justify-center border border-slate-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                </div>
                                <div>
                                    <p class="font-medium text-slate-900 text-xs">Workout Burn</p>
                                    <p class="text-xs text-slate-500 font-mono">Burned: {{ number_format($dailyLog->total_calories_burn ?? 0) }} kcal</p>
                                </div>
                            </div>
                            <div>
                                @if($exerciseDone)
                                    <span class="inline-flex items-center gap-1 bg-emerald-50 text-emerald-700 font-medium text-xs px-2.5 py-1 rounded border border-emerald-200">
                                        ✓ Completed
                                    </span>
                                @else
                                    <span class="inline-flex items-center bg-slate-100 text-slate-500 font-medium text-xs px-2.5 py-1 rounded border border-slate-200">
                                        Pending
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-100">
                    @if ($dailyLog->is_completed)
                        <div class="w-full bg-emerald-50 border border-emerald-200 text-emerald-800 font-medium py-3 rounded-md text-center text-xs flex items-center justify-center gap-2">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Day finalized and streak points granted.</span>
                        </div>
                    @else
                        <form action="{{ route('checklist.complete') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2.5 rounded-md text-center text-xs shadow-2xs transition flex items-center justify-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Complete Day & Claim Reward Points</span>
                            </button>
                        </form>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
