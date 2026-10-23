<x-guest-layout>
    <div class="mb-5">
        <h3 class="text-lg font-semibold text-slate-900 tracking-tight">Create Account</h3>
        <p class="text-xs text-slate-500 mt-0.5">Enter your details to register and get started.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" class="text-xs font-medium text-slate-700" />
            <x-text-input id="name" class="block mt-1 w-full text-xs" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-xs font-medium text-slate-700" />
            <x-text-input id="email" class="block mt-1 w-full text-xs" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-xs font-medium text-slate-700" />
            <x-text-input id="password" class="block mt-1 w-full text-xs"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-xs font-medium text-slate-700" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full text-xs"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center py-2.5 text-xs font-medium">
                {{ __('Create Account') }}
            </x-primary-button>
        </div>

        <div class="text-center pt-3 border-t border-slate-100 mt-4">
            <p class="text-xs text-slate-500">
                Already registered?
                <a href="{{ route('login') }}" class="text-emerald-600 hover:text-emerald-700 font-medium ms-1">Sign in</a>
            </p>
        </div>
    </form>
</x-guest-layout>
