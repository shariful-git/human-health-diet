<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-xl text-slate-900 tracking-tight flex items-center gap-2">
                    <svg class="w-6 h-6 text-indigo-600 inline-block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Edit Personal Food Item (ফুড এডিট করুন)
                </h2>
                <p class="text-xs font-semibold text-slate-500 mt-0.5">Update details and nutritional values for {{ $food->name }}.</p>
            </div>
            <a href="{{ route('foods.index') }}"
                class="inline-flex items-center gap-1 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-extrabold px-3.5 py-2 rounded-xl transition-all">
                &larr; Back to Foods List
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('foods.update', $food->id) }}" method="POST" class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-md space-y-6">
            @csrf
            @method('PUT')

            <div class="border-b border-slate-100 pb-4">
                <h3 class="text-base font-extrabold text-slate-900">General Information</h3>
                <p class="text-xs text-slate-500">Update name, category, and serving size.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-extrabold text-slate-700 mb-2">Food Name *</label>
                    <input type="text" name="name" value="{{ old('name', $food->name) }}" required
                        class="w-full text-xs font-semibold rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                    @error('name') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-slate-700 mb-2">Category *</label>
                    <select name="category" required class="w-full text-xs font-semibold rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="Breakfast" {{ old('category', $food->category) == 'Breakfast' ? 'selected' : '' }}>Breakfast</option>
                        <option value="Lunch" {{ old('category', $food->category) == 'Lunch' ? 'selected' : '' }}>Lunch</option>
                        <option value="Dinner" {{ old('category', $food->category) == 'Dinner' ? 'selected' : '' }}>Dinner</option>
                        <option value="Snacks" {{ old('category', $food->category) == 'Snacks' ? 'selected' : '' }}>Snacks</option>
                        <option value="Other" {{ old('category', $food->category) == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('category') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-slate-700 mb-2">Energy / Calories (kCal) *</label>
                    <input type="number" name="calories" value="{{ old('calories', $food->calories) }}" required min="0"
                        class="w-full text-xs font-semibold rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                    @error('calories') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-slate-700 mb-2">Serving Size *</label>
                    <input type="text" name="serving_size" value="{{ old('serving_size', $food->serving_size) }}" required
                        class="w-full text-xs font-semibold rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                    @error('serving_size') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="border-b border-slate-100 pb-4 pt-4">
                <h3 class="text-base font-extrabold text-slate-900">Macronutrients & Micronutrients</h3>
                <p class="text-xs text-slate-500">Nutritional specs per serving unit.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-extrabold text-slate-700 mb-2">Protein (g)</label>
                    <input type="number" step="0.01" min="0" name="protein" value="{{ old('protein', $food->protein) }}"
                        class="w-full text-xs font-semibold rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-slate-700 mb-2">Carbohydrates (g)</label>
                    <input type="number" step="0.01" min="0" name="carbohydrate" value="{{ old('carbohydrate', $food->carbohydrate) }}"
                        class="w-full text-xs font-semibold rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-slate-700 mb-2">Fat (g)</label>
                    <input type="number" step="0.01" min="0" name="fat" value="{{ old('fat', $food->fat) }}"
                        class="w-full text-xs font-semibold rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-slate-700 mb-2">Fiber (g)</label>
                    <input type="number" step="0.01" min="0" name="fiber" value="{{ old('fiber', $food->fiber) }}"
                        class="w-full text-xs font-semibold rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-slate-700 mb-2">Sugar (g)</label>
                    <input type="number" step="0.01" min="0" name="sugar" value="{{ old('sugar', $food->sugar) }}"
                        class="w-full text-xs font-semibold rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-slate-700 mb-2">Sodium (mg)</label>
                    <input type="number" step="0.01" min="0" name="sodium" value="{{ old('sodium', $food->sodium) }}"
                        class="w-full text-xs font-semibold rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-slate-700 mb-2">Vitamins</label>
                    <input type="text" name="vitamins" value="{{ old('vitamins', $food->vitamins) }}"
                        class="w-full text-xs font-semibold rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-slate-700 mb-2">Minerals</label>
                    <input type="text" name="minerals" value="{{ old('minerals', $food->minerals) }}"
                        class="w-full text-xs font-semibold rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            </div>

            <div class="pt-6 flex justify-end gap-3 border-t border-slate-100">
                <a href="{{ route('foods.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-extrabold shadow-xs transition-all hover:scale-105">
                    Update Food Item
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
