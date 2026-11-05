<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Human Health & Diet') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-slate-800 min-h-screen flex flex-col app-shell">
    <div class="min-h-screen flex flex-col">
        @include('layouts.navigation')
        <x-toast />

        <!-- Page Header -->
        @isset($header)
            <header class="bg-white/80 backdrop-blur border-b border-slate-200/80">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Main Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <!-- Minimal Footer -->
        <footer class="mt-auto py-7 bg-white/70 border-t border-slate-200/80 text-slate-500 text-xs">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-3">
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-slate-700">{{ config('app.name', 'Human Health & Diet') }}</span>
                    <span>&copy; {{ date('Y') }}. All rights reserved.</span>
                </div>
                <div class="flex items-center gap-4 text-slate-500">
                    <a href="{{ route('dashboard') }}" class="hover:text-slate-800 transition-colors">Dashboard</a>
                    <a href="{{ route('foods.index') }}" class="hover:text-slate-800 transition-colors">Foods</a>
                    <a href="{{ route('plans.index') }}" class="hover:text-slate-800 transition-colors">Plans</a>
                    <a href="{{ route('terminal.index') }}" class="hover:text-slate-800 transition-colors font-mono">Terminal</a>
                </div>
            </div>
        </footer>
    </div>

    <!-- Simple Loader -->
    <div id="global-loader"
        class="fixed inset-0 bg-slate-900/30 z-[9999] flex items-center justify-center hidden">
        <div class="bg-white p-5 rounded-lg shadow-lg flex items-center gap-3 border border-slate-200">
            <div class="w-5 h-5 border-2 border-emerald-600 border-t-transparent rounded-full animate-spin"></div>
            <span class="text-xs font-semibold text-slate-700">Loading...</span>
        </div>
    </div>
</body>

</html>
