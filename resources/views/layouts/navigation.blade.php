<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-xl border-b border-slate-200/60 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-6 sm:gap-8">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="transition-transform hover:scale-105">
                        <x-application-logo />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:items-center sm:gap-1">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            {{ __('Dashboard') }}
                        </span>
                    </x-nav-link>

                    <x-nav-link :href="route('plans.index')" :active="request()->routeIs('plans.*')">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                            {{ __('Plans') }}
                        </span>
                    </x-nav-link>

                    <x-nav-link :href="route('meals.index')" :active="request()->routeIs('meals.*')">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            {{ __('Meals') }}
                        </span>
                    </x-nav-link>

                    <x-nav-link :href="route('fitness.index')" :active="request()->routeIs('fitness.*')">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            {{ __('Fitness') }}
                        </span>
                    </x-nav-link>

                    <x-nav-link :href="route('checklist.index')" :active="request()->routeIs('checklist.*')">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ __('Checklist') }}
                        </span>
                    </x-nav-link>

                    <x-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.*')">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z"/></svg>
                            {{ __('Reports') }}
                        </span>
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2.5 px-3.5 py-1.5 border border-slate-200/80 text-xs font-bold rounded-none text-slate-700 bg-slate-50/80 hover:bg-slate-100/80 focus:outline-none transition duration-150 shadow-2xs">
                            <span class="w-6 h-6 rounded-none bg-emerald-600 text-white font-black text-[11px] flex items-center justify-center shadow-xs uppercase">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </span>
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2.5 border-b border-slate-100 bg-slate-50/50">
                            <p class="text-xs font-bold text-slate-900 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-[11px] text-slate-400 truncate font-mono">{{ Auth::user()->email }}</p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2 text-xs font-semibold">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            {{ __('Profile & Parameters') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="flex items-center gap-2 text-xs font-semibold text-rose-600 hover:bg-rose-50/60">
                                <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-none text-slate-500 hover:text-slate-700 hover:bg-slate-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-white border-b border-slate-200">
        <div class="pt-2 pb-3 px-3 space-y-1.5">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                🏠 {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('plans.index')" :active="request()->routeIs('plans.*')">
                📋 {{ __('Plans') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('meals.index')" :active="request()->routeIs('meals.*')">
                🍳 {{ __('Meals Tracker') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('fitness.index')" :active="request()->routeIs('fitness.*')">
                💪 {{ __('Fitness & Water') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('checklist.index')" :active="request()->routeIs('checklist.*')">
                📋 {{ __('Daily Checklist') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.*')">
                📊 {{ __('Reports & Analytics') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-3 border-t border-slate-100 bg-slate-50/50 px-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-9 h-9 rounded-none bg-emerald-600 text-white font-black text-xs flex items-center justify-center shadow-xs uppercase">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-bold text-sm text-slate-800">{{ Auth::user()->name }}</div>
                    <div class="font-semibold text-xs text-slate-400">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    ⚙️ {{ __('Profile & Settings') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-rose-600">
                        🚪 {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
