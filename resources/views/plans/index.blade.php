<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-xs font-medium text-slate-500">Diet Plans</span>
                    <span class="text-slate-300">·</span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                        Meal Schedules
                    </span>
                </div>
                <h2 class="text-xl font-semibold text-slate-900 tracking-tight">
                    Meal & Diet Plans
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Select a default meal plan or build your own custom schedule.</p>
            </div>
            
            <a href="{{ route('plans.custom.create') }}"
                class="inline-flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-medium px-3.5 py-2 rounded-md transition shadow-2xs">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Create Custom Plan</span>
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- My Custom Plans Section -->
        <div class="lg:col-span-7 space-y-3">
            <div class="flex items-center justify-between pb-1">
                <div class="flex items-center gap-2">
                    <h3 class="text-sm font-semibold text-slate-900">Custom Plans</h3>
                    <span class="bg-slate-100 text-slate-700 text-[10px] font-medium px-1.5 py-0.5 rounded border border-slate-200">Personal</span>
                </div>
                <span class="text-xs text-slate-500 font-mono">{{ $myCustomPlans->count() }} created</span>
            </div>

            <div class="grid grid-cols-1 gap-3">
                @forelse($myCustomPlans as $cPlan)
                    <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-2xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2">
                                <h4 class="text-sm font-semibold text-slate-900">{{ $cPlan->name }}</h4>
                                @if (Auth::user()->active_plan_id === $cPlan->id)
                                    <span class="bg-emerald-50 text-emerald-700 text-[10px] font-medium px-2 py-0.5 rounded border border-emerald-200 flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Active
                                    </span>
                                @endif
                            </div>
                            <p class="text-xs text-slate-500 mt-1 font-mono">
                                Duration: {{ $cPlan->duration_days }} days
                            </p>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            @if (Auth::user()->active_plan_id === $cPlan->id)
                                <button type="button" disabled
                                    class="bg-slate-50 text-emerald-700 border border-slate-200 text-xs font-medium px-3 py-1.5 rounded cursor-default">
                                    <span>Active Plan</span>
                                </button>
                            @else
                                <form action="{{ route('plans.enroll', $cPlan->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-medium px-3 py-1.5 rounded transition shadow-2xs">
                                        <span>Select</span>
                                    </button>
                                </form>
                            @endif

                            <a href="{{ route('plans.edit.days', $cPlan->id) }}"
                                class="border border-slate-300 text-slate-700 hover:bg-slate-50 text-xs font-medium px-3 py-1.5 rounded transition shadow-2xs">
                                <span>Edit Days</span>
                            </a>

                            @if (Auth::user()->active_plan_id !== $cPlan->id)
                                <form action="{{ route('plans.custom.destroy', $cPlan->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this custom meal plan?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-slate-400 hover:text-rose-600 hover:bg-slate-100 p-1.5 rounded transition"
                                        title="Delete plan">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-6 rounded-lg border border-dashed border-slate-300 text-center text-slate-500 space-y-1">
                        <p class="text-xs">No custom plans created yet.</p>
                        <a href="{{ route('plans.custom.create') }}" class="text-xs font-medium text-emerald-600 hover:underline block pt-1">
                            + Create your first custom plan
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Default Plans Section -->
        <div class="lg:col-span-5 space-y-3">
            <div class="flex items-center justify-between pb-1">
                <div class="flex items-center gap-2">
                    <h3 class="text-sm font-semibold text-slate-900">Default Plans</h3>
                    <span class="bg-emerald-50 text-emerald-700 text-[10px] font-medium px-1.5 py-0.5 rounded border border-emerald-200">Standard</span>
                </div>
                <span class="text-xs text-slate-500 font-mono">{{ $defaultPlans->count() }} available</span>
            </div>

            <div class="grid grid-cols-1 gap-3">
                @foreach ($defaultPlans as $plan)
                    <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-2xs flex flex-col justify-between space-y-3">
                        <div>
                            <span class="text-[10px] font-medium bg-slate-100 text-slate-700 px-2 py-0.5 rounded uppercase font-mono border border-slate-200">
                                {{ $plan->duration_days }} Days
                            </span>
                            <h4 class="text-sm font-semibold text-slate-900 mt-2">{{ $plan->name }}</h4>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                {{ $plan->description }}
                            </p>
                        </div>

                        <form action="{{ route('plans.enroll', $plan->id) }}" method="POST" class="pt-1">
                            @csrf
                            @if (Auth::user()->active_plan_id === $plan->id)
                                <button type="button" disabled
                                    class="w-full bg-slate-50 text-emerald-700 border border-slate-200 text-xs font-medium py-2 rounded cursor-default text-center">
                                    <span>Active Plan</span>
                                </button>
                            @else
                                <button type="submit"
                                    class="w-full bg-slate-900 hover:bg-slate-800 text-white text-xs font-medium py-2 rounded transition text-center shadow-2xs">
                                    <span>Select This Plan</span>
                                </button>
                            @endif
                        </form>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</x-app-layout>
