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

        <!-- SECTION 1: Admin Default Plans -->
        <div>
            <h3 class="text-lg font-bold text-gray-700 mb-4">Official Expert Plans</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($defaultPlans as $plan)
                    <div
                        class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between space-y-4">
                        <div>
                            <span
                                class="text-xs font-bold bg-indigo-50 text-indigo-600 px-3 py-1 rounded-full">{{ $plan->duration_days }}
                                Days Challenge</span>
                            <h4 class="text-lg font-bold text-slate-900 mt-3">{{ $plan->name }}</h4>
                            <p class="text-xs text-slate-500 mt-1">{{ $plan->description }}</p>
                        </div>

                        <!-- 🎯 ENROLL FORM & BUTTON FOR DEFAULT PLAN -->
                        <form action="{{ route('plans.enroll', $plan->id) }}" method="POST" class="pt-2">
                            @csrf
                            @if (Auth::user()->active_plan_id === $plan->id)
                                <!-- ইউজার যদি এই প্ল্যানে অ্যাক্টিভ থাকে তবে বাটনটি ডিজেবল থাকবে -->
                                <button type="button" disabled
                                    class="w-full bg-slate-100 text-slate-400 border border-slate-200 text-xs font-bold py-2.5 px-4 rounded-xl cursor-not-allowed text-center">
                                    Current Active Plan ✓
                                </button>
                            @else
                                <button type="submit"
                                    class="w-full bg-slate-900 hover:bg-indigo-600 text-white text-xs font-bold py-2.5 px-4 rounded-xl transition text-center shadow-sm">
                                    Activate This Plan 🚀
                                </button>
                            @endif
                        </form>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- SECTION 2: User Custom Plans -->
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
                            <!-- 🎯 ENROLL FORM & BUTTON FOR CUSTOM PLAN -->
                            @if (Auth::user()->active_plan_id === $cPlan->id)
                                <!-- কাস্টম প্ল্যান অ্যাক্টিভ থাকলে বাটনটি ডিজেবল থাকবে -->
                                <button type="button" disabled
                                    class="bg-slate-100 text-slate-400 border border-slate-200 text-xs font-bold px-4 py-2 rounded-xl cursor-not-allowed">
                                    Active ✓
                                </button>
                            @else
                                <form action="{{ route('plans.enroll', $cPlan->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-4 py-2 rounded-xl transition">
                                        Activate ⚡
                                    </button>
                                </form>
                            @endif

                            <a href="{{ route('plans.edit.days', $cPlan->id) }}"
                                class="border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-bold px-4 py-2 rounded-xl transition">
                                ⚙️ Setup
                            </a>

                            <form action="{{ route('plans.custom.destroy', $cPlan->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-50 hover:bg-red-100 text-red-600 text-xs font-bold px-4 py-2 rounded-xl transition">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</x-app-layout>
