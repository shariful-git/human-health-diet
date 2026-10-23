<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white font-semibold text-xs rounded border border-transparent transition shadow-xs focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-1 disabled:opacity-50']) }}>
    {{ $slot }}
</button>
