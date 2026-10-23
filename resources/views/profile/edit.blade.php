<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-xs font-medium text-slate-500">Settings</span>
                    <span class="text-slate-300">·</span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                        Profile
                    </span>
                </div>
                <h2 class="text-xl font-semibold text-slate-900 tracking-tight">
                    Health Profile & Settings
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Manage your personal metrics, activity level, and calorie goals.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">
            
            <!-- Quick Stat Row -->
            @if($profile)
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-white p-4 rounded-lg border border-slate-200 shadow-2xs text-center">
                        <span class="text-[11px] font-medium uppercase text-slate-500 tracking-wider">Calculated BMI</span>
                        <div class="flex items-baseline justify-center gap-1 mt-1">
                            <span class="text-2xl font-semibold text-slate-900 font-mono">{{ number_format($profile->bmi, 1) }}</span>
                            <span class="text-xs text-slate-500">kg/m²</span>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg border border-slate-200 shadow-2xs text-center">
                        <span class="text-[11px] font-medium uppercase text-slate-500 tracking-wider">Basal Rate (BMR)</span>
                        <div class="flex items-baseline justify-center gap-1 mt-1">
                            <span class="text-2xl font-semibold text-slate-900 font-mono">{{ number_format($profile->bmr) }}</span>
                            <span class="text-xs text-slate-500">kcal/day</span>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg border border-slate-200 shadow-2xs text-center">
                        <span class="text-[11px] font-medium uppercase text-slate-500 tracking-wider">Current Goal</span>
                        <p class="text-sm font-semibold capitalize mt-1.5 text-slate-900">{{ str_replace('_', ' ', $profile->goal) }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white p-6 rounded-lg border border-slate-200 shadow-2xs">
                <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="border-b border-slate-100 pb-3">
                        <h3 class="text-sm font-semibold text-slate-900">Account Details</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Your display name and account email address</p>
                    </div>

                    <!-- Account Identity -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="name" :value="__('Full Name')" class="text-xs font-medium text-slate-700 mb-1" />
                            <input id="name" name="name" type="text"
                                class="block w-full rounded-md border-slate-300 text-xs text-slate-800 focus:border-emerald-600 focus:ring-emerald-600 py-2 px-3"
                                value="{{ old('name', $user->name) }}" required />
                            <x-input-error class="mt-1" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Email Address')" class="text-xs font-medium text-slate-700 mb-1" />
                            <input id="email" name="email" type="email"
                                class="block w-full rounded-md border-slate-300 text-xs text-slate-800 focus:border-emerald-600 focus:ring-emerald-600 py-2 px-3"
                                value="{{ old('email', $user->email) }}" required />
                            <x-input-error class="mt-1" :messages="$errors->get('email')" />
                        </div>
                    </div>

                    <div class="border-b border-slate-100 pb-3 pt-2">
                        <h3 class="text-sm font-semibold text-slate-900">Physical Metrics</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Used to calculate your daily caloric requirements</p>
                    </div>

                    <!-- Gender -->
                    <div>
                        <x-input-label for="gender" :value="__('Gender')" class="text-xs font-medium text-slate-700 mb-1" />
                        <select id="gender" name="gender"
                            class="block w-full rounded-md border-slate-300 bg-white text-xs text-slate-800 focus:border-emerald-600 focus:ring-emerald-600 py-2 px-3">
                            <option value="male" {{ old('gender', $profile?->gender) == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $profile?->gender) == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender', $profile?->gender) == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        <x-input-error class="mt-1" :messages="$errors->get('gender')" />
                    </div>

                    <!-- Metrics Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <x-input-label for="age" :value="__('Age (Years)')" class="text-xs font-medium text-slate-700 mb-1" />
                            <input id="age" name="age" type="number" 
                                class="block w-full rounded-md border-slate-300 text-xs text-slate-800 focus:border-emerald-600 focus:ring-emerald-600 py-2 px-3 font-mono"
                                value="{{ old('age', $profile?->age) }}" required />
                            <x-input-error class="mt-1" :messages="$errors->get('age')" />
                        </div>
                        <div>
                            <x-input-label for="height" :value="__('Height (cm)')" class="text-xs font-medium text-slate-700 mb-1" />
                            <input id="height" name="height" type="number" step="0.1"
                                class="block w-full rounded-md border-slate-300 text-xs text-slate-800 focus:border-emerald-600 focus:ring-emerald-600 py-2 px-3 font-mono" 
                                value="{{ old('height', $profile?->height) }}" required />
                            <x-input-error class="mt-1" :messages="$errors->get('height')" />
                        </div>
                        <div>
                            <x-input-label for="weight" :value="__('Weight (kg)')" class="text-xs font-medium text-slate-700 mb-1" />
                            <input id="weight" name="weight" type="number" step="0.1"
                                class="block w-full rounded-md border-slate-300 text-xs text-slate-800 focus:border-emerald-600 focus:ring-emerald-600 py-2 px-3 font-mono" 
                                value="{{ old('weight', $profile?->weight) }}" required />
                            <x-input-error class="mt-1" :messages="$errors->get('weight')" />
                        </div>
                    </div>

                    <!-- Activity Level -->
                    <div>
                        <x-input-label for="activity_level" :value="__('Activity Level')" class="text-xs font-medium text-slate-700 mb-1" />
                        <select id="activity_level" name="activity_level"
                            class="block w-full rounded-md border-slate-300 bg-white text-xs text-slate-800 focus:border-emerald-600 focus:ring-emerald-600 py-2 px-3">
                            <option value="low" {{ old('activity_level', $profile?->activity_level) == 'low' ? 'selected' : '' }}>
                                Low Activity (Sedentary / Desk Job)
                            </option>
                            <option value="medium" {{ old('activity_level', $profile?->activity_level) == 'medium' ? 'selected' : '' }}>
                                Moderate Activity (Workouts 3-5 days/week)
                            </option>
                            <option value="high" {{ old('activity_level', $profile?->activity_level) == 'high' ? 'selected' : '' }}>
                                High Activity (Heavy workouts or physical job)
                            </option>
                        </select>
                    </div>

                    <!-- Goal -->
                    <div>
                        <x-input-label for="goal" :value="__('Primary Health Goal')" class="text-xs font-medium text-slate-700 mb-1" />
                        <select id="goal" name="goal"
                            class="block w-full rounded-md border-slate-300 bg-white text-xs text-slate-800 focus:border-emerald-600 focus:ring-emerald-600 py-2 px-3">
                            <option value="weight_loss" {{ old('goal', $profile?->goal) == 'weight_loss' ? 'selected' : '' }}>
                                Weight Loss (-500 kcal deficit)
                            </option>
                            <option value="weight_gain" {{ old('goal', $profile?->goal) == 'weight_gain' ? 'selected' : '' }}>
                                Weight Gain (+400 kcal surplus)
                            </option>
                            <option value="maintain" {{ old('goal', $profile?->goal) == 'maintain' ? 'selected' : '' }}>
                                Maintain Current Weight
                            </option>
                            <option value="muscle_gain" {{ old('goal', $profile?->goal) == 'muscle_gain' ? 'selected' : '' }}>
                                Muscle Building & High Protein
                            </option>
                        </select>
                    </div>

                    <div class="pt-3 border-t border-slate-100 flex justify-end">
                        <button type="submit"
                            class="bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2 px-4 rounded-md transition text-xs shadow-2xs flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Save Profile & Recalculate</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
