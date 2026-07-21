<x-guest-layout>
    <div class="mb-6">
        <h3 class="text-xl font-black text-white">Client Portal Sign In</h3>
        <p class="text-xs text-slate-400 font-medium mt-1">Access your metabolic and dietary intelligence dashboard.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="user@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-slate-700 bg-slate-900 text-emerald-500 shadow-xs focus:ring-emerald-500" name="remember">
                <span class="ms-2 text-xs font-semibold text-slate-300">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-xs font-semibold text-emerald-400 hover:text-emerald-300 transition-colors" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full">
                {{ __('Sign In to Portal') }}
            </x-primary-button>
        </div>

        <div class="text-center pt-2 border-t border-slate-700/60 mt-4">
            <p class="text-xs font-medium text-slate-400">
                Don't have an account yet?
                <a href="{{ route('register') }}" class="text-emerald-400 hover:underline font-bold ms-1">Register Account</a>
            </p>
        </div>
    </form>
</x-guest-layout>
