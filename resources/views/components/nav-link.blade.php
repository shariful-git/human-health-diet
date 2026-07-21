@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3.5 py-2 text-xs font-extrabold tracking-wide uppercase rounded-none bg-emerald-500/10 text-emerald-700 border border-emerald-500/40 transition-all duration-200'
            : 'inline-flex items-center px-3.5 py-2 text-xs font-bold tracking-wide uppercase rounded-none text-slate-600 hover:text-slate-900 hover:bg-slate-100/80 transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
