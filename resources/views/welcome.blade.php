<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Human Health & Diet') }} — Enterprise Metabolic & Dietary Platform</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Ubuntu', sans-serif;
        }
    </style>
</head>

<body class="antialiased bg-slate-900 text-slate-100 selection:bg-emerald-500 selection:text-white overflow-x-hidden min-h-screen flex flex-col">

    <!-- Ambient Glow background elements -->
    <div class="fixed top-0 left-1/2 -translate-x-1/2 sm:left-1/3 sm:translate-x-0 w-[300px] sm:w-[600px] h-[300px] sm:h-[600px] bg-emerald-600/15 rounded-full blur-[100px] sm:blur-[140px] pointer-events-none -z-10"></div>
    <div class="fixed bottom-0 right-0 sm:right-1/4 w-[250px] sm:w-[500px] h-[250px] sm:h-[500px] bg-teal-600/15 rounded-full blur-[100px] sm:blur-[140px] pointer-events-none -z-10"></div>

    <!-- Header Navigation -->
    <nav class="w-full bg-slate-900/80 backdrop-blur-xl border-b border-slate-800/80 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 sm:h-20 flex justify-between items-center gap-2">
            
            <!-- Corporate Identity -->
            <a href="/" class="flex items-center gap-2.5 sm:gap-3 group shrink-0">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-none bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-lg shadow-emerald-500/20 group-hover:scale-105 transition-transform">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                    </svg>
                </div>
                <span class="font-extrabold text-sm sm:text-lg tracking-tight text-white">
                    HUMAN HEALTH <span class="text-emerald-400 font-black">DIET</span>
                </span>
            </a>

            <!-- Navigation Controls -->
            <div class="flex items-center gap-2 sm:gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="text-[10px] sm:text-xs font-extrabold uppercase tracking-wider bg-emerald-600 text-white px-3.5 sm:px-5 h-9 sm:h-11 inline-flex items-center rounded-none hover:bg-emerald-500 transition-all shadow-md shadow-emerald-600/20">
                            DASHBOARD →
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-[11px] sm:text-xs font-extrabold uppercase tracking-wider text-slate-300 hover:text-white transition-colors px-2.5 sm:px-4 py-2">
                            LOGIN
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="text-[10px] sm:text-xs font-extrabold uppercase tracking-wider bg-emerald-600 text-white px-3.5 sm:px-5 h-9 sm:h-11 inline-flex items-center rounded-none hover:bg-emerald-500 transition-all shadow-md shadow-emerald-600/20">
                                REGISTER
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Hero Section -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 sm:pt-16 pb-16 sm:pb-24 lg:pt-24 lg:pb-32 grid grid-cols-1 lg:grid-cols-12 gap-10 sm:gap-16 items-center relative">
        
        <!-- Left Content Column -->
        <div class="lg:col-span-6 space-y-6 sm:space-y-8 text-center lg:text-left">
            <div class="inline-flex items-center gap-2 bg-slate-800/90 border border-slate-700 text-slate-300 px-3 sm:px-4 py-1.5 rounded-full text-[10px] sm:text-[11px] font-extrabold tracking-wider uppercase shadow-xs max-w-full truncate">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse shrink-0"></span>
                <span class="truncate">Metabolic Intelligence Engine v4.2 Stable</span>
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight text-white leading-[1.15] sm:leading-[1.1]">
                The analytical platform for 
                <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent block mt-1">
                    metabolic control.
                </span>
            </h1>

            <p class="text-sm sm:text-base lg:text-lg text-slate-400 leading-relaxed font-normal max-w-xl mx-auto lg:mx-0">
                {{ config('app.name') }} abstracts the complexity of human nutrition. Synthesize real-time biometric inputs, execute automated dynamic energy expenditure projections, and audit systemic cellular hydration thresholds.
            </p>

            <div class="flex flex-col sm:flex-row flex-wrap justify-center lg:justify-start gap-3 sm:gap-4 w-full">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="w-full sm:w-auto bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-xs font-extrabold uppercase tracking-wider px-8 h-12 inline-flex items-center justify-center rounded-none shadow-lg shadow-emerald-600/25 hover:from-emerald-500 hover:to-teal-500 transition-all">
                        Launch Your Dynamic Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}"
                        class="w-full sm:w-auto bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-xs font-extrabold uppercase tracking-wider px-8 h-12 inline-flex items-center justify-center rounded-none shadow-lg shadow-emerald-600/25 hover:from-emerald-500 hover:to-teal-500 transition-all">
                        REGISTER
                    </a>
                    <a href="{{ route('login') }}"
                        class="w-full sm:w-auto bg-slate-800/80 border border-slate-700 text-slate-200 text-xs font-extrabold uppercase tracking-wider px-8 h-12 inline-flex items-center justify-center rounded-none hover:bg-slate-700 hover:text-white transition-all">
                        LOGIN
                    </a>
                @endauth
            </div>
        </div>

        <!-- Right Diagnostic Preview Column -->
        <div class="lg:col-span-6 relative w-full">
            <div class="relative bg-slate-800/90 backdrop-blur-2xl rounded-none shadow-2xl border border-slate-700/80 p-4 sm:p-6 lg:p-8 space-y-5 sm:space-y-6 overflow-hidden">
                <div class="absolute -top-16 -right-16 w-32 h-32 bg-emerald-500/10 rounded-full blur-2xl pointer-events-none"></div>

                <!-- Clinical Header View -->
                <div class="flex flex-row items-center justify-between border-b border-slate-700/60 pb-4 sm:pb-5 gap-2">
                    <div class="space-y-1">
                        <div class="flex items-center gap-1.5 sm:gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse shrink-0"></span>
                            <p class="text-[9px] sm:text-[10px] font-black tracking-widest uppercase text-slate-400">Total System Energy Matrix</p>
                        </div>
                        <div class="flex items-baseline gap-1.5 sm:gap-2 flex-wrap">
                            <span class="text-2xl sm:text-4xl font-black text-white tracking-tight font-mono">1,940</span>
                            <span class="text-[10px] sm:text-xs font-bold text-emerald-400 uppercase tracking-wider">kcal / total exp</span>
                        </div>
                    </div>
                    <div>
                        <span class="inline-flex items-center gap-1 bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 text-[9px] sm:text-[10px] font-black tracking-wider uppercase px-2.5 sm:px-3.5 py-1 sm:py-1.5 rounded-full shrink-0 shadow-xs">
                            <svg class="w-3 h-3 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span class="hidden xs:inline">Optimal</span> Curve
                        </span>
                    </div>
                </div>

                <!-- Live Metrics Array -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                    <!-- Data Block 1 -->
                    <div class="p-3.5 sm:p-4 rounded-none border border-slate-700/60 bg-slate-900/80 space-y-2.5 sm:space-y-3 hover:border-slate-600 transition-colors">
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] sm:text-[11px] font-extrabold tracking-wider text-slate-300 uppercase">Micronutrient Audit</span>
                            <span class="text-xs font-black text-emerald-400 font-mono">72.4%</span>
                        </div>
                        <div class="w-full bg-slate-800 h-2 rounded-full overflow-hidden p-0.5 border border-slate-700/50">
                            <div class="bg-gradient-to-r from-emerald-500 to-teal-400 h-full rounded-full transition-all duration-500" style="width: 72.4%"></div>
                        </div>
                        <p class="text-[10px] text-slate-400 font-medium">Trace values match optimized macro profiles.</p>
                    </div>

                    <!-- Data Block 2 -->
                    <div class="p-3.5 sm:p-4 rounded-none border border-slate-700/60 bg-slate-900/80 space-y-2.5 sm:space-y-3 hover:border-slate-600 transition-colors">
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] sm:text-[11px] font-extrabold tracking-wider text-slate-300 uppercase">Volumetric Hydration</span>
                            <span class="text-xs font-black text-cyan-400 font-mono">75.0%</span>
                        </div>
                        <div class="w-full bg-slate-800 h-2 rounded-full overflow-hidden p-0.5 border border-slate-700/50">
                            <div class="bg-gradient-to-r from-cyan-500 to-blue-500 h-full rounded-full transition-all duration-500" style="width: 75%"></div>
                        </div>
                        <p class="text-[10px] text-slate-400 font-medium">2,250ml verified / 3,000ml baseline target.</p>
                    </div>
                </div>

                <!-- Live Status Footer -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between text-[10px] sm:text-[11px] bg-slate-950/90 p-3.5 sm:p-4 rounded-none border border-slate-800/80 font-mono gap-1.5 sm:gap-2">
                    <span class="flex items-center gap-2 text-slate-300">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 inline-block animate-ping shrink-0"></span>
                        <span class="truncate">METABOLIC STREAK: 05 CYCLES SECURED</span>
                    </span>
                    <span class="text-emerald-400 font-black tracking-wider shrink-0">+120 INDEX PTS</span>
                </div>

            </div>
        </div>
    </main>

    <!-- Features Section -->
    <section class="bg-slate-950 border-t border-slate-800 py-16 sm:py-24 lg:py-32 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="max-w-3xl mx-auto text-center mb-12 sm:mb-20 space-y-3">
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight text-white">
                    Engineered for computational metabolic accuracy.
                </h2>
                <p class="text-slate-400 font-medium max-w-xl mx-auto text-xs sm:text-base">
                    Eliminate human error with structured journal logging and biometric standard modeling.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                
                <!-- Feature 1 -->
                <div class="p-6 sm:p-8 rounded-none border border-slate-800 bg-slate-900/50 hover:border-emerald-500/40 hover:shadow-xl hover:shadow-emerald-500/5 transition-all duration-300 space-y-4">
                    <div class="w-10 h-10 sm:w-11 sm:h-11 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 rounded-none flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z" />
                        </svg>
                    </div>
                    <h3 class="text-base font-extrabold text-white tracking-tight">Predictive BMR & TDEE Calculations</h3>
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed font-normal">
                        Automate baseline metabolic variables utilizing standardized Harris-Benedict formulas mapping dynamic adjustments directly against weight fluctuations.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="p-6 sm:p-8 rounded-none border border-slate-800 bg-slate-900/50 hover:border-emerald-500/40 hover:shadow-xl hover:shadow-emerald-500/5 transition-all duration-300 space-y-4">
                    <div class="w-10 h-10 sm:w-11 sm:h-11 bg-teal-500/10 text-teal-400 border border-teal-500/20 rounded-none flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-base font-extrabold text-white tracking-tight">Granular Macronutrient Auditing</h3>
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed font-normal">
                        Log accurate molecular profile distributions. Isolate structural proteins, clean complex carbohydrate bonds, saturated limits, and total dietary fibers.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="p-6 sm:p-8 rounded-none border border-slate-800 bg-slate-900/50 hover:border-emerald-500/40 hover:shadow-xl hover:shadow-emerald-500/5 transition-all duration-300 space-y-4">
                    <div class="w-10 h-10 sm:w-11 sm:h-11 bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 rounded-none flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-base font-extrabold text-white tracking-tight">Automated Verification Engines</h3>
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed font-normal">
                        Lock in biological parameter checkpoints daily to track operational health integrity markers and unlock daily challenge rewards.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-6 sm:py-8 px-4 text-[10px] sm:text-xs tracking-widest font-extrabold uppercase text-slate-500 bg-slate-950 border-t border-slate-900">
        &copy; {{ date('Y') }} {{ config('app.name', 'Human Health & Diet') }}. All intellectual properties registered.
    </footer>

</body>

</html>