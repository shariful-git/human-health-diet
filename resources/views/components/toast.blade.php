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
class="fixed top-18 right-5 z-[9999] max-w-sm w-full space-y-2 pointer-events-none">

    <template x-for="toast in toasts" :key="toast.id">
        <div x-show="toast.show"
            x-transition:enter="transition ease-out duration-200 transform"
            x-transition:enter-start="translate-y-2 opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition ease-in duration-150 transform"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="pointer-events-auto flex items-start gap-3 p-3.5 rounded-md shadow-sm border bg-white transition-all text-xs"
            :class="{
                'border-emerald-200 text-slate-800': toast.type === 'success',
                'border-rose-200 text-slate-800': toast.type === 'error',
                'border-amber-200 text-slate-800': toast.type === 'warning',
                'border-slate-200 text-slate-800': toast.type === 'info'
            }">

            <!-- Icon Column -->
            <div class="flex-shrink-0 mt-0.5">
                <template x-if="toast.type === 'success'">
                    <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-xs border border-emerald-200">
                        ✓
                    </span>
                </template>
                <template x-if="toast.type === 'error'">
                    <span class="w-5 h-5 rounded-full bg-rose-50 text-rose-700 flex items-center justify-center font-bold text-xs border border-rose-200">
                        ✕
                    </span>
                </template>
                <template x-if="toast.type === 'warning'">
                    <span class="w-5 h-5 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-xs border border-amber-200">
                        !
                    </span>
                </template>
                <template x-if="toast.type === 'info'">
                    <span class="w-5 h-5 rounded-full bg-slate-100 text-slate-700 flex items-center justify-center font-bold text-xs border border-slate-200">
                        i
                    </span>
                </template>
            </div>

            <!-- Text Content -->
            <div class="flex-1 min-w-0">
                <p class="font-medium text-slate-900 leading-snug break-words" x-text="toast.message"></p>
            </div>

            <!-- Close Button -->
            <button @click="removeToast(toast.id)"
                class="flex-shrink-0 text-slate-400 hover:text-slate-600 p-0.5 rounded transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </template>
</div>
