<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-xs font-medium text-slate-500">Diet Plans</span>
                    <span class="text-slate-300">·</span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-slate-100 text-slate-700 border border-slate-200">
                        New Plan
                    </span>
                </div>
                <h2 class="text-xl font-semibold text-slate-900 tracking-tight">
                    Create Custom Plan
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Set up a customized meal plan with specific day durations.</p>
            </div>
            <a href="{{ route('plans.index') }}"
                class="inline-flex items-center gap-1.5 bg-white hover:bg-slate-50 text-slate-700 text-xs font-medium px-3.5 py-2 rounded-md border border-slate-300 shadow-2xs transition">
                <span>← Back to Plans</span>
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-lg mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded-lg border border-slate-200 shadow-2xs space-y-5">
            <div class="border-b border-slate-100 pb-3">
                <h3 class="text-sm font-semibold text-slate-900">Plan Details</h3>
                <p class="text-xs text-slate-500 mt-0.5">Choose a title and cycle duration for your diet schedule.</p>
            </div>

            <form action="{{ route('plans.custom.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-medium text-slate-700 mb-1.5">Plan Name *</label>
                    <input type="text" name="name" required placeholder="e.g. 7-Day High Protein Schedule"
                        class="block w-full rounded-md border-slate-300 text-xs text-slate-800 focus:border-emerald-600 focus:ring-emerald-600 py-2 px-3">
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-700 mb-1.5">Duration *</label>
                    <select name="duration_days"
                        class="block w-full rounded-md border-slate-300 text-xs text-slate-800 focus:border-emerald-600 focus:ring-emerald-600 py-2 px-3">
                        <option value="7">7 Days Plan</option>
                        <option value="15">15 Days Plan</option>
                        <option value="30">30 Days Plan</option>
                    </select>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2 px-4 rounded-md shadow-2xs transition text-xs flex items-center justify-center gap-1.5">
                        <span>Create Plan & Setup Days</span>
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
