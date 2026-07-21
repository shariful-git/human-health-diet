<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-5 py-3 bg-gradient-to-r from-emerald-600 to-teal-700 hover:from-emerald-700 hover:to-teal-800 border border-emerald-500/30 rounded-none font-extrabold text-xs text-white uppercase tracking-widest focus:outline-none transition-all shadow-md duration-150']) }}>
    {{ $slot }}
</button>
