<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Human Health Diet Control System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-slate-50 text-slate-900 selection:bg-indigo-500 selection:text-white">

    <nav class="w-full bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center justify-center shadow-md shadow-indigo-200">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <span class="font-extrabold text-xl tracking-tight text-slate-900">AuraPulse</span>
            </div>
            
            <div class="flex items-center gap-5">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-bold bg-slate-900 text-white px-6 h-11 flex items-center rounded-xl hover:bg-slate-800 transition-all duration-200 shadow-sm">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900 transition-colors">Sign In</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm font-bold bg-indigo-600 text-white px-6 h-11 flex items-center rounded-xl hover:bg-indigo-700 transition-all duration-200 shadow-lg shadow-indigo-100">Join Free</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 pt-16 pb-24 lg:pt-28 lg:pb-36 grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
        <div class="lg:col-span-7 space-y-8 text-center lg:text-left">
            <div class="inline-flex items-center gap-2 bg-indigo-50 text-indigo-700 px-4 py-2 rounded-full text-xs font-bold tracking-wide uppercase">
                <span class="w-2 h-2 rounded-full bg-indigo-600 animate-ping"></span>
                The Intelligent Diet Optimizer
            </div>
            
            <h1 class="text-5xl sm:text-7xl font-extrabold tracking-tight text-slate-900 leading-[1.1]">
                Precision tracking for a <span class="bg-gradient-to-r from-indigo-600 to-violet-600 bg-clip-text text-transparent">healthier you.</span>
            </h1>
            
            <p class="text-lg text-slate-500 max-w-xl mx-auto lg:mx-0 leading-relaxed font-medium">
                Log meals, track active calorie expenditure, monitor hydration, and unlock streak-based rewards inside a unified dashboard engineered for lifestyle transformation.
            </p>
            
            <div class="flex flex-wrap justify-center lg:justify-start gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-slate-900 text-white font-bold px-8 h-14 flex items-center rounded-xl shadow-xl shadow-slate-200 hover:bg-slate-800 transition-all">Go to App Dashboard</a>
                @else
                    <a href="{{ route('register') }}" class="bg-indigo-600 text-white font-bold px-8 h-14 flex items-center rounded-xl shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all">Start Your Journey</a>
                    <a href="{{ route('login') }}" class="bg-white border border-slate-200 text-slate-700 font-bold px-8 h-14 flex items-center rounded-xl hover:bg-slate-50 transition-all">Sign In</a>
                @endauth
            </div>
        </div>

        <div class="lg:col-span-5 relative">
            <div class="absolute inset-0 bg-gradient-to-tr from-indigo-500 to-purple-500 rounded-3xl opacity-10 filter blur-3xl -z-10"></div>
            
            <div class="bg-slate-900 rounded-3xl shadow-2xl p-8 text-white space-y-6 border border-slate-800">
                <div class="flex justify-between items-center border-b border-slate-800 pb-4">
                    <div>
                        <p class="text-xs font-bold tracking-wider uppercase text-slate-400">Daily Balance</p>
                        <h4 class="text-3xl font-black mt-1">1,940 <span class="text-sm font-normal text-slate-500">kcal</span></h4>
                    </div>
                    <span class="bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 text-xs px-3 py-1.5 rounded-xl font-bold">Deficit Active</span>
                </div>
                
                <div class="space-y-4">
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs font-bold text-slate-300">
                            <span>🍳 Micronutrients</span>
                            <span>72%</span>
                        </div>
                        <div class="w-full bg-slate-800 h-2 rounded-full overflow-hidden">
                            <div class="bg-indigo-500 h-full rounded-full" style="width: 72%"></div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs font-bold text-slate-300">
                            <span>💧 Water Hydration</span>
                            <span>2,250 / 3000 ml</span>
                        </div>
                        <div class="w-full bg-slate-800 h-2 rounded-full overflow-hidden">
                            <div class="bg-sky-400 h-full rounded-full" style="width: 75%"></div>
                        </div>
                    </div>
                </div>

                <div class="pt-2 flex justify-between items-center text-xs text-slate-400 font-semibold bg-slate-800/40 p-3.5 rounded-2xl border border-slate-800">
                    <span class="flex items-center gap-2"><span class="text-amber-500">🔥</span> 5 Days Streak Active</span>
                    <span class="text-indigo-400">+120 pts</span>
                </div>
            </div>
        </div>
    </main>

    <section class="bg-white border-t border-slate-100 py-24">
        <div class="max-w-7xl mx-auto px-6">
            <div class="max-w-2xl mx-auto text-center mb-16 space-y-3">
                <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">Engineered for real results.</h2>
                <p class="text-slate-500 font-medium">A scientific approach to fitness and clean eating architecture.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-8 rounded-2xl border border-slate-100 hover:border-indigo-100 transition-all duration-300 bg-slate-50/50 space-y-4 group">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center border border-slate-200/60 shadow-sm group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5 text-indigo-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Automated BMR & TDEE</h3>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">Instantly calculate dynamic metabolic variables using standardized biometric models mapped directly to your final profile goals.</p>
                </div>

                <div class="p-8 rounded-2xl border border-slate-100 hover:border-indigo-100 transition-all duration-300 bg-slate-50/50 space-y-4 group">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center border border-slate-200/60 shadow-sm group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5 text-indigo-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.364l-.707-.707M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Granular Macro Logging</h3>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">Breakdown nutritional journals across key metrics including protein, carbohydrate structures, dietary fibers, and systemic fat limits.</p>
                </div>

                <div class="p-8 rounded-2xl border border-slate-100 hover:border-indigo-100 transition-all duration-300 bg-slate-50/50 space-y-4 group">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center border border-slate-200/60 shadow-sm group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5 text-indigo-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Gamified Reward Engine</h3>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">Consistently close out your daily lifestyle metrics checkpoint to retain streaks, level up logs, and secure future premium benefits.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-center py-12 text-xs font-semibold text-slate-400 bg-slate-50 border-t border-slate-100/60">
        &copy; {{ date('Y') }} AuraPulse Architecture. Powered by Laravel 12. All rights reserved.
    </footer>

</body>
</html>