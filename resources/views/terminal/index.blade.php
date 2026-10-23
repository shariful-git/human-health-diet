<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-xs font-medium text-slate-500">Developer Tools</span>
                    <span class="text-slate-300">·</span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-slate-100 text-slate-700 border border-slate-200">
                        Console
                    </span>
                </div>
                <h2 class="text-xl font-semibold text-slate-900 tracking-tight">
                    Terminal
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Run Artisan commands and view server logs directly in the browser.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-slate-900 rounded-lg border border-slate-800 shadow-2xs overflow-hidden" 
                 x-data="terminalApp('{{ addslashes($initialCwd) }}')">
                
                <!-- Terminal Header Bar -->
                <div class="bg-slate-800/80 px-4 py-2.5 border-b border-slate-700 flex flex-wrap items-center justify-between gap-3 text-xs">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-slate-600 inline-block"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-slate-600 inline-block"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-slate-600 inline-block"></span>
                        </div>
                        <span class="text-xs font-mono text-slate-300 border-l border-slate-700 pl-3">
                            terminal: <span class="text-emerald-400 font-medium" x-text="cwd"></span>
                        </span>
                    </div>

                    <div class="flex items-center gap-2">
                        <button @click="copyLogs" 
                                type="button"
                                class="px-2.5 py-1 text-xs font-mono text-slate-300 bg-slate-700 hover:bg-slate-600 rounded border border-slate-600 transition flex items-center gap-1">
                            <span x-text="copied ? 'Copied' : 'Copy Output'"></span>
                        </button>
                        <button @click="clearTerminal" 
                                type="button"
                                class="px-2.5 py-1 text-xs font-mono text-slate-300 bg-slate-700 hover:bg-slate-600 rounded border border-slate-600 transition flex items-center gap-1">
                            <span>Clear</span>
                        </button>
                    </div>
                </div>

                <!-- Presets Bar -->
                <div class="bg-slate-800/40 px-4 py-2 border-b border-slate-700/80 flex items-center gap-2 overflow-x-auto text-xs">
                    <span class="text-[11px] font-mono text-slate-400 whitespace-nowrap mr-1">Presets:</span>
                    <button @click="runPreset('php artisan route:list')" type="button" class="px-2 py-0.5 text-xs font-mono bg-slate-800 hover:bg-slate-700 text-slate-200 rounded border border-slate-700 whitespace-nowrap">
                        route:list
                    </button>
                    <button @click="runPreset('php artisan migrate:status')" type="button" class="px-2 py-0.5 text-xs font-mono bg-slate-800 hover:bg-slate-700 text-slate-200 rounded border border-slate-700 whitespace-nowrap">
                        migrate:status
                    </button>
                    <button @click="runPreset('php artisan optimize:clear')" type="button" class="px-2 py-0.5 text-xs font-mono bg-slate-800 hover:bg-slate-700 text-slate-200 rounded border border-slate-700 whitespace-nowrap">
                        optimize:clear
                    </button>
                    <button @click="runPreset('php artisan db:seed --class=DatabaseSeeder')" type="button" class="px-2 py-0.5 text-xs font-mono bg-slate-800 hover:bg-slate-700 text-slate-200 rounded border border-slate-700 whitespace-nowrap">
                        db:seed
                    </button>
                    <button @click="runPreset('composer show')" type="button" class="px-2 py-0.5 text-xs font-mono bg-slate-800 hover:bg-slate-700 text-slate-200 rounded border border-slate-700 whitespace-nowrap">
                        composer show
                    </button>
                </div>

                <!-- Main Terminal Screen -->
                <div x-ref="terminalScreen" 
                     class="bg-slate-950 p-4 font-mono text-xs leading-relaxed text-slate-200 min-h-[420px] max-h-[580px] overflow-y-auto select-text">
                    
                    <!-- Welcome Header -->
                    <div class="text-slate-400 mb-4 pb-3 border-b border-slate-800">
                        <p class="text-emerald-400 font-medium mb-1">Human Health Diet Terminal Console</p>
                        <p class="text-xs text-slate-400">Type any shell or Artisan command below (e.g. <span class="text-amber-300">php artisan list</span>, <span class="text-amber-300">git status</span>).</p>
                    </div>

                    <!-- Output Entries -->
                    <template x-for="(entry, index) in logs" :key="index">
                        <div class="mb-4">
                            <!-- Command Line -->
                            <div class="flex items-center gap-1.5 text-slate-400 mb-1">
                                <span class="text-emerald-400 font-medium">$</span>
                                <span class="text-white font-medium" x-text="entry.command"></span>
                            </div>

                            <!-- Status Badge -->
                            <div class="flex items-center gap-2 text-[10px] mb-1.5 text-slate-400">
                                <span :class="entry.exitCode === 0 ? 'text-emerald-400' : 'text-rose-400'" class="font-medium">
                                    <template x-if="entry.exitCode === 0">
                                        <span>✓ Exit code: 0</span>
                                    </template>
                                    <template x-if="entry.exitCode !== 0">
                                        <span x-text="'✗ Exit code: ' + entry.exitCode"></span>
                                    </template>
                                </span>
                                <span x-show="entry.duration" x-text="'(' + entry.duration + 'ms)'"></span>
                            </div>

                            <!-- Output Body -->
                            <div class="bg-slate-900 rounded p-3 text-slate-300 whitespace-pre-wrap font-mono border border-slate-800/80">
                                <span x-text="entry.output"></span>
                            </div>
                        </div>
                    </template>

                    <!-- Active Loading Indicator -->
                    <div x-show="loading" class="flex items-center gap-2 text-amber-400 my-2">
                        <span class="animate-pulse">Running command...</span>
                    </div>

                    <!-- Input Line Prompt -->
                    <form @submit.prevent="executeCommand" class="mt-2 flex items-center gap-1.5">
                        <span class="text-emerald-400 font-medium">&gt;</span>
                        <input x-ref="cmdInput"
                               x-model="inputCommand"
                               @keydown.arrow-up.prevent="navigateHistory('up')"
                               @keydown.arrow-down.prevent="navigateHistory('down')"
                               :disabled="loading"
                               type="text" 
                               class="w-full bg-transparent border-none text-emerald-300 placeholder-slate-600 focus:outline-none focus:ring-0 font-mono text-xs p-0" 
                               placeholder="Type command and press Enter..." 
                               autofocus />
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('terminalApp', (initialCwd) => ({
                cwd: initialCwd,
                inputCommand: '',
                logs: [],
                history: [],
                historyIndex: -1,
                loading: false,
                copied: false,

                executeCommand() {
                    const cmd = this.inputCommand.trim();
                    if (!cmd) return;

                    this.history.push(cmd);
                    this.historyIndex = this.history.length;

                    if (cmd.toLowerCase() === 'clear' || cmd.toLowerCase() === 'cls') {
                        this.clearTerminal();
                        this.inputCommand = '';
                        return;
                    }

                    this.loading = true;
                    const sentCmd = cmd;
                    this.inputCommand = '';

                    fetch("{{ route('terminal.execute') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            command: sentCmd,
                            cwd: this.cwd
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.loading = false;
                        if (data.clear) {
                            this.clearTerminal();
                            return;
                        }

                        if (data.cwd) {
                            this.cwd = data.cwd;
                        }

                        this.logs.push({
                            command: sentCmd,
                            output: data.output || '(No output)',
                            exitCode: data.exit_code,
                            cwd: this.cwd,
                            duration: data.execution_time
                        });

                        this.scrollToBottom();
                        this.focusInput();
                    })
                    .catch(err => {
                        this.loading = false;
                        this.logs.push({
                            command: sentCmd,
                            output: "Network Error: " + err.message,
                            exitCode: 1,
                            cwd: this.cwd,
                            duration: 0
                        });
                        this.scrollToBottom();
                        this.focusInput();
                    });
                },

                runPreset(cmd) {
                    this.inputCommand = cmd;
                    this.executeCommand();
                },

                navigateHistory(direction) {
                    if (this.history.length === 0) return;

                    if (direction === 'up') {
                        if (this.historyIndex > 0) {
                            this.historyIndex--;
                            this.inputCommand = this.history[this.historyIndex];
                        }
                    } else if (direction === 'down') {
                        if (this.historyIndex < this.history.length - 1) {
                            this.historyIndex++;
                            this.inputCommand = this.history[this.historyIndex];
                        } else {
                            this.historyIndex = this.history.length;
                            this.inputCommand = '';
                        }
                    }
                },

                clearTerminal() {
                    this.logs = [];
                    this.focusInput();
                },

                copyLogs() {
                    let text = this.logs.map(l => `$ ${l.command}\n${l.output}`).join('\n\n');
                    navigator.clipboard.writeText(text).then(() => {
                        this.copied = true;
                        setTimeout(() => this.copied = false, 2000);
                    });
                },

                scrollToBottom() {
                    this.$nextTick(() => {
                        const screen = this.$refs.terminalScreen;
                        if (screen) {
                            screen.scrollTop = screen.scrollHeight;
                        }
                    });
                },

                focusInput() {
                    this.$nextTick(() => {
                        if (this.$refs.cmdInput) {
                            this.$refs.cmdInput.focus();
                        }
                    });
                }
            }));
        });
    </script>
</x-app-layout>
