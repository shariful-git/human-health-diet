<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-xl text-slate-900 tracking-tight flex items-center gap-2">
                    <svg class="w-6 h-6 text-emerald-600 inline-block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    Diet & Fitness Plans Engine
                </h2>
                <p class="text-xs font-semibold text-slate-500 mt-0.5">Select a master plan or build custom structured
                    challenges.</p>
            </div>
            <a href="{{ route('plans.custom.create') }}"
                class="inline-flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-extrabold px-4 py-2.5 rounded-xl shadow-xs transition-all hover:scale-105">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Create Custom Plan Blueprint</span>
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-8">

        <!-- My Custom Tailored Plans Section -->
        <div class="lg:col-span-7 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-base font-extrabold text-slate-900">My Custom Tailored Plans</h3>
                <span class="text-xs font-bold text-slate-400 font-mono">{{ $myCustomPlans->count() }} Created</span>
            </div>

            <div class="grid grid-cols-1 gap-4">
                @forelse($myCustomPlans as $cPlan)
                    <div
                        class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:shadow-md transition-all duration-300">
                        <div>
                            <div class="flex items-center gap-2">
                                <h4 class="text-base font-extrabold text-slate-900">{{ $cPlan->name }}</h4>
                                @if (Auth::user()->active_plan_id === $cPlan->id)
                                    <span
                                        class="bg-emerald-100 text-emerald-700 text-[10px] font-black uppercase px-2.5 py-0.5 rounded-full border border-emerald-200 shadow-2xs">
                                        Active
                                    </span>
                                @endif
                            </div>
                            <p class="text-xs text-slate-500 font-medium mt-1">Duration: {{ $cPlan->duration_days }}
                                Days Challenge Blueprint</p>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            @if (Auth::user()->active_plan_id === $cPlan->id)
                                <button type="button" disabled
                                    class="bg-slate-100 text-slate-400 border border-slate-200 text-xs font-extrabold px-3.5 py-2 rounded-xl cursor-not-allowed flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    Active
                                </button>
                            @else
                                <form action="{{ route('plans.enroll', $cPlan->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-extrabold px-3.5 py-2 rounded-xl transition-all shadow-xs hover:scale-105 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                        <span>Activate</span>
                                    </button>
                                </form>
                            @endif

                            <a href="{{ route('plans.edit.days', $cPlan->id) }}"
                                class="border border-slate-200/80 text-slate-700 hover:bg-slate-50 text-xs font-extrabold px-3.5 py-2 rounded-xl transition-all hover:scale-105 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>Setup Days</span>
                            </a>

                            @if (Auth::user()->active_plan_id === $cPlan->id)
                            @else
                                <form action="{{ route('plans.custom.destroy', $cPlan->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this custom plan?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-bold px-3 py-2 rounded-xl transition-all hover:scale-105 flex items-center justify-center"
                                        title="Delete Plan">
                                        <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div
                        class="bg-white p-8 rounded-2xl border border-dashed border-slate-300 text-center text-slate-400 space-y-2">
                        <p class="text-xs italic">No custom plans built yet.</p>
                        <a href="{{ route('plans.custom.create') }}"
                            class="text-xs font-extrabold text-emerald-600 hover:underline">
                            + Create your first custom blueprint
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Official Expert Plans Section -->
        <div class="lg:col-span-5 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-base font-extrabold text-slate-900">Official Expert Plans</h3>
                <span class="text-xs font-bold text-slate-400 font-mono">{{ $defaultPlans->count() }} Pre-set</span>
            </div>

            <div class="grid grid-cols-1 gap-4">
                @foreach ($defaultPlans as $plan)
                    <div
                        class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between space-y-4 hover:shadow-md transition-all duration-300">
                        <div>
                            <span
                                class="text-[10px] font-black bg-indigo-50 text-indigo-700 px-3 py-1 rounded-full uppercase tracking-wider border border-indigo-100">
                                {{ $plan->duration_days }} Days Challenge
                            </span>
                            <h4 class="text-base font-extrabold text-slate-900 mt-3">{{ $plan->name }}</h4>
                            <p class="text-xs text-slate-500 font-medium leading-relaxed mt-1.5">
                                {{ $plan->description }}</p>
                        </div>

                        <form action="{{ route('plans.enroll', $plan->id) }}" method="POST" class="pt-2">
                            @csrf
                            @if (Auth::user()->active_plan_id === $plan->id)
                                <button type="button" disabled
                                    class="w-full bg-slate-100 text-slate-400 border border-slate-200 text-xs font-extrabold py-2.5 rounded-xl cursor-not-allowed text-center flex items-center justify-center gap-1.5">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    <span>Current Active Plan</span>
                                </button>
                            @else
                                <button type="submit"
                                    class="w-full bg-slate-900 hover:bg-emerald-600 text-white text-xs font-extrabold py-2.5 rounded-xl transition-all text-center shadow-xs hover:scale-[1.01] flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                    <span>Activate This Challenge Plan</span>
                                </button>
                            @endif
                        </form>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</x-app-layout>
