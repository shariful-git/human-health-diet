@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-2 text-xs font-bold rounded-lg text-emerald-800 bg-emerald-50 transition nav-link-active'
            : 'inline-flex items-center px-3 py-2 text-xs font-semibold rounded-lg text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
