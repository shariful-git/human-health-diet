<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Human Health & Diet') }} — Nutrition & Health Tracker</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-slate-50 text-slate-800 selection:bg-emerald-600 selection:text-white min-h-screen flex flex-col font-sans">

    <!-- Top Navigation -->
    <nav class="w-full bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex justify-between items-center">
            
            <!-- Brand -->
            <a href="/" class="flex items-center gap-2.5">
                <span class="w-8 h-8 rounded-md bg-emerald-600 text-white font-bold text-xs flex items-center justify-center shadow-2xs">
                    HD
                </span>
                <span class="font-semibold text-base text-slate-900 tracking-tight">
                    Human Health Diet
                </span>
            </a>

            <!-- Navigation Controls -->
            <div class="flex items-center gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="text-xs font-medium bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-md transition border border-transparent shadow-2xs inline-flex items-center gap-1.5">
                            <span>Open Dashboard</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-xs font-medium text-slate-600 hover:text-slate-900 px-3 py-1.5 transition">
                            Sign In
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="text-xs font-medium bg-emerald-600 hover:bg-emerald-700 text-white px-3.5 py-2 rounded-md transition shadow-2xs border border-transparent">
                                Get Started
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Hero -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left Info Column -->
            <div class="lg:col-span-6 space-y-6 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-800 px-3 py-1 rounded text-xs font-medium">
                    <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                    <span>Daily Nutrition & Health Tracking</span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-semibold tracking-tight text-slate-900 leading-tight">
                    Track your diet, nutrition, and daily habits with clarity.
                </h1>

                <p class="text-base text-slate-600 leading-relaxed max-w-xl mx-auto lg:mx-0">
                    A simple and structured tool to calculate daily calorie targets, log meals, track water intake, and stay consistent with healthy routines.
                </p>

                <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-3 pt-2">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-medium px-5 py-2.5 rounded-md transition shadow-2xs inline-flex items-center justify-center gap-1.5">
                            <span>Go to Dashboard</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                            class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-medium px-5 py-2.5 rounded-md transition shadow-2xs inline-flex items-center justify-center gap-1.5">
                            <span>Create Free Account</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ route('login') }}"
                            class="bg-white hover:bg-slate-50 border border-slate-300 text-slate-700 text-xs font-medium px-5 py-2.5 rounded-md transition shadow-2xs inline-flex items-center justify-center">
                            Sign In
                        </a>
                    @endauth
                </div>

                <!-- Proof points -->
                <div class="grid grid-cols-3 gap-4 pt-6 border-t border-slate-200 max-w-md mx-auto lg:mx-0 text-left">
                    <div>
                        <div class="text-xl font-semibold text-slate-900 font-mono">BMR & TDEE</div>
                        <div class="text-xs text-slate-500 mt-0.5">Calculated from metrics</div>
                    </div>
                    <div>
                        <div class="text-xl font-semibold text-slate-900 font-mono">2,500+</div>
                        <div class="text-xs text-slate-500 mt-0.5">Food database items</div>
                    </div>
                    <div>
                        <div class="text-xl font-semibold text-slate-900 font-mono">PDF & CSV</div>
                        <div class="text-xs text-slate-500 mt-0.5">Exportable reports</div>
                    </div>
                </div>
            </div>

            <!-- Right Box-Type Preview Panel -->
            <div class="lg:col-span-6 w-full">
                <div class="bg-white rounded-lg border border-slate-200 p-6 shadow-2xs space-y-5">
                    
                    <!-- Box Header -->
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <div>
                            <span class="text-[11px] font-medium text-slate-400 uppercase tracking-wider">Today's Summary</span>
                            <div class="flex items-baseline gap-2 mt-0.5">
                                <span class="text-2xl font-semibold text-slate-900 font-mono">1,820</span>
                                <span class="text-xs text-slate-500 font-medium">/ 2,150 kcal goal</span>
                            </div>
                        </div>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                            On Track
                        </span>
                    </div>

                    <!-- Calorie Progress -->
                    <div class="space-y-1.5">
                        <div class="flex justify-between text-xs text-slate-600 font-medium">
                            <span>Daily Calorie Budget</span>
                            <span class="font-mono">85%</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded h-2.5 overflow-hidden">
                            <div class="bg-emerald-600 h-full rounded" style="width: 85%"></div>
                        </div>
                    </div>

                    <!-- Macro Cards Box -->
                    <div class="grid grid-cols-3 gap-3">
                        <div class="bg-slate-50 p-3 rounded border border-slate-200 text-center">
                            <span class="text-[10px] font-medium uppercase text-slate-500 tracking-wider block">Protein</span>
                            <span class="text-base font-semibold text-slate-800 font-mono mt-0.5 block">135g</span>
                        </div>
                        <div class="bg-slate-50 p-3 rounded border border-slate-200 text-center">
                            <span class="text-[10px] font-medium uppercase text-slate-500 tracking-wider block">Carbs</span>
                            <span class="text-base font-semibold text-slate-800 font-mono mt-0.5 block">195g</span>
                        </div>
                        <div class="bg-slate-50 p-3 rounded border border-slate-200 text-center">
                            <span class="text-[10px] font-medium uppercase text-slate-500 tracking-wider block">Fats</span>
                            <span class="text-base font-semibold text-slate-800 font-mono mt-0.5 block">48g</span>
                        </div>
                    </div>

                    <!-- Hydration & Streak Row -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                        <div class="p-3 rounded border border-slate-200 bg-slate-50 space-y-1.5">
                            <div class="flex justify-between text-xs font-medium text-slate-700">
                                <span>Water Intake</span>
                                <span class="font-mono text-sky-700 font-semibold">2,200 ml</span>
                            </div>
                            <div class="w-full bg-slate-200 rounded h-1.5 overflow-hidden">
                                <div class="bg-sky-500 h-full rounded" style="width: 75%"></div>
                            </div>
                            <span class="text-[10px] text-slate-500 block">Target: 3,000 ml</span>
                        </div>

                        <div class="p-3 rounded border border-slate-200 bg-slate-50 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] font-medium uppercase text-slate-500 tracking-wider block">Habit Streak</span>
                                <span class="text-sm font-semibold text-slate-900 mt-0.5 block">14 Days Active</span>
                            </div>
                            <div class="w-8 h-8 rounded-md bg-emerald-50 border border-emerald-200 flex items-center justify-center text-emerald-700 font-bold text-xs">
                                ✓
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </main>

    <!-- Core Features Box Grid -->
    <section class="bg-white border-t border-slate-200 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            
            <div class="max-w-2xl mx-auto text-center space-y-2">
                <span class="text-xs font-semibold uppercase tracking-wider text-emerald-700">Features</span>
                <h2 class="text-2xl sm:text-3xl font-semibold tracking-tight text-slate-900">
                    Everything you need to manage your daily diet
                </h2>
                <p class="text-slate-500 text-xs sm:text-sm">
                    Designed for everyday use with clean interfaces and accurate nutrition tracking.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Feature 1 -->
                <div class="p-6 rounded-lg border border-slate-200 bg-slate-50 space-y-3">
                    <div class="w-9 h-9 rounded-md bg-white border border-slate-200 text-emerald-700 flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z"/></svg>
                    </div>
                    <h3 class="text-sm font-semibold text-slate-900">Calorie & Macro Goals</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">
                        Automatic calorie target calculations based on your height, weight, age, and activity level with custom adjustments for weight loss, maintenance, or gain.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="p-6 rounded-lg border border-slate-200 bg-slate-50 space-y-3">
                    <div class="w-9 h-9 rounded-md bg-white border border-slate-200 text-emerald-700 flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <h3 class="text-sm font-semibold text-slate-900">Meal & Food Logging</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">
                        Easily log breakfast, lunch, dinner, and snacks with a searchable food database and automatic calculation of proteins, carbohydrates, and fats.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="p-6 rounded-lg border border-slate-200 bg-slate-50 space-y-3">
                    <div class="w-9 h-9 rounded-md bg-white border border-slate-200 text-emerald-700 flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-sm font-semibold text-slate-900">Habits & Daily Checklists</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">
                        Stay accountable with daily hydration tracking, workout logging, customizable checklists, and exportable weekly audit reports.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="mt-auto py-8 bg-white border-t border-slate-200 text-slate-500 text-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-2">
                <span>&copy; {{ date('Y') }} {{ config('app.name', 'Human Health & Diet') }}. All rights reserved.</span>
            </div>
            <div class="flex items-center gap-5">
                <a href="{{ route('login') }}" class="hover:text-slate-800 transition-colors">Sign In</a>
                <a href="{{ route('register') }}" class="hover:text-slate-800 transition-colors">Create Account</a>
                <a href="{{ route('terminal.index') }}" class="hover:text-slate-800 transition-colors font-mono">Terminal</a>
            </div>
        </div>
    </footer>

</body>

</html>