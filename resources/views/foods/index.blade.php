<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-xs font-medium text-slate-500">Catalog</span>
                    <span class="text-slate-300">·</span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                        Nutrition Data
                    </span>
                </div>
                <h2 class="text-xl font-semibold text-slate-900 tracking-tight">
                    Food Database
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Browse verified items or create custom foods for meal logging.</p>
            </div>
            
            <a href="{{ route('foods.create') }}"
                class="inline-flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-medium px-3.5 py-2 rounded-md transition shadow-2xs">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Add Custom Food</span>
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6" x-data="{ searchQuery: '' }">
        @if (session('success'))
            <div class="p-3.5 rounded-md bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-medium flex items-center gap-2">
                <span class="text-emerald-700 font-bold">✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Search Bar -->
        <div class="bg-white p-3 rounded-md border border-slate-200 shadow-2xs flex items-center gap-2.5">
            <svg class="w-4 h-4 text-slate-400 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" x-model="searchQuery" placeholder="Filter foods by name or category..." class="border-0 bg-transparent text-xs text-slate-800 placeholder-slate-400 focus:ring-0 w-full p-0">
            <span x-show="searchQuery" @click="searchQuery = ''" class="text-xs text-slate-400 hover:text-slate-600 cursor-pointer font-medium px-2">Clear</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Custom Foods Section -->
            <div class="lg:col-span-6 space-y-3">
                <div class="flex items-center justify-between pb-1">
                    <div class="flex items-center gap-2">
                        <h3 class="text-sm font-semibold text-slate-900">Custom Foods</h3>
                        <span class="bg-slate-100 text-slate-700 text-[10px] font-medium px-1.5 py-0.5 rounded border border-slate-200">Personal</span>
                    </div>
                    <span class="text-xs text-slate-500 font-mono">{{ $myFoods->count() }} items</span>
                </div>

                @forelse($myFoods as $food)
                    <div x-show="!searchQuery || '{{ strtolower($food->name) }} {{ strtolower($food->category) }}'.includes(searchQuery.toLowerCase())"
                         class="bg-white p-4 rounded-lg border border-slate-200 shadow-2xs space-y-3">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <div class="flex items-center gap-2">
                                    <h4 class="font-semibold text-slate-900 text-xs">{{ $food->name }}</h4>
                                    <span class="text-[10px] font-medium px-1.5 py-0.5 rounded bg-slate-100 text-slate-600 border border-slate-200">{{ $food->category }}</span>
                                </div>
                                <p class="text-xs text-slate-500 mt-0.5">Serving: {{ $food->serving_size }}</p>
                            </div>
                            <div class="text-right shrink-0 bg-slate-50 px-2.5 py-1 rounded border border-slate-200">
                                <span class="text-sm font-semibold text-slate-900 font-mono">{{ $food->calories }}</span>
                                <span class="text-[10px] text-slate-500 font-normal">kcal</span>
                            </div>
                        </div>

                        <!-- Macro breakdown bar -->
                        <div class="grid grid-cols-5 gap-2 pt-2 border-t border-slate-100 text-center text-xs">
                            <div class="bg-slate-50 p-1.5 rounded border border-slate-200">
                                <span class="text-[10px] font-medium text-slate-500 block">Prot</span>
                                <span class="text-xs font-semibold text-slate-800 font-mono">{{ round($food->protein, 1) }}g</span>
                            </div>
                            <div class="bg-slate-50 p-1.5 rounded border border-slate-200">
                                <span class="text-[10px] font-medium text-slate-500 block">Carb</span>
                                <span class="text-xs font-semibold text-slate-800 font-mono">{{ round($food->carbohydrate, 1) }}g</span>
                            </div>
                            <div class="bg-slate-50 p-1.5 rounded border border-slate-200">
                                <span class="text-[10px] font-medium text-slate-500 block">Fat</span>
                                <span class="text-xs font-semibold text-slate-800 font-mono">{{ round($food->fat, 1) }}g</span>
                            </div>
                            <div class="bg-slate-50 p-1.5 rounded border border-slate-200">
                                <span class="text-[10px] font-medium text-slate-500 block">Fiber</span>
                                <span class="text-xs font-semibold text-slate-800 font-mono">{{ round($food->fiber, 1) }}g</span>
                            </div>
                            <div class="bg-slate-50 p-1.5 rounded border border-slate-200">
                                <span class="text-[10px] font-medium text-slate-500 block">Sugar</span>
                                <span class="text-xs font-semibold text-slate-800 font-mono">{{ round($food->sugar, 1) }}g</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-end pt-2 border-t border-slate-100">
                            <a href="{{ route('foods.edit', $food->id) }}"
                                class="text-xs font-medium text-slate-600 hover:text-slate-900 bg-slate-50 hover:bg-slate-100 px-2.5 py-1 rounded border border-slate-200 transition-colors flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                <span>Edit Item</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white border border-dashed border-slate-300 rounded-lg p-6 text-center space-y-2">
                        <h4 class="text-xs font-semibold text-slate-700">No custom items yet</h4>
                        <p class="text-xs text-slate-500">Create custom foods and recipes to use in your daily logs.</p>
                        <div class="pt-1">
                            <a href="{{ route('foods.create') }}" class="inline-flex items-center gap-1 bg-slate-900 hover:bg-slate-800 text-white text-xs font-medium px-3 py-1.5 rounded transition">
                                + Add Food
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Global / System Foods Section -->
            <div class="lg:col-span-6 space-y-3">
                <div class="flex items-center justify-between pb-1">
                    <div class="flex items-center gap-2">
                        <h3 class="text-sm font-semibold text-slate-900">Standard Database</h3>
                        <span class="bg-emerald-50 text-emerald-700 text-[10px] font-medium px-1.5 py-0.5 rounded border border-emerald-200">Verified</span>
                    </div>
                    <span class="text-xs text-slate-500 font-mono">{{ $globalFoods->count() }} items</span>
                </div>

                <div class="space-y-2.5 max-h-[750px] overflow-y-auto pr-1">
                    @forelse($globalFoods as $gFood)
                        <div x-show="!searchQuery || '{{ strtolower($gFood->name) }} {{ strtolower($gFood->category) }}'.includes(searchQuery.toLowerCase())"
                             class="bg-white p-3.5 rounded-lg border border-slate-200 shadow-2xs space-y-2">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-semibold text-slate-900 text-xs">{{ $gFood->name }}</h4>
                                        <span class="text-[10px] font-medium px-1.5 py-0.5 rounded bg-slate-100 text-slate-600 border border-slate-200">{{ $gFood->category }}</span>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-0.5">Serving: {{ $gFood->serving_size }}</p>
                                </div>
                                <div class="text-right shrink-0 bg-slate-50 px-2 py-0.5 rounded border border-slate-200">
                                    <span class="text-xs font-semibold text-slate-800 font-mono">{{ $gFood->calories }}</span>
                                    <span class="text-[10px] text-slate-500 font-normal">kcal</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-2 border-t border-slate-100 text-xs text-slate-500">
                                <div class="flex items-center gap-3 font-mono text-[11px]">
                                    <span>P: <strong class="text-slate-800">{{ round($gFood->protein, 1) }}g</strong></span>
                                    <span>C: <strong class="text-slate-800">{{ round($gFood->carbohydrate, 1) }}g</strong></span>
                                    <span>F: <strong class="text-slate-800">{{ round($gFood->fat, 1) }}g</strong></span>
                                </div>
                                <span class="text-[10px] font-medium text-emerald-700">Verified</span>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white border border-slate-200 rounded-lg p-6 text-center text-xs text-slate-500">
                            No food records available.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
