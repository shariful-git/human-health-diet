<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Human Health & Diet') }} — Client Portal</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

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

<body class="font-sans antialiased bg-slate-900 text-slate-100 selection:bg-emerald-500 selection:text-white min-h-screen flex flex-col justify-center items-center relative overflow-hidden py-12 px-4">
    
    <!-- Background Ambient Gradients -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-emerald-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-teal-600/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full sm:max-w-md relative z-10 space-y-6">
        <!-- Brand Header -->
        <div class="text-center space-y-2">
            <a href="/" class="inline-flex items-center justify-center transition-transform hover:scale-105">
                <div class="flex items-center gap-3 bg-white/10 backdrop-blur-md px-5 py-2.5 rounded-2xl border border-white/15 shadow-xl">
                    <img src="{{ asset('app-logo.png') }}" alt="Human Health Logo" class="w-8 h-8 rounded-lg object-cover shadow-md">
                    <span class="font-black text-lg tracking-tight text-white">
                        HUMAN HEALTH <span class="text-emerald-400">DIET</span>
                    </span>
                </div>
            </a>
        </div>

        <!-- Auth Card -->
        <div class="w-full bg-slate-800/80 backdrop-blur-xl border border-slate-700/80 p-8 rounded-none shadow-2xl space-y-4">
            {{ $slot }}
        </div>

        <!-- Return Home Link -->
        <div class="text-center">
            <a href="/" class="text-xs font-semibold text-slate-400 hover:text-emerald-400 transition-colors">
                ← Return to Public Portal Overview
            </a>
        </div>
    </div>

</body>

</html>
