<nav x-data="{ open: false }" class="bg-white border-b border-slate-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-15 items-center">
            <div class="flex items-center gap-8">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded bg-emerald-600 text-white font-bold text-xs flex items-center justify-center">
                            HD
                        </div>
                        <span class="font-bold text-sm text-slate-900 tracking-tight">
                            Human Health <span class="text-emerald-600">Diet</span>
                        </span>
                    </a>
                </div>

                <!-- Desktop Nav Links -->
                <div class="hidden md:flex md:items-center md:gap-1">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('plans.index')" :active="request()->routeIs('plans.*')">
                        {{ __('Plans') }}
                    </x-nav-link>

                    <x-nav-link :href="route('meals.index')" :active="request()->routeIs('meals.*')">
                        {{ __('Meals') }}
                    </x-nav-link>

                    <x-nav-link :href="route('foods.index')" :active="request()->routeIs('foods.*')">
                        {{ __('Foods') }}
                    </x-nav-link>

                    <x-nav-link :href="route('fitness.index')" :active="request()->routeIs('fitness.*')">
                        {{ __('Fitness') }}
                    </x-nav-link>

                    <x-nav-link :href="route('checklist.index')" :active="request()->routeIs('checklist.*')">
                        {{ __('Checklist') }}
                    </x-nav-link>

                    <x-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.*')">
                        {{ __('Reports') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Controls -->
            <div class="hidden sm:flex sm:items-center sm:gap-3">
                <a href="{{ route('terminal.index') }}" 
                   class="inline-flex items-center gap-1.5 text-xs font-mono text-slate-600 hover:text-slate-900 px-2.5 py-1.5 rounded border border-slate-200 hover:bg-slate-50 transition">
                    <span>&gt;_ CLI</span>
                </a>

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-3 py-1.5 rounded border border-slate-200 text-xs font-medium text-slate-700 bg-white hover:bg-slate-50 transition">
                            <span class="w-5 h-5 rounded-full bg-slate-100 text-slate-700 font-bold text-[10px] flex items-center justify-center">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                            <span class="font-semibold text-slate-800">{{ Auth::user()->name }}</span>
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 border-b border-slate-100 bg-slate-50 text-xs">
                            <p class="font-semibold text-slate-800 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-slate-500 truncate text-[11px]">{{ Auth::user()->email }}</p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="text-xs">
                            {{ __('Profile & Settings') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('terminal.index')" class="text-xs font-mono">
                            {{ __('Terminal') }}
                        </x-dropdown-link>

                        <div class="border-t border-slate-100">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-xs text-rose-600 hover:bg-rose-50">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Hamburger -->
            <div class="-me-2 flex items-center md:hidden">
                <button @click="open = ! open"
                    class="p-2 rounded text-slate-500 hover:text-slate-800 hover:bg-slate-100 transition">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Drawer -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden border-t border-slate-200 bg-white">
        <div class="py-2 px-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('plans.index')" :active="request()->routeIs('plans.*')">
                {{ __('Plans') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('meals.index')" :active="request()->routeIs('meals.*')">
                {{ __('Meals') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('foods.index')" :active="request()->routeIs('foods.*')">
                {{ __('Foods') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('fitness.index')" :active="request()->routeIs('fitness.*')">
                {{ __('Fitness') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('checklist.index')" :active="request()->routeIs('checklist.*')">
                {{ __('Checklist') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.*')">
                {{ __('Reports') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('terminal.index')" :active="request()->routeIs('terminal.*')">
                {{ __('Terminal') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-3 pb-3 border-t border-slate-200 px-4 bg-slate-50">
            <div class="mb-2">
                <div class="font-medium text-xs text-slate-800">{{ Auth::user()->name }}</div>
                <div class="text-xs text-slate-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile & Settings') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-rose-600">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
