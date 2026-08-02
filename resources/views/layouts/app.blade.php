<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Human Health & Diet') }} — Metabolic & Dietary Platform</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Ubuntu', sans-serif;
        }
    </style>
</head>

<body class="font-sans antialiased bg-slate-50/70 text-slate-900 selection:bg-emerald-600 selection:text-white min-h-screen flex flex-col">
    <div class="min-h-screen flex flex-col">
        @include('layouts.navigation')
        <x-toast />

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white/70 backdrop-blur-md border-b border-slate-200/60 sticky top-16 z-30 shadow-xs">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <!-- Modern Footer -->
        <footer class="mt-auto py-6 bg-white/80 border-t border-slate-200/60 text-center text-xs font-semibold text-slate-500">
            <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row justify-between items-center gap-2">
                <span>&copy; {{ date('Y') }} {{ config('app.name', 'Human Health & Diet') }}. All rights reserved.</span>
                <span class="inline-flex items-center gap-1.5 text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200/50">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Dynamic Engine Active
                </span>
            </div>
        </footer>
    </div>

    <!-- Global Processing Loader -->
    <div id="global-loader"
        class="fixed inset-0 bg-slate-950/40 backdrop-blur-md z-[9999] flex items-center justify-center hidden transition-opacity duration-300">
        <div class="bg-white p-7 rounded-3xl shadow-2xl flex flex-col items-center gap-4 border border-slate-100/80 max-w-xs text-center">
            <div class="relative w-12 h-12 flex items-center justify-center">
                <div class="w-12 h-12 border-4 border-emerald-200 border-t-emerald-600 rounded-full animate-spin"></div>
                <div class="absolute w-6 h-6 bg-emerald-600 rounded-full blur-xs opacity-30"></div>
            </div>
            <div>
                <p class="text-xs font-black tracking-widest text-slate-800 uppercase">Processing Biometrics</p>
                <p class="text-[11px] text-slate-500 mt-1">Updating metabolic parameters...</p>
            </div>
        </div>
    </div>
</body>

</html>
