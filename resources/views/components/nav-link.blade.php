@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-1.5 text-xs font-semibold rounded text-slate-900 bg-slate-100 transition'
            : 'inline-flex items-center px-3 py-1.5 text-xs font-medium rounded text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
