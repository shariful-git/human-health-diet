<x-guest-layout>
    <div class="mb-5">
        <h3 class="text-lg font-semibold text-slate-900 tracking-tight">Verify Email Address</h3>
        <p class="text-xs text-slate-500 mt-0.5 leading-relaxed">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 text-xs font-medium text-emerald-700 bg-emerald-50 p-3 rounded-md border border-emerald-200">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between gap-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div>
                <x-primary-button class="py-2 text-xs font-medium">
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-xs font-medium text-slate-500 hover:text-slate-800 transition-colors">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
