<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-xl text-slate-900 tracking-tight flex items-center gap-2">
                    📋 Diet & Fitness Plans Engine
                </h2>
                <p class="text-xs font-semibold text-slate-500 mt-0.5">Select a master plan or build custom structured challenges.</p>
            </div>
            <a href="{{ route('plans.custom.create') }}"
                class="inline-flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-extrabold px-4 py-2.5 rounded-none shadow-xs transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
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
                    <div class="bg-white p-6 rounded-none border border-slate-200/80 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:shadow-md transition-shadow">
                        <div>
                            <div class="flex items-center gap-2">
                                <h4 class="text-base font-extrabold text-slate-900">{{ $cPlan->name }}</h4>
                                @if(Auth::user()->active_plan_id === $cPlan->id)
                                    <span class="bg-emerald-100 text-emerald-700 text-[10px] font-black uppercase px-2.5 py-0.5 rounded-full border border-emerald-200">
                                        Active
                                    </span>
                                @endif
                            </div>
                            <p class="text-xs text-slate-500 font-medium mt-1">Duration: {{ $cPlan->duration_days }} Days Challenge Blueprint</p>
                        </div>
                        
                        <div class="flex items-center gap-2 shrink-0">
                            @if(Auth::user()->active_plan_id === $cPlan->id)
                                <button type="button" disabled class="bg-slate-100 text-slate-400 border border-slate-200 text-xs font-extrabold px-3.5 py-2 rounded-none cursor-not-allowed">
                                    Active ✓
                                </button>
                            @else
                                <form action="{{ route('plans.enroll', $cPlan->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-extrabold px-3.5 py-2 rounded-none transition-all shadow-xs">
                                        Activate ⚡
                                    </button>
                                </form>
                            @endif

                            <a href="{{ route('plans.edit.days', $cPlan->id) }}" class="border border-slate-200/80 text-slate-700 hover:bg-slate-50 text-xs font-extrabold px-3.5 py-2 rounded-none transition-all">
                                ⚙️ Setup Days
                            </a>

                            <form action="{{ route('plans.custom.destroy', $cPlan->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this custom plan?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-bold px-3 py-2 rounded-none transition-all" title="Delete Plan">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-8 rounded-none border border-dashed border-slate-300 text-center text-slate-400 space-y-2">
                        <p class="text-xs italic">No custom plans built yet.</p>
                        <a href="{{ route('plans.custom.create') }}" class="text-xs font-extrabold text-emerald-600 hover:underline">
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
                @foreach($defaultPlans as $plan)
                    <div class="bg-white p-6 rounded-none border border-slate-200/80 shadow-sm flex flex-col justify-between space-y-4 hover:shadow-md transition-shadow">
                        <div>
                            <span class="text-[10px] font-black bg-indigo-50 text-indigo-700 px-3 py-1 rounded-full uppercase tracking-wider border border-indigo-100">
                                {{ $plan->duration_days }} Days Challenge
                            </span>
                            <h4 class="text-base font-extrabold text-slate-900 mt-3">{{ $plan->name }}</h4>
                            <p class="text-xs text-slate-500 font-medium leading-relaxed mt-1.5">{{ $plan->description }}</p>
                        </div>
                        
                        <form action="{{ route('plans.enroll', $plan->id) }}" method="POST" class="pt-2">
                            @csrf
                            @if(Auth::user()->active_plan_id === $plan->id)
                                <button type="button" disabled class="w-full bg-slate-100 text-slate-400 border border-slate-200 text-xs font-extrabold py-2.5 rounded-none cursor-not-allowed text-center">
                                    Current Active Plan ✓
                                </button>
                            @else
                                <button type="submit" class="w-full bg-slate-900 hover:bg-emerald-600 text-white text-xs font-extrabold py-2.5 rounded-none transition-all text-center shadow-xs">
                                    Activate This Challenge Plan 🚀
                                </button>
                            @endif
                        </form>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</x-app-layout>