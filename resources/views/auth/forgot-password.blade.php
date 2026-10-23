<x-guest-layout>
    <div class="mb-5">
        <h3 class="text-lg font-semibold text-slate-900 tracking-tight">Reset Password</h3>
        <p class="text-xs text-slate-500 mt-0.5 leading-relaxed">
            Forgot your password? No problem. Enter your email address and we will email you a password reset link.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-xs font-medium text-slate-700" />
            <x-text-input id="email" class="block mt-1 w-full text-xs" type="email" name="email" :value="old('email')" required autofocus placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center py-2.5 text-xs font-medium">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>

        <div class="text-center pt-3 border-t border-slate-100 mt-4">
            <a href="{{ route('login') }}" class="text-xs text-emerald-600 hover:text-emerald-700 font-medium transition-colors">
                ← Back to sign in
            </a>
        </div>
    </form>
</x-guest-layout>
