<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-xs font-medium text-slate-500">Food Catalog</span>
                    <span class="text-slate-300">·</span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-slate-100 text-slate-700 border border-slate-200">
                        New Item
                    </span>
                </div>
                <h2 class="text-xl font-semibold text-slate-900 tracking-tight">
                    Add Custom Food
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Enter food specifications and macronutrients to add to your personal catalog.</p>
            </div>
            <a href="{{ route('foods.index') }}"
                class="inline-flex items-center gap-1.5 bg-white hover:bg-slate-50 text-slate-700 text-xs font-medium px-3.5 py-2 rounded-md border border-slate-300 shadow-2xs transition">
                <span>← Back to Catalog</span>
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ route('foods.store') }}" method="POST" class="bg-white p-6 rounded-lg border border-slate-200 shadow-2xs space-y-6">
            @csrf

            <div class="border-b border-slate-100 pb-3">
                <h3 class="text-sm font-semibold text-slate-900">Food Details</h3>
                <p class="text-xs text-slate-500 mt-0.5">Name, meal category, and serving quantity.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-slate-700 mb-1.5">Food Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. Oatmeal with Almond Milk"
                        class="w-full text-xs rounded-md border-slate-300 focus:border-emerald-600 focus:ring-emerald-600 py-2 px-3">
                    @error('name') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-700 mb-1.5">Meal Category *</label>
                    <select name="category" required class="w-full text-xs rounded-md border-slate-300 focus:border-emerald-600 focus:ring-emerald-600 py-2 px-3">
                        <option value="Breakfast" {{ old('category') == 'Breakfast' ? 'selected' : '' }}>Breakfast</option>
                        <option value="Lunch" {{ old('category') == 'Lunch' ? 'selected' : '' }}>Lunch</option>
                        <option value="Dinner" {{ old('category') == 'Dinner' ? 'selected' : '' }}>Dinner</option>
                        <option value="Snacks" {{ old('category') == 'Snacks' ? 'selected' : '' }}>Snacks</option>
                        <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('category') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-700 mb-1.5">Calories (kcal) *</label>
                    <input type="number" name="calories" value="{{ old('calories') }}" required placeholder="e.g. 250" min="0"
                        class="w-full text-xs rounded-md border-slate-300 focus:border-emerald-600 focus:ring-emerald-600 py-2 px-3 font-mono">
                    @error('calories') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-700 mb-1.5">Serving Size *</label>
                    <input type="text" name="serving_size" value="{{ old('serving_size', '100g') }}" required placeholder="e.g. 100g, 1 cup"
                        class="w-full text-xs rounded-md border-slate-300 focus:border-emerald-600 focus:ring-emerald-600 py-2 px-3 font-mono">
                    @error('serving_size') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="border-b border-slate-100 pb-3 pt-2">
                <h3 class="text-sm font-semibold text-slate-900">Macronutrients & Minerals</h3>
                <p class="text-xs text-slate-500 mt-0.5">Quantities per serving portion.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <div class="bg-slate-50 p-3 rounded-md border border-slate-200">
                    <label class="block text-xs font-medium text-slate-700 mb-1">Protein (g)</label>
                    <input type="number" step="0.01" min="0" name="protein" value="{{ old('protein', 0) }}"
                        class="w-full text-xs rounded border-slate-300 focus:border-emerald-600 focus:ring-emerald-600 py-1.5 px-2.5 font-mono">
                </div>

                <div class="bg-slate-50 p-3 rounded-md border border-slate-200">
                    <label class="block text-xs font-medium text-slate-700 mb-1">Carbohydrates (g)</label>
                    <input type="number" step="0.01" min="0" name="carbohydrate" value="{{ old('carbohydrate', 0) }}"
                        class="w-full text-xs rounded border-slate-300 focus:border-emerald-600 focus:ring-emerald-600 py-1.5 px-2.5 font-mono">
                </div>

                <div class="bg-slate-50 p-3 rounded-md border border-slate-200">
                    <label class="block text-xs font-medium text-slate-700 mb-1">Fat (g)</label>
                    <input type="number" step="0.01" min="0" name="fat" value="{{ old('fat', 0) }}"
                        class="w-full text-xs rounded border-slate-300 focus:border-emerald-600 focus:ring-emerald-600 py-1.5 px-2.5 font-mono">
                </div>

                <div class="bg-slate-50 p-3 rounded-md border border-slate-200">
                    <label class="block text-xs font-medium text-slate-700 mb-1">Fiber (g)</label>
                    <input type="number" step="0.01" min="0" name="fiber" value="{{ old('fiber', 0) }}"
                        class="w-full text-xs rounded border-slate-300 focus:border-emerald-600 focus:ring-emerald-600 py-1.5 px-2.5 font-mono">
                </div>

                <div class="bg-slate-50 p-3 rounded-md border border-slate-200">
                    <label class="block text-xs font-medium text-slate-700 mb-1">Sugar (g)</label>
                    <input type="number" step="0.01" min="0" name="sugar" value="{{ old('sugar', 0) }}"
                        class="w-full text-xs rounded border-slate-300 focus:border-emerald-600 focus:ring-emerald-600 py-1.5 px-2.5 font-mono">
                </div>

                <div class="bg-slate-50 p-3 rounded-md border border-slate-200">
                    <label class="block text-xs font-medium text-slate-700 mb-1">Sodium (mg)</label>
                    <input type="number" step="0.01" min="0" name="sodium" value="{{ old('sodium', 0) }}"
                        class="w-full text-xs rounded border-slate-300 focus:border-emerald-600 focus:ring-emerald-600 py-1.5 px-2.5 font-mono">
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-700 mb-1.5">Vitamins (Optional)</label>
                    <input type="text" name="vitamins" value="{{ old('vitamins') }}" placeholder="e.g. Vitamin A, C"
                        class="w-full text-xs rounded-md border-slate-300 focus:border-emerald-600 focus:ring-emerald-600 py-2 px-3">
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-700 mb-1.5">Minerals (Optional)</label>
                    <input type="text" name="minerals" value="{{ old('minerals') }}" placeholder="e.g. Iron, Calcium"
                        class="w-full text-xs rounded-md border-slate-300 focus:border-emerald-600 focus:ring-emerald-600 py-2 px-3">
                </div>
            </div>

            <div class="pt-4 flex justify-end gap-2.5 border-t border-slate-100">
                <a href="{{ route('foods.index') }}" class="px-4 py-2 rounded-md border border-slate-300 text-xs font-medium text-slate-700 hover:bg-slate-50 transition">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 rounded-md bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-medium shadow-2xs transition">
                    Save Food Item
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
