<x-guest-layout>
    <div class="mb-4 text-xs text-slate-600 leading-relaxed">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-xs font-medium text-slate-700" />
            <x-text-input id="password" class="block mt-1 w-full text-xs"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div class="flex justify-end pt-2">
            <x-primary-button class="py-2 text-xs font-medium">
                {{ __('Confirm Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
