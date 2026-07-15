<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('📋 DAILY CHECKLIST & REWARDS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="md:col-span-1 space-y-4">
                <div
                    class="bg-gradient-to-br from-yellow-400 to-orange-500 p-6 rounded-2xl shadow-md text-white text-center">
                    <p class="text-xs uppercase font-extrabold tracking-wider opacity-90">Total Reward Points</p>
                    <h3 class="text-4xl font-black mt-2">⭐ {{ $rewardPoints }}</h3>
                    <p class="text-xs mt-2 bg-black bg-opacity-10 inline-block px-3 py-1 rounded-full">Future Gifts
                        Locked 🔒</p>
                </div>

                <div class="bg-gray-900 p-6 rounded-2xl shadow-md text-white text-center">
                    <p class="text-xs uppercase font-extrabold tracking-wider text-orange-400">🔥 Current Streak</p>
                    <h3 class="text-4xl font-black mt-2">
                        {{ $user->streak?->current_streak ?? 0 }}
                        <span class="text-lg font-normal text-gray-400">Days</span>
                    </h3>
                    <p class="text-xs text-gray-400 mt-2">Personal Best: {{ $user->streak?->longest_streak ?? 0 }} Days
                    </p>
                </div>
            </div>

            <div
                class="md:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                <div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Today's Goals Checklist</h3>
                    <p class="text-xs text-gray-400 mb-6">Complete your essential routines to unlock your daily rewards.
                    </p>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                            <div class="flex items-center gap-3">
                                <span class="text-xl">🍳</span>
                                <div>
                                    <p class="font-bold text-gray-700 text-sm">Log Your Meals</p>
                                    <p class="text-xs text-gray-400">Add breakfast, lunch, or dinner</p>
                                </div>
                            </div>
                            <span>{!! $breakfastDone || $lunchDone || $dinnerDone || $snacksDone ? '✅' : '❌' !!}</span>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                            <div class="flex items-center gap-3">
                                <span class="text-xl">💧</span>
                                <div>
                                    <p class="font-bold text-gray-700 text-sm">Hydration Goal</p>
                                    <p class="text-xs text-gray-400">Drink minimum target (Current:
                                        {{ $dailyLog->water_intake_ml }}ml)</p>
                                </div>
                            </div>
                            <span>{!! $waterDone ? '✅' : '❌' !!}</span>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                            <div class="flex items-center gap-3">
                                <span class="text-xl">🏃‍♂️</span>
                                <div>
                                    <p class="font-bold text-gray-700 text-sm">Physical Activity</p>
                                    <p class="text-xs text-gray-400">Log at least one physical workout (Burned:
                                        {{ $dailyLog->total_calories_burn ?? 0 }} kcal)</p>
                                </div>
                            </div>
                            <span>{!! $exerciseDone ? '✅' : '❌' !!}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    @if ($dailyLog->is_completed)
                        <button disabled
                            class="w-full bg-emerald-100 text-emerald-600 font-bold py-3 rounded-xl text-center cursor-not-allowed">
                            🎉 Day Successfully Completed!
                        </button>
                    @else
                        <form action="{{ route('checklist.complete') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-xl text-center shadow-md transition">
                                🚀 Complete My Day & Claim Reward
                            </button>
                        </form>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
