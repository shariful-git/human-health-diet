<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-xl text-slate-900 tracking-tight flex items-center gap-2">
                    <svg class="w-6 h-6 text-emerald-600 inline-block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    Food Database & Personal Items
                </h2>
                <p class="text-xs font-semibold text-slate-500 mt-0.5">Explore global system food database or add custom food items for your personal diet plan.</p>
            </div>
            <a href="{{ route('foods.create') }}"
                class="inline-flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-extrabold px-4 py-2.5 rounded-xl shadow-xs transition-all hover:scale-105">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Add Custom Food Item</span>
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        @if (session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- My Custom Foods Section -->
            <div class="lg:col-span-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <h3 class="text-base font-extrabold text-slate-900">My Personal Foods</h3>
                        <span class="bg-indigo-100 text-indigo-700 text-[10px] font-black uppercase px-2 py-0.5 rounded-full">Personal</span>
                    </div>
                    <span class="text-xs font-bold text-slate-400 font-mono">{{ $myFoods->count() }} Items</span>
                </div>

                @forelse($myFoods as $food)
                    <div class="bg-white p-5 rounded-2xl border border-indigo-100 shadow-xs hover:shadow-md transition-all space-y-3">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <div class="flex items-center gap-2">
                                    <h4 class="font-extrabold text-slate-900 text-sm">{{ $food->name }}</h4>
                                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-slate-100 text-slate-600">{{ $food->category }}</span>
                                </div>
                                <p class="text-xs text-slate-500 font-medium mt-0.5">Serving: <span class="font-bold text-slate-700">{{ $food->serving_size }}</span></p>
                            </div>
                            <div class="text-right shrink-0">
                                <span class="text-base font-black text-emerald-600">{{ $food->calories }}</span>
                                <span class="text-[10px] font-bold text-slate-400 block">kcal</span>
                            </div>
                        </div>

                        <!-- Macro breakdown bar -->
                        <div class="grid grid-cols-5 gap-1.5 pt-2 border-t border-slate-100 text-center">
                            <div class="bg-slate-50 p-1.5 rounded-lg">
                                <span class="text-[10px] font-bold text-slate-400 block">Protein</span>
                                <span class="text-xs font-extrabold text-slate-800">{{ round($food->protein, 1) }}g</span>
                            </div>
                            <div class="bg-slate-50 p-1.5 rounded-lg">
                                <span class="text-[10px] font-bold text-slate-400 block">Carbs</span>
                                <span class="text-xs font-extrabold text-slate-800">{{ round($food->carbohydrate, 1) }}g</span>
                            </div>
                            <div class="bg-slate-50 p-1.5 rounded-lg">
                                <span class="text-[10px] font-bold text-slate-400 block">Fat</span>
                                <span class="text-xs font-extrabold text-slate-800">{{ round($food->fat, 1) }}g</span>
                            </div>
                            <div class="bg-slate-50 p-1.5 rounded-lg">
                                <span class="text-[10px] font-bold text-slate-400 block">Fiber</span>
                                <span class="text-xs font-extrabold text-slate-800">{{ round($food->fiber, 1) }}g</span>
                            </div>
                            <div class="bg-slate-50 p-1.5 rounded-lg">
                                <span class="text-[10px] font-bold text-slate-400 block">Sugar</span>
                                <span class="text-xs font-extrabold text-slate-800">{{ round($food->sugar, 1) }}g</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-100">
                            <a href="{{ route('foods.edit', $food->id) }}"
                                class="text-xs font-extrabold text-indigo-600 hover:text-indigo-800 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg transition-colors flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit
                            </a>
                            <form action="{{ route('foods.destroy', $food->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this food item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-xs font-extrabold text-rose-600 hover:text-rose-800 bg-rose-50 hover:bg-rose-100 px-3 py-1.5 rounded-lg transition-colors flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="bg-slate-50 border border-dashed border-slate-300 rounded-2xl p-8 text-center space-y-3">
                        <div class="w-12 h-12 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h4 class="text-sm font-extrabold text-slate-800">No Custom Foods Added Yet</h4>
                        <p class="text-xs text-slate-500 max-w-sm mx-auto">You haven't added any personal food items. Add custom recipes or specialized items to use in your daily meal logs and plans.</p>
                        <a href="{{ route('foods.create') }}" class="inline-flex items-center gap-1 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold px-4 py-2 rounded-xl transition-all">
                            + Add Your First Custom Food
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Global / System Foods Section -->
            <div class="lg:col-span-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <h3 class="text-base font-extrabold text-slate-900">Global Admin Foods</h3>
                        <span class="bg-emerald-100 text-emerald-700 text-[10px] font-black uppercase px-2 py-0.5 rounded-full">Available to All</span>
                    </div>
                    <span class="text-xs font-bold text-slate-400 font-mono">{{ $globalFoods->count() }} Items</span>
                </div>

                <div class="space-y-3 max-h-[700px] overflow-y-auto pr-1">
                    @forelse($globalFoods as $gFood)
                        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-2xs hover:shadow-xs transition-all space-y-2">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-extrabold text-slate-900 text-sm">{{ $gFood->name }}</h4>
                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-slate-100 text-slate-600">{{ $gFood->category }}</span>
                                    </div>
                                    <p class="text-xs text-slate-500 font-medium mt-0.5">Serving: <span class="font-bold text-slate-700">{{ $gFood->serving_size }}</span></p>
                                </div>
                                <div class="text-right shrink-0">
                                    <span class="text-base font-black text-slate-800">{{ $gFood->calories }}</span>
                                    <span class="text-[10px] font-bold text-slate-400 block">kcal</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-2 border-t border-slate-100 text-xs text-slate-500 font-medium">
                                <div class="flex items-center gap-3">
                                    <span>Prot: <strong class="text-slate-800">{{ round($gFood->protein, 1) }}g</strong></span>
                                    <span>Carb: <strong class="text-slate-800">{{ round($gFood->carbohydrate, 1) }}g</strong></span>
                                    <span>Fat: <strong class="text-slate-800">{{ round($gFood->fat, 1) }}g</strong></span>
                                </div>
                                <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">Global</span>
                            </div>
                        </div>
                    @empty
                        <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 text-center text-xs text-slate-500">
                            No global food items found in system.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
