<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-xl text-slate-900 tracking-tight flex items-center gap-2">
                <svg class="w-6 h-6 text-indigo-600 inline-block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                Initialize Custom Challenge Blueprint
            </h2>
            <a href="{{ route('plans.index') }}"
                class="bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-extrabold px-4 py-2 rounded-xl transition-all hover:scale-105 inline-flex items-center gap-1.5">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Back to Plans</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12 max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200/80 hover:shadow-md transition-all duration-300">
            <div class="flex items-center gap-3.5 mb-6 pb-4 border-b border-slate-100">
                <div class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold shadow-2xs">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
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
                        class="block w-full rounded-xl border-slate-200 text-xs font-semibold text-slate-800 shadow-2xs focus:border-indigo-500 focus:ring-indigo-500 py-3">
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Duration Challenge Cycle</label>
                    <select name="duration_days"
                        class="block w-full rounded-xl border-slate-200 text-xs font-semibold text-slate-800 shadow-2xs focus:border-indigo-500 focus:ring-indigo-500 py-3">
                        <option value="7">7 Days Micro-Cycle Challenge</option>
                        <option value="15">15 Days Sprint Transformation</option>
                        <option value="30">30 Days Standard Metabolic Reset</option>
                    </select>
                </div>

                <button type="submit"
                    class="w-full bg-slate-900 hover:bg-slate-800 text-white font-extrabold h-12 rounded-xl mt-4 shadow-sm transition-all text-xs flex items-center justify-center gap-2 hover:scale-[1.01]">
                    <span>Initialize Plan Generator & Setup Days</span>
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
