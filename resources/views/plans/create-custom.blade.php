<x-app-layout>
    <div class="py-12 max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100">
            <h3 class="text-xl font-bold text-slate-900 mb-6">Create Custom Plan</h3>
            <form action="{{ route('plans.custom.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Plan Blueprint Title</label>
                    <input type="text" name="name" required placeholder="e.g., Summer Shredding Blueprint"
                        class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Duration Challenge</label>
                    <select name="duration_days"
                        class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:ring-indigo-500">
                        <option value="7">7 Days Micro-Cycle</option>
                        <option value="15">15 Days Sprint</option>
                        <option value="30">30 Days Standard Transformation</option>
                    </select>
                </div>
                <button type="submit"
                    class="w-full bg-slate-900 text-white font-bold h-12 rounded-xl mt-4 shadow-sm hover:bg-slate-800 transition">Initialize
                    Plan Generator</button>
            </form>
        </div>
    </div>
</x-app-layout>
