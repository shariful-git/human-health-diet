@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border border-slate-300 bg-white text-slate-900 placeholder-slate-400 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 rounded text-xs py-2 px-3 transition shadow-xs disabled:bg-slate-100 disabled:text-slate-500']) }}>
