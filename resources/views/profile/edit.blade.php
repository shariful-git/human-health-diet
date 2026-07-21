<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('UPDATE YOUR HEALTH PROFILE') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">

                <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="gender" :value="__('Gender')" />
                        <select id="gender" name="gender"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="male" {{ old('gender', $profile?->gender) == 'male' ? 'selected' : '' }}>
                                Male</option>
                            <option value="female" {{ old('gender', $profile?->gender) == 'female' ? 'selected' : '' }}>
                                Female</option>
                            <option value="other" {{ old('gender', $profile?->gender) == 'other' ? 'selected' : '' }}>
                                Other</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <x-input-label for="age" :value="__('Age (Years)')" />
                            <x-text-input id="age" name="age" type="number" class="mt-1 block w-full"
                                :value="old('age', $profile?->age)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('age')" />
                        </div>
                        <div>
                            <x-input-label for="height" :value="__('Height (cm)')" />
                            <x-text-input id="height" name="height" type="number" step="0.1"
                                class="mt-1 block w-full" :value="old('height', $profile?->height)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('height')" />
                        </div>
                        <div>
                            <x-input-label for="weight" :value="__('Weight (kg)')" />
                            <x-text-input id="weight" name="weight" type="number" step="0.1"
                                class="mt-1 block w-full" :value="old('weight', $profile?->weight)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('weight')" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="activity_level" :value="__('Activity Level')" />
                        <select id="activity_level" name="activity_level"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="low"
                                {{ old('activity_level', $profile?->activity_level) == 'low' ? 'selected' : '' }}>Low
                                (Sedentary / Desk Job)</option>
                            <option value="medium"
                                {{ old('activity_level', $profile?->activity_level) == 'medium' ? 'selected' : '' }}>
                                Medium (Active / Workout 3-5 days)</option>
                            <option value="high"
                                {{ old('activity_level', $profile?->activity_level) == 'high' ? 'selected' : '' }}>High
                                (Very Active / Heavy Gym)</option>
                        </select>
                    </div>

                    <div>
                        <x-input-label for="goal" :value="__('Your Fitness Goal')" />
                        <select id="goal" name="goal"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="weight_loss"
                                {{ old('goal', $profile?->goal) == 'weight_loss' ? 'selected' : '' }}>Weight Loss
                            </option>
                            <option value="weight_gain"
                                {{ old('goal', $profile?->goal) == 'weight_gain' ? 'selected' : '' }}>Weight Gain
                            </option>
                            <option value="maintain"
                                {{ old('goal', $profile?->goal) == 'maintain' ? 'selected' : '' }}>Maintain Weight
                            </option>
                            <option value="muscle_gain"
                                {{ old('goal', $profile?->goal) == 'muscle_gain' ? 'selected' : '' }}>Muscle Gain
                            </option>
                        </select>
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save & Calculate') }}</x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
