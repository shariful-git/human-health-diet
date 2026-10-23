<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 py-2 bg-white hover:bg-slate-50 text-slate-700 font-medium text-xs rounded border border-slate-300 transition shadow-xs focus:outline-none focus:ring-2 focus:ring-slate-300 disabled:opacity-50']) }}>
    {{ $slot }}
</button>
