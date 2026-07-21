@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-slate-700 bg-slate-900/60 text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-emerald-500 rounded-none shadow-2xs text-xs font-semibold py-2.5 px-3.5 transition-all']) }}>
