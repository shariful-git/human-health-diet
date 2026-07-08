<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('📋 Diet & Fitness Plans Engine') }}</h2>
            <a href="{{ route('plans.custom.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold px-4 py-2 rounded-xl shadow">+
                Create Custom Plan</a>
        </div>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
        <div>
            <h3 class="text-lg font-bold text-gray-700 mb-4">Official Expert Plans</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($defaultPlans as $plan)
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                        <span
                            class="text-xs font-bold bg-indigo-50 text-indigo-600 px-3 py-1 rounded-full">{{ $plan->duration_days }}
                            Days Challenge</span>
                        <h4 class="text-lg font-bold text-slate-900">{{ $plan->name }}</h4>
                        <p class="text-xs text-slate-500">{{ $plan->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div>
            <h3 class="text-lg font-bold text-gray-700 mb-4">My Custom Tailored Plans</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($myCustomPlans as $cPlan)
                    <div
                        class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex justify-between items-center">
                        <div>
                            <h4 class="text-lg font-bold text-slate-900">{{ $cPlan->name }}</h4>
                            <p class="text-xs text-slate-400 mt-1">Duration: {{ $cPlan->duration_days }} Days Blueprint
                            </p>
                        </div>

                        <div class="flex items-center gap-2">
                            <a href="{{ route('plans.edit.days', $cPlan->id) }}"
                                class="border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-bold px-4 py-2 rounded-xl transition">
                                ⚙️ Setup
                            </a>

                            <form action="{{ route('plans.custom.destroy', $cPlan->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this custom plan? All daily configurations will be permanently lost.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-50 hover:bg-red-100 text-red-600 text-xs font-bold px-4 py-2 rounded-xl transition">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
