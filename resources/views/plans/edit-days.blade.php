<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Configure: {{ $plan->name }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @foreach ($plan->days as $day)
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <h4 class="text-md font-extrabold text-indigo-600 mb-4 border-b pb-2">📅 Day Number:
                    {{ $day->day_number }} Layout Configuration</h4>

                <form action="{{ route('plans.day.update', $day->id) }}" method="POST"
                    class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400">Breakfast Routine</label>
                        <input type="text" name="breakfast_suggestion" value="{{ $day->breakfast_suggestion }}"
                            class="mt-1 block w-full text-sm rounded-lg border-slate-200 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400">Lunch Diet</label>
                        <input type="text" name="lunch_suggestion" value="{{ $day->lunch_suggestion }}"
                            class="mt-1 block w-full text-sm rounded-lg border-slate-200 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400">Dinner Routine</label>
                        <input type="text" name="dinner_suggestion" value="{{ $day->dinner_suggestion }}"
                            class="mt-1 block w-full text-sm rounded-lg border-slate-200 shadow-sm">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold uppercase text-slate-400">Exercise Assignment
                            Instruction</label>
                        <input type="text" name="exercise_suggestion" value="{{ $day->exercise_suggestion }}"
                            class="mt-1 block w-full text-sm rounded-lg border-slate-200 shadow-sm">
                    </div>
                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full bg-slate-900 text-white font-bold h-10 text-xs rounded-lg shadow hover:bg-slate-800 transition">
                            💾 Save Day {{ $day->day_number }} Specs
                        </button>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
</x-app-layout>
