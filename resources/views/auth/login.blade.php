<x-guest-layout>
    <div class="mb-5">
        <h3 class="text-lg font-semibold text-slate-900 tracking-tight">Sign In</h3>
        <p class="text-xs text-slate-500 mt-0.5">Enter your email and password to access your account.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-xs font-medium text-slate-700" />
            <x-text-input id="email" class="block mt-1 w-full text-xs" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-xs font-medium text-slate-700" />
            <x-text-input id="password" class="block mt-1 w-full text-xs"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-emerald-600 shadow-2xs focus:ring-emerald-500" name="remember">
                <span class="ms-2 text-xs font-medium text-slate-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-xs font-medium text-emerald-600 hover:text-emerald-700 transition-colors" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center py-2.5 text-xs font-medium">
                {{ __('Sign In') }}
            </x-primary-button>
        </div>

        <div class="text-center pt-3 border-t border-slate-100 mt-4">
            <p class="text-xs text-slate-500">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-emerald-600 hover:text-emerald-700 font-medium ms-1">Create an account</a>
            </p>
        </div>
    </form>
</x-guest-layout>
