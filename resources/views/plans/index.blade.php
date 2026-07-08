<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('📋 Choose Your Diet & Fitness Plan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($plans as $plan)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between">
                        <div>
                            <span
                                class="text-xs font-bold uppercase tracking-widest bg-indigo-50 text-indigo-600 px-3 py-1 rounded-full">
                                {{ $plan->duration_days }} Days Challenge
                            </span>
                            <h3 class="text-xl font-black text-gray-800 mt-3">{{ $plan->name }}</h3>
                            <p class="text-sm text-gray-500 mt-2">
                                {{ $plan->description ?? 'No description provided for this plan.' }}</p>
                        </div>

                        <div class="mt-6">
                            <form action="{{ route('plans.enroll', $plan->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-gray-900 hover:bg-indigo-600 text-white font-bold py-2.5 px-4 rounded-xl transition text-center text-sm shadow">
                                    Activate This Plan 🚀
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 bg-white rounded-2xl border border-dashed">
                        <p class="text-gray-400 italic">No official plans available from Admin yet.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
