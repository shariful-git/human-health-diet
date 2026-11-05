@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full px-3 py-2.5 rounded-lg text-xs font-bold text-emerald-800 bg-emerald-50 transition nav-link-active'
            : 'block w-full px-3 py-2.5 rounded-lg text-xs font-semibold text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
