@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full px-4 py-2.5 rounded-none font-bold text-sm bg-emerald-500/10 text-emerald-700 border-l-4 border-emerald-600 transition-all duration-150'
            : 'block w-full px-4 py-2.5 rounded-none font-semibold text-sm text-slate-600 hover:text-slate-900 hover:bg-slate-100/80 transition-all duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
