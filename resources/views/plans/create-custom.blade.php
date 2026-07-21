<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-xl text-slate-900 tracking-tight">
                ✨ Initialize Custom Challenge Blueprint
            </h2>
            <a href="{{ route('plans.index') }}"
                class="bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-extrabold px-3.5 py-2 rounded-none transition-all">
                ← Back to Plans
            </a>
        </div>
    </x-slot>

    <div class="py-12 max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-8 rounded-none shadow-sm border border-slate-200/80 hover:shadow-md transition-shadow">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                <div class="w-10 h-10 rounded-none bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl font-bold">
                    📋
                </div>
                <div>
                    <h3 class="text-lg font-extrabold text-slate-900">Custom Plan Generator</h3>
                    <p class="text-xs text-slate-500 font-medium">Define duration and title for your tailored routine.</p>
                </div>
            </div>

            <form action="{{ route('plans.custom.store') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Plan Blueprint Title</label>
                    <input type="text" name="name" required placeholder="e.g., Summer Shredding Blueprint"
                        class="block w-full rounded-none border-slate-200 text-xs font-semibold text-slate-800 shadow-2xs focus:border-indigo-500 focus:ring-indigo-500 py-3">
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Duration Challenge Cycle</label>
                    <select name="duration_days"
                        class="block w-full rounded-none border-slate-200 text-xs font-semibold text-slate-800 shadow-2xs focus:border-indigo-500 focus:ring-indigo-500 py-3">
                        <option value="7">7 Days Micro-Cycle Challenge</option>
                        <option value="15">15 Days Sprint Transformation</option>
                        <option value="30">30 Days Standard Metabolic Reset</option>
                    </select>
                </div>

                <button type="submit"
                    class="w-full bg-slate-900 hover:bg-slate-800 text-white font-extrabold h-12 rounded-none mt-4 shadow-sm transition-all text-xs flex items-center justify-center gap-2">
                    <span>Initialize Plan Generator & Setup Days →</span>
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
