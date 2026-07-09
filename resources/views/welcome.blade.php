<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} — Enterprise-Grade Metabolic & Dietary Intelligence Architecture</title>
    
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

<body class="antialiased bg-slate-50 text-slate-900 selection:bg-emerald-600 selection:text-white overflow-x-hidden">

    <!-- Premium Enterprise Header Navigation -->
    <nav class="w-full bg-white/80 backdrop-blur-xl border-b border-slate-200/50 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 h-20 flex justify-between items-center">
            
            <!-- Corporate Identity -->
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-emerald-600 to-emerald-800 flex items-center justify-center shadow-md shadow-emerald-700/20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                    </svg>
                </div>
                <span class="font-bold text-lg tracking-tight text-slate-900">
                    HUMAN HEALTH <span class="text-emerald-600 font-extrabold">DIET</span>
                </span>
            </a>

            <!-- Navigation Controls -->
            <div class="flex items-center gap-6">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="text-xs font-bold uppercase tracking-wider bg-slate-900 text-white px-5 h-10 inline-flex items-center rounded-lg hover:bg-slate-800 transition-all shadow-sm">
                            Access Console
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm font-semibold text-slate-600 hover:text-emerald-600 transition-colors py-2">
                            Client Sign In
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="text-xs font-bold uppercase tracking-wider bg-emerald-600 text-white px-5 h-10 inline-flex items-center rounded-lg hover:bg-emerald-700 transition-all shadow-sm shadow-emerald-600/10">
                                Deploy Account
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Hero Architectural Section -->
    <main class="max-w-7xl mx-auto px-6 sm:px-8 pt-16 pb-24 lg:pt-28 lg:pb-36 grid grid-cols-1 lg:grid-cols-12 gap-16 items-center relative">
        
        <!-- Scientific Data Columns Map Content -->
        <div class="lg:col-span-6 space-y-8 text-center lg:text-left">
            <div class="inline-flex items-center gap-2 bg-slate-900 text-slate-200 px-3.5 py-1.5 rounded-md text-[10px] font-bold tracking-widest uppercase shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                Engine Engine v4.2 Stable
            </div>

            <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight text-slate-900 leading-[1.1]">
                The analytical platform for 
                <span class="bg-gradient-to-r from-emerald-600 to-teal-700 bg-clip-text text-transparent block">
                    metabolic control.
                </span>
            </h1>

            <p class="text-base sm:text-lg text-slate-600 leading-relaxed font-normal max-w-xl mx-auto lg:mx-0">
                {{ config('app.name') }} abstracts the complexity of human nutrition. Synthesize real-time biometric inputs, execute automated dynamic energy expenditure projections, and audit systemic cellular hydration thresholds.
            </p>

            <div class="flex flex-wrap justify-center lg:justify-start gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="bg-slate-900 text-white text-xs font-bold uppercase tracking-wider px-7 h-12 inline-flex items-center rounded-lg shadow-md hover:bg-slate-800 transition-all">
                        Launch Systems Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}"
                        class="bg-emerald-600 text-white text-xs font-bold uppercase tracking-wider px-7 h-12 inline-flex items-center rounded-lg shadow-md shadow-emerald-600/10 hover:bg-emerald-700 transition-all">
                        Initialize Deployment
                    </a>
                    <a href="{{ route('login') }}"
                        class="bg-white border border-slate-200 text-slate-700 text-xs font-bold uppercase tracking-wider px-7 h-12 inline-flex items-center rounded-lg hover:bg-slate-50 hover:border-slate-300 transition-all">
                        Request Access
                    </a>
                @endauth
            </div>
        </div>

        <!-- Analytical Data Diagnostic Interface (Right Column View) -->
        <div class="lg:col-span-6 relative">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-2xl opacity-5 filter blur-3xl -z-10"></div>

            <div class="bg-white rounded-2xl shadow-xl border border-slate-200/60 p-6 sm:p-8 space-y-6">
                
                <!-- Clinical Header View -->
                <div class="flex justify-between items-start border-b border-slate-100 pb-5">
                    <div>
                        <p class="text-[10px] font-bold tracking-widest uppercase text-slate-400">Total System Energy Matrix</p>
                        <h4 class="text-4xl font-extrabold mt-1 text-slate-900 tracking-tight">1,940 <span class="text-xs font-medium text-slate-400 tracking-normal ml-1">KCAL / TOTAL EXP</span></h4>
                    </div>
                    <span class="bg-emerald-50 text-emerald-700 border border-emerald-100 text-[10px] font-bold tracking-wide uppercase px-2.5 py-1 rounded">
                        Optimal Curve
                    </span>
                </div>

                <!-- Live Dynamic Realtime Metrics Array -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Data Block 1 -->
                    <div class="p-4 rounded-xl border border-slate-100 bg-slate-50/60 space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-[11px] font-bold tracking-wider text-slate-400 uppercase">Micronutrient Audit</span>
                            <span class="text-xs font-bold text-emerald-600 font-mono">72.4%</span>
                        </div>
                        <div class="w-full bg-slate-200 h-1.5 rounded-full overflow-hidden">
                            <div class="bg-emerald-600 h-full rounded-full" style="width: 72.4%"></div>
                        </div>
                        <p class="text-[10px] text-slate-500 font-medium">Trace values match optimized macro profiles.</p>
                    </div>

                    <!-- Data Block 2 -->
                    <div class="p-4 rounded-xl border border-slate-100 bg-slate-50/60 space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-[11px] font-bold tracking-wider text-slate-400 uppercase">Volumetric Hydration</span>
                            <span class="text-xs font-bold text-teal-600 font-mono">75.0%</span>
                        </div>
                        <div class="w-full bg-slate-200 h-1.5 rounded-full overflow-hidden">
                            <div class="bg-teal-600 h-full rounded-full" style="width: 75%"></div>
                        </div>
                        <p class="text-[10px] text-slate-500 font-medium">2,250ml verified / 3,000ml baseline target.</p>
                    </div>
                </div>

                <!-- Systems Architecture Analytics Logging Status Footer -->
                <div class="flex items-center justify-between text-[11px] text-slate-500 bg-slate-900 text-slate-300 p-4 rounded-xl shadow-inner font-mono">
                    <span class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 inline-block animate-ping"></span>
                        METABOLIC STREAK: 05 CYCLES SECURED
                    </span>
                    <span class="text-emerald-400 font-bold">+120 INDEX PTS</span>
                </div>

            </div>
        </div>
    </main>

    <!-- Operational Platform Core Architecture Details -->
    <section class="bg-white border-t border-slate-200/60 py-24 sm:py-32">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            
            <div class="max-w-3xl mx-auto text-center mb-20 space-y-3">
                <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                    Engineered for computational metabolic accuracy.
                </h2>
                <p class="text-slate-500 font-medium max-w-xl mx-auto text-sm sm:text-base">
                    Eliminate human error with decentralized journal structures and biometric standard modeling.
                </p>
            </div>

            <!-- Features Systems Array Grid Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Corporate Pillar Feature Component 1 -->
                <div class="p-8 rounded-xl border border-slate-200/60 hover:border-emerald-500/30 hover:shadow-lg transition-all duration-300 space-y-4 bg-slate-50/30">
                    <div class="w-10 h-10 bg-slate-900 text-emerald-400 rounded-lg flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z" />
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 tracking-tight">Predictive BMR & TDEE Calculations</h3>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">
                        Automate baseline metabolic variables utilizing standardized Harris-Benedict formulas mapping dynamic adjustments directly against systemic weight fluctuations.
                    </p>
                </div>

                <!-- Corporate Pillar Feature Component 2 -->
                <div class="p-8 rounded-xl border border-slate-200/60 hover:border-emerald-500/30 hover:shadow-lg transition-all duration-300 space-y-4 bg-slate-50/30">
                    <div class="w-10 h-10 bg-slate-900 text-emerald-400 rounded-lg flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 tracking-tight">Granular Macronutrient Auditing</h3>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">
                        Log accurate molecular profile distributions. Isolate structural proteins, clean complex carbohydrate bonds, saturated limits, and total dietary asset fibers.
                    </p>
                </div>

                <!-- Corporate Pillar Feature Component 3 -->
                <div class="p-8 rounded-xl border border-slate-200/60 hover:border-emerald-500/30 hover:shadow-lg transition-all duration-300 space-y-4 bg-slate-50/30">
                    <div class="w-10 h-10 bg-slate-900 text-emerald-400 rounded-lg flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 tracking-tight">Automated Verification Engines</h3>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">
                        Lock in biological parameters checkpoints daily to track operational health integrity markers, secure system levels, and clear modern premium platform pathways.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- Structural Minimal Clean Corporate Footer Layout -->
    <footer class="text-center py-12 text-[10px] tracking-widest font-bold uppercase text-slate-400 bg-slate-50 border-t border-slate-200/50">
        &copy; {{ date('Y') }} {{ config('app.name') }} Core Global Architecture. All intellectual data properties registered.
    </footer>

</body>

</html>