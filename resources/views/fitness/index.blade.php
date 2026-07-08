<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('💪 Water & Exercise Tracker') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between">
                <div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">💧 Water Hydration Journal</h3>
                    <p class="text-sm text-gray-500 mb-6">Track your daily water goal (Target: 3000 ml)</p>

                    <div class="text-center my-6">
                        <span class="text-5xl font-black text-blue-600">{{ $dailyLog->water_intake_ml }}</span>
                        <span class="text-xl text-gray-400"> / 3000 ml</span>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <form action="{{ route('fitness.water.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="amount" value="250">
                        <button type="submit"
                            class="w-full bg-blue-50 text-blue-600 hover:bg-blue-100 font-bold py-3 px-4 rounded-xl transition text-center text-sm">
                            + 250ml (Glass)
                        </button>
                    </form>

                    <form action="{{ route('fitness.water.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="amount" value="500">
                        <button type="submit"
                            class="w-full bg-blue-600 text-white hover:bg-blue-700 font-bold py-3 px-4 rounded-xl transition text-center text-sm shadow-md">
                            + 500ml (Bottle)
                        </button>
                    </form>

                    <form action="{{ route('fitness.water.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="amount" value="-250">
                        <button type="submit"
                            class="w-full bg-gray-100 text-gray-500 hover:bg-gray-200 font-bold py-3 px-4 rounded-xl transition text-center text-sm">
                            Undo 250ml
                        </button>
                    </form>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="text-xl font-bold text-gray-800 mb-4">🏃‍♂️ Log an Activity / Workout</h3>

                <form action="{{ route('fitness.exercise.store') }}" method="POST"
                    class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase">Workout Type</label>
                        <select name="exercise_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            @foreach ($allExercises as $ex)
                                <option value="{{ $ex->id }}">{{ $ex->name }}
                                    ({{ $ex->calories_burn_per_minute }} cal/min)</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase">Duration (Minutes)</label>
                        <div class="flex gap-2">
                            <input type="number" name="duration_minutes" value="15" min="1"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            <button type="submit"
                                class="mt-1 bg-gray-800 text-white px-4 rounded-md hover:bg-gray-900 transition font-bold text-sm">
                                Log
                            </button>
                        </div>
                    </div>
                </form>

                <h4 class="text-sm font-bold text-gray-700 border-b pb-2 mb-3">Today's Active Burn: <span
                        class="text-orange-600 font-extrabold">{{ $dailyLog->total_calories_burn }} kcal</span></h4>
                <div class="space-y-2 max-h-[180px] overflow-y-auto">
                    @forelse($exerciseLogs as $log)
                        <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg text-sm">
                            <div>
                                <p class="font-bold text-gray-700">{{ $log->exercise->name }}</p>
                                <p class="text-xs text-gray-400">{{ $log->duration_minutes }} Mins worked out</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="font-extrabold text-orange-500">-{{ $log->calculated_calories_burn }}
                                    kcal</span>
                                <form action="{{ route('fitness.exercise.destroy', $log->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-500">✕</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-400 italic text-center py-4">No exercises logged today yet. Keep
                            moving!</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
