@props([])

<div x-data="{
    toasts: [],
    addToast(message, type = 'success') {
        const id = Date.now();
        this.toasts.push({ id, message, type, show: true });
        setTimeout(() => {
            this.removeToast(id);
        }, 5000);
    },
    removeToast(id) {
        this.toasts = this.toasts.filter(t => t.id !== id);
    }
}"
x-init="
    @if (session('success'))
        addToast({{ json_encode(session('success')) }}, 'success');
    @endif
    @if (session('error'))
        addToast({{ json_encode(session('error')) }}, 'error');
    @endif
    @if (session('info'))
        addToast({{ json_encode(session('info')) }}, 'info');
    @endif
    @if (session('status'))
        addToast({{ json_encode(session('status')) }}, 'info');
    @endif
    @if (session('warning'))
        addToast({{ json_encode(session('warning')) }}, 'warning');
    @endif
"
@toast.window="addToast($event.detail.message, $event.detail.type || 'success')"
class="fixed top-20 right-5 z-[9999] max-w-sm w-full space-y-3 pointer-events-none">

    <template x-for="toast in toasts" :key="toast.id">
        <div x-show="toast.show"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-x-full opacity-0 scale-95"
            x-transition:enter-end="translate-x-0 opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="translate-x-0 opacity-100 scale-100"
            x-transition:leave-end="translate-x-full opacity-0 scale-95"
            class="pointer-events-auto flex items-start gap-3 p-4 rounded-xl shadow-2xl backdrop-blur-md border border-white/20 transition-all duration-300"
            :class="{
                'bg-slate-900/95 text-white border-emerald-500/30 shadow-emerald-950/20': toast.type === 'success',
                'bg-slate-900/95 text-white border-rose-500/30 shadow-rose-950/20': toast.type === 'error',
                'bg-slate-900/95 text-white border-amber-500/30 shadow-amber-950/20': toast.type === 'warning',
                'bg-slate-900/95 text-white border-cyan-500/30 shadow-cyan-950/20': toast.type === 'info'
            }">

            <!-- Icon Column -->
            <div class="flex-shrink-0 mt-0.5">
                <template x-if="toast.type === 'success'">
                    <div class="w-7 h-7 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold text-sm border border-emerald-500/30 animate-pulse">
                        ✓
                    </div>
                </template>
                <template x-if="toast.type === 'error'">
                    <div class="w-7 h-7 rounded-lg bg-rose-500/20 text-rose-400 flex items-center justify-center font-bold text-sm border border-rose-500/30">
                        ✕
                    </div>
                </template>
                <template x-if="toast.type === 'warning'">
                    <div class="w-7 h-7 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold text-sm border border-amber-500/30">
                        ⚠
                    </div>
                </template>
                <template x-if="toast.type === 'info'">
                    <div class="w-7 h-7 rounded-lg bg-cyan-500/20 text-cyan-400 flex items-center justify-center font-bold text-sm border border-cyan-500/30">
                        ℹ
                    </div>
                </template>
            </div>

            <!-- Text Content -->
            <div class="flex-1 min-w-0">
                <p class="text-xs font-black uppercase tracking-wider text-slate-400"
                    x-text="toast.type === 'success' ? 'Success' : (toast.type === 'error' ? 'Notification Error' : 'System Notice')">
                </p>
                <p class="text-xs font-semibold text-slate-100 mt-0.5 leading-relaxed break-words" x-text="toast.message"></p>
            </div>

            <!-- Close Button -->
            <button @click="removeToast(toast.id)"
                class="flex-shrink-0 text-slate-400 hover:text-white p-1 rounded-lg hover:bg-white/10 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </template>
</div>
