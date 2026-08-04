<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-bold text-xl text-slate-800 leading-tight flex items-center gap-2">
                    <span class="p-1.5 bg-slate-900 text-emerald-400 rounded-md font-mono text-sm shadow-xs">&gt;_</span>
                    {{ __('Web Terminal') }}
                </h2>
                <p class="text-xs text-slate-500 mt-1">Execute Artisan, Composer, system commands, and shell scripts directly from the browser UI.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-slate-200" 
                 x-data="terminalApp('{{ addslashes($initialCwd) }}')">
                
                <!-- Terminal Header Bar -->
                <div class="bg-slate-900 px-4 py-3 border-b border-slate-800 flex flex-wrap items-center justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-1.5">
                            <span class="w-3 h-3 rounded-full bg-rose-500 inline-block"></span>
                            <span class="w-3 h-3 rounded-full bg-amber-500 inline-block"></span>
                            <span class="w-3 h-3 rounded-full bg-emerald-500 inline-block"></span>
                        </div>
                        <span class="text-xs font-mono text-slate-400 border-l border-slate-700 pl-3">
                            terminal@local: <span class="text-emerald-400 font-semibold" x-text="cwd"></span>
                        </span>
                    </div>

                    <div class="flex items-center gap-2">
                        <button @click="copyLogs" 
                                type="button"
                                class="px-2.5 py-1 text-xs font-medium text-slate-300 bg-slate-800 hover:bg-slate-700 hover:text-white rounded border border-slate-700 transition flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                            <span x-text="copied ? 'Copied!' : 'Copy Log'"></span>
                        </button>
                        <button @click="clearTerminal" 
                                type="button"
                                class="px-2.5 py-1 text-xs font-medium text-slate-300 bg-slate-800 hover:bg-slate-700 hover:text-white rounded border border-slate-700 transition flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Clear
                        </button>
                    </div>
                </div>

                <!-- Presets Bar -->
                <div class="bg-slate-800/80 px-4 py-2.5 border-b border-slate-700 flex items-center gap-2 overflow-x-auto scrollbar-thin">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 whitespace-nowrap mr-1">Presets:</span>
                    <button @click="runPreset('php artisan route:list')" type="button" class="px-2 py-0.5 text-xs font-mono bg-slate-900 hover:bg-emerald-900/60 text-emerald-300 rounded border border-slate-700 hover:border-emerald-500/50 transition whitespace-nowrap">
                        artisan route:list
                    </button>
                    <button @click="runPreset('php artisan migrate:status')" type="button" class="px-2 py-0.5 text-xs font-mono bg-slate-900 hover:bg-emerald-900/60 text-emerald-300 rounded border border-slate-700 hover:border-emerald-500/50 transition whitespace-nowrap">
                        artisan migrate:status
                    </button>
                    <button @click="runPreset('php artisan optimize:clear')" type="button" class="px-2 py-0.5 text-xs font-mono bg-slate-900 hover:bg-emerald-900/60 text-emerald-300 rounded border border-slate-700 hover:border-emerald-500/50 transition whitespace-nowrap">
                        artisan optimize:clear
                    </button>
                    <button @click="runPreset('php artisan db:seed --class=DatabaseSeeder')" type="button" class="px-2 py-0.5 text-xs font-mono bg-slate-900 hover:bg-emerald-900/60 text-emerald-300 rounded border border-slate-700 hover:border-emerald-500/50 transition whitespace-nowrap">
                        artisan db:seed
                    </button>
                    <button @click="runPreset('composer show')" type="button" class="px-2 py-0.5 text-xs font-mono bg-slate-900 hover:bg-cyan-900/60 text-cyan-300 rounded border border-slate-700 hover:border-cyan-500/50 transition whitespace-nowrap">
                        composer show
                    </button>
                    <button @click="runPreset('node -v')" type="button" class="px-2 py-0.5 text-xs font-mono bg-slate-900 hover:bg-cyan-900/60 text-cyan-300 rounded border border-slate-700 hover:border-cyan-500/50 transition whitespace-nowrap">
                        node -v
                    </button>
                    <button @click="runPreset('npm run build')" type="button" class="px-2 py-0.5 text-xs font-mono bg-slate-900 hover:bg-cyan-900/60 text-cyan-300 rounded border border-slate-700 hover:border-cyan-500/50 transition whitespace-nowrap">
                        npm run build
                    </button>
                    <button @click="runPreset('dir')" type="button" class="px-2 py-0.5 text-xs font-mono bg-slate-900 hover:bg-amber-900/60 text-amber-300 rounded border border-slate-700 hover:border-amber-500/50 transition whitespace-nowrap">
                        dir / ls
                    </button>
                </div>

                <!-- Main Terminal Screen -->
                <div x-ref="terminalScreen" 
                     class="bg-slate-950 p-4 font-mono text-xs leading-relaxed text-slate-200 min-h-[480px] max-h-[640px] overflow-y-auto select-text shadow-inner">
                    
                    <!-- Welcome Header -->
                    <div class="text-slate-400 mb-4 pb-3 border-b border-slate-800/80">
                        <p class="text-emerald-400 font-bold mb-1">Human Health & Diet Web Terminal v1.0</p>
                        <p>Type any CLI command below (e.g., <code class="text-amber-300">php artisan route:list</code>, <code class="text-amber-300">cd app</code>, <code class="text-amber-300">git status</code>).</p>
                        <p class="text-slate-500 text-[11px] mt-1">Shortcuts: <kbd class="bg-slate-800 px-1 py-0.5 rounded text-slate-300">↑</kbd> / <kbd class="bg-slate-800 px-1 py-0.5 rounded text-slate-300">↓</kbd> for command history navigation. Type <code class="text-rose-300">clear</code> to wipe screen.</p>
                    </div>

                    <!-- Output Entries -->
                    <template x-for="(entry, index) in logs" :key="index">
                        <div class="mb-4">
                            <!-- Command Prompt Line -->
                            <div class="flex items-center gap-2 text-slate-400 mb-1">
                                <span class="text-emerald-400 font-semibold">guest@localhost</span>:<span class="text-cyan-400" x-text="entry.cwd"></span><span class="text-amber-400 font-bold">$</span>
                                <span class="text-slate-100 font-bold" x-text="entry.command"></span>
                            </div>

                            <!-- Execution Status Badge -->
                            <div class="flex items-center gap-3 text-[11px] mb-1.5">
                                <span :class="entry.exitCode === 0 ? 'bg-emerald-950/80 text-emerald-400 border-emerald-800/60' : 'bg-rose-950/80 text-rose-400 border-rose-800/60'"
                                      class="px-2 py-0.5 rounded border font-semibold flex items-center gap-1">
                                    <template x-if="entry.exitCode === 0">
                                        <span>✓ Exit: 0</span>
                                    </template>
                                    <template x-if="entry.exitCode !== 0">
                                        <span x-text="'✗ Exit: ' + entry.exitCode"></span>
                                    </template>
                                </span>
                                <span x-show="entry.duration" class="text-slate-500" x-text="entry.duration + ' ms'"></span>
                            </div>

                            <!-- Command Raw Output -->
                            <div class="bg-slate-900/90 rounded border border-slate-800 p-3 overflow-x-auto text-slate-200 whitespace-pre-wrap font-mono">
                                <span x-text="entry.output"></span>
                            </div>
                        </div>
                    </template>

                    <!-- Active Loading Indicator -->
                    <div x-show="loading" class="flex items-center gap-2 text-amber-400 my-2">
                        <svg class="animate-spin h-4 w-4 text-amber-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Executing command...</span>
                    </div>

                    <!-- Input Line Prompt -->
                    <form @submit.prevent="executeCommand" class="mt-2 flex items-center gap-2">
                        <span class="text-emerald-400 font-semibold whitespace-nowrap">$</span>
                        <input x-ref="cmdInput"
                               x-model="inputCommand"
                               @keydown.arrow-up.prevent="navigateHistory('up')"
                               @keydown.arrow-down.prevent="navigateHistory('down')"
                               :disabled="loading"
                               type="text" 
                               class="w-full bg-transparent border-none text-slate-100 placeholder-slate-600 focus:outline-none focus:ring-0 font-mono text-xs p-0" 
                               placeholder="Type command here and press Enter..." 
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

                    // Add to command history
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
