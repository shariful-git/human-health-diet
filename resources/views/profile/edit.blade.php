<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-xl text-slate-900 tracking-tight flex items-center gap-2">
                    ⚙️ Health Parameters & Profile Configuration
                </h2>
                <p class="text-xs font-semibold text-slate-500 mt-0.5">Maintain physical parameters for accurate BMR and metabolic expenditure projections.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-none shadow-sm border border-slate-200/80 hover:shadow-md transition-shadow">

                <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Gender Selection -->
                    <div>
                        <x-input-label for="gender" :value="__('Biological Gender')" class="text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5" />
                        <select id="gender" name="gender"
                            class="block w-full rounded-none border-slate-200 bg-white text-xs font-semibold text-slate-800 shadow-2xs focus:border-emerald-500 focus:ring-emerald-500 py-3">
                            <option value="male" {{ old('gender', $profile?->gender) == 'male' ? 'selected' : '' }}>
                                Male Baseline (Harris-Benedict Constant)</option>
                            <option value="female" {{ old('gender', $profile?->gender) == 'female' ? 'selected' : '' }}>
                                Female Baseline (Harris-Benedict Constant)</option>
                            <option value="other" {{ old('gender', $profile?->gender) == 'other' ? 'selected' : '' }}>
                                Other / Custom Baseline</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                    </div>

                    <!-- Metrics Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <x-input-label for="age" :value="__('Age (Years)')" class="text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5" />
                            <x-text-input id="age" name="age" type="number" class="block w-full rounded-none border-slate-200 text-xs font-semibold text-slate-800 shadow-2xs focus:border-emerald-500 focus:ring-emerald-500 py-3"
                                :value="old('age', $profile?->age)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('age')" />
                        </div>
                        <div>
                            <x-input-label for="height" :value="__('Height (cm)')" class="text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5" />
                            <x-text-input id="height" name="height" type="number" step="0.1"
                                class="block w-full rounded-none border-slate-200 text-xs font-semibold text-slate-800 shadow-2xs focus:border-emerald-500 focus:ring-emerald-500 py-3" :value="old('height', $profile?->height)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('height')" />
                        </div>
                        <div>
                            <x-input-label for="weight" :value="__('Weight (kg)')" class="text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5" />
                            <x-text-input id="weight" name="weight" type="number" step="0.1"
                                class="block w-full rounded-none border-slate-200 text-xs font-semibold text-slate-800 shadow-2xs focus:border-emerald-500 focus:ring-emerald-500 py-3" :value="old('weight', $profile?->weight)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('weight')" />
                        </div>
                    </div>

                    <!-- Activity Level -->
                    <div>
                        <x-input-label for="activity_level" :value="__('Physical Activity Level')" class="text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5" />
                        <select id="activity_level" name="activity_level"
                            class="block w-full rounded-none border-slate-200 bg-white text-xs font-semibold text-slate-800 shadow-2xs focus:border-emerald-500 focus:ring-emerald-500 py-3">
                            <option value="low"
                                {{ old('activity_level', $profile?->activity_level) == 'low' ? 'selected' : '' }}>Low Intensity (Sedentary Desk Job / Light Movement)</option>
                            <option value="medium"
                                {{ old('activity_level', $profile?->activity_level) == 'medium' ? 'selected' : '' }}>
                                Moderate Intensity (Active Workouts 3-5 days / week)</option>
                            <option value="high"
                                {{ old('activity_level', $profile?->activity_level) == 'high' ? 'selected' : '' }}>High Intensity (Heavy Athletics / Daily Gym Routines)</option>
                        </select>
                    </div>

                    <!-- Fitness Goal -->
                    <div>
                        <x-input-label for="goal" :value="__('Target Biometric Goal')" class="text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5" />
                        <select id="goal" name="goal"
                            class="block w-full rounded-none border-slate-200 bg-white text-xs font-semibold text-slate-800 shadow-2xs focus:border-emerald-500 focus:ring-emerald-500 py-3">
                            <option value="weight_loss"
                                {{ old('goal', $profile?->goal) == 'weight_loss' ? 'selected' : '' }}>Weight Loss (Caloric Deficit Blueprint)
                            </option>
                            <option value="weight_gain"
                                {{ old('goal', $profile?->goal) == 'weight_gain' ? 'selected' : '' }}>Weight Gain (Caloric Surplus Blueprint)
                            </option>
                            <option value="maintain"
                                {{ old('goal', $profile?->goal) == 'maintain' ? 'selected' : '' }}>Maintain Biometric Balance (Iso-Caloric)
                            </option>
                            <option value="muscle_gain"
                                {{ old('goal', $profile?->goal) == 'muscle_gain' ? 'selected' : '' }}>Hypertrophy & Muscle Gain (High Protein)
                            </option>
                        </select>
                    </div>

                    <div class="pt-4 flex items-center gap-4 border-t border-slate-100">
                        <button type="submit"
                            class="w-full bg-slate-900 hover:bg-emerald-600 text-white font-extrabold h-12 rounded-none shadow-sm transition-all text-xs flex items-center justify-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Save Parameters & Recalculate Metrics</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
