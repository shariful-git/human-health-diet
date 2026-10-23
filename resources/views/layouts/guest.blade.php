<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-50 text-slate-800 selection:bg-emerald-600 selection:text-white min-h-screen flex flex-col justify-center items-center py-12 px-4">

    <div class="w-full sm:max-w-md space-y-6">
        <!-- Brand Identity Header -->
        <div class="text-center space-y-1.5">
            <a href="/" class="inline-flex items-center justify-center gap-2">
                <span class="w-8 h-8 rounded-md bg-emerald-600 text-white font-bold text-xs flex items-center justify-center shadow-2xs">
                    HD
                </span>
                <span class="font-semibold text-base text-slate-900 tracking-tight">
                    Human Health Diet
                </span>
            </a>
            <p class="text-xs text-slate-500">Sign in or manage your diet account</p>
        </div>

        <!-- Auth Card Box -->
        <div class="w-full bg-white border border-slate-200 p-7 rounded-lg shadow-2xs space-y-5">
            {{ $slot }}
        </div>

        <!-- Return Home Link -->
        <div class="text-center">
            <a href="/" class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-500 hover:text-slate-800 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Back to homepage</span>
            </a>
        </div>
    </div>

</body>

</html>
