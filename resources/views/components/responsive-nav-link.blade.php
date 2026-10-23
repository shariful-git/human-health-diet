@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full px-3 py-2 rounded text-xs font-semibold text-slate-900 bg-slate-100 transition'
            : 'block w-full px-3 py-2 rounded text-xs font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
