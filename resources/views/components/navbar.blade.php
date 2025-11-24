<!-- Modern Glassmorphic Navbar -->
<nav class="sticky top-0 z-50 glass-strong border-b theme-border h-14 shadow-refined">
    <div class="h-full flex items-center justify-between px-6">
        <!-- Left: Branding -->
        <div class="flex items-center gap-4">
            <span class="font-semibold text-lg theme-strong-text tracking-tight">wip - preview</span>
        </div>

        <!-- Center: Quick Stats -->
        <div class="flex items-center gap-6 text-sm theme-muted-text">
            <div class="flex items-center gap-2 theme-strong-text">
                <div class="w-2 h-2 bg-emerald-400 rounded-full animate-glow shadow-[0_0_8px_rgba(52,211,153,0.6)]"></div>
                <span class="font-medium">Live</span>
            </div>
            <div class="hidden md:flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span id="current-time">--:--:--</span>
            </div>
        </div>

        <!-- Right: Actions -->
        <div class="flex items-center gap-3">
            <!-- Zoom Controls -->
            <div class="flex items-stretch h-8 glass-light rounded-lg overflow-hidden">
                <button onclick="adjustZoom(-0.1)" class="theme-icon-button transition-smooth px-3 flex items-center justify-center border-r theme-border-soft" title="Zoom Out">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                    </svg>
                </button>
                <span class="text-sm theme-muted-text w-12 flex items-center justify-center font-medium border-r theme-border-soft" id="zoom-level">100%</span>
                <button onclick="adjustZoom(0.1)" class="theme-icon-button transition-smooth px-3 flex items-center justify-center border-r theme-border-soft" title="Zoom In">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </button>
                <button onclick="resetZoom()" class="theme-icon-button transition-smooth px-3 flex items-center justify-center" title="Reset Zoom">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </button>
            </div>

            <!-- Theme Toggle -->
            <button id="theme-toggle" onclick="toggleMode()" class="glass-light theme-icon-button flex items-center gap-2 px-3 py-1.5 rounded-lg transition-smooth" title="Toggle theme mode">
                <span class="flex items-center gap-1">
                    <svg data-icon="sun" class="w-5 h-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v2m0 14v2m9-9h-2M5 12H3m14.95 6.95-1.414-1.414M6.464 6.464 5.05 5.05m12.9 0-1.414 1.414M6.464 17.536 5.05 18.95M12 8a4 4 0 100 8 4 4 0 000-8z" />
                    </svg>
                    <svg data-icon="moon" class="w-5 h-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z" />
                    </svg>
                </span>
            </button>

            <!-- Settings -->
            <button onclick="toggleSettings()" class="p-2 theme-icon-button rounded-lg transition-smooth" title="Settings">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </button>

            <!-- User Profile -->
            <div class="relative">
                <button class="flex items-center gap-2 p-1.5 hover:bg-white/10 rounded-lg transition-smooth">
                    <div class="w-8 h-8 rounded-lg bg-linear-to-br from-primary/80 to-secondary/80 flex items-center justify-center text-sm font-bold text-white shadow-refined">
                        WP
                    </div>
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- Settings Modal -->
<div id="settings-modal" class="fixed inset-0 z-100 hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity opacity-0" id="settings-backdrop" onclick="toggleSettings()"></div>

    <!-- Modal Content -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-2xl transform transition-all scale-95 opacity-0" id="settings-content">
        <div class="glass-strong rounded-2xl border border-(--glass-border) shadow-2xl overflow-hidden flex h-[500px]">
            <!-- Sidebar -->
            <div class="w-48 border-r border-(--divider) bg-(--glass-light-bg) p-4 flex flex-col gap-2">
                <h2 class="text-sm font-semibold theme-muted-text px-3 py-2 uppercase tracking-wider mb-2">Settings</h2>
                <button class="flex items-center gap-3 px-3 py-2 rounded-lg bg-(--glass-highlight) text-(--text-strong) font-medium text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" /></svg>
                    Appearance
                </button>
                <button class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-(--hover-faint) text-(--text-muted) hover:text-(--text-strong) transition-colors text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /></svg>
                    General
                </button>
            </div>

            <!-- Content -->
            <div class="flex-1 flex flex-col">
                <!-- Header -->
                <div class="flex items-center justify-between px-8 py-6 border-b border-(--divider)">
                    <h1 class="text-2xl font-bold theme-strong-text">Appearance</h1>
                    <button onclick="toggleSettings()" class="theme-icon-button p-2 rounded-lg hover:bg-(--hover-faint)">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Scrollable Body -->
                <div class="p-8 space-y-8 overflow-y-auto">
                    <!-- Mode Section -->
                    <div>
                        <h3 class="text-sm font-medium theme-muted-text mb-4">Color Mode</h3>
                        <div class="flex p-1 rounded-xl bg-(--glass-light-bg) border border-(--glass-border) w-fit">
                            <button onclick="setMode('light')" class="mode-option px-4 py-2 rounded-lg text-sm font-medium transition-all flex items-center gap-2" data-mode-value="light">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                Light
                            </button>
                            <button onclick="setMode('dark')" class="mode-option px-4 py-2 rounded-lg text-sm font-medium transition-all flex items-center gap-2" data-mode-value="dark">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                                Dark
                            </button>
                        </div>
                    </div>

                    <!-- Theme Section -->
                    <div>
                        <h3 class="text-sm font-medium theme-muted-text mb-4">Interface Theme</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Default -->
                            <button onclick="setTheme('default')" class="theme-option group relative p-4 rounded-xl border border-(--glass-border) hover:border-(--widget-hover-border) bg-(--bg-base) transition-all text-left" data-theme-value="default">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-base font-medium theme-strong-text">Default</span>
                                    <div class="w-4 h-4 rounded-full bg-blue-500"></div>
                                </div>
                                <p class="text-sm theme-muted-text">The classic deep blue glass aesthetic.</p>
                            </button>

                            <!-- Industrial -->
                            <button onclick="setTheme('industrial')" class="theme-option group relative p-4 rounded-xl border border-(--glass-border) hover:border-(--widget-hover-border) bg-slate-100 dark:bg-slate-900 transition-all text-left" data-theme-value="industrial">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-base font-medium text-slate-900 dark:text-slate-100">Industrial</span>
                                    <div class="w-4 h-4 rounded-full bg-slate-500"></div>
                                </div>
                                <p class="text-sm text-slate-500">Clean, technical, and precise.</p>
                            </button>

                            <!-- Monochrome -->
                            <button onclick="setTheme('monochrome')" class="theme-option group relative p-4 rounded-xl border border-(--glass-border) hover:border-(--widget-hover-border) bg-white dark:bg-black transition-all text-left" data-theme-value="monochrome">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-base font-medium text-black dark:text-white">Monochrome</span>
                                    <div class="w-4 h-4 rounded-full bg-black dark:bg-white border border-gray-200 dark:border-gray-800"></div>
                                </div>
                                <p class="text-sm text-gray-500">High contrast minimalist design.</p>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Update current time
    function updateTime() {
        const now = new Date();
        const timeStr = now.toLocaleTimeString('en-US', {
            hour12: false
        });
        const timeEl = document.getElementById('current-time');
        if (timeEl) timeEl.textContent = timeStr;
    }
    setInterval(updateTime, 1000);
    updateTime();

    // Settings Modal Logic
    function toggleSettings() {
        const modal = document.getElementById('settings-modal');
        const backdrop = document.getElementById('settings-backdrop');
        const content = document.getElementById('settings-content');

        if (modal.classList.contains('hidden')) {
            // Open
            modal.classList.remove('hidden');
            // Small delay for transition
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        } else {
            // Close
            backdrop.classList.add('opacity-0');
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    }

    // Theme Logic
    function setTheme(themeName) {
        const root = document.documentElement;
        root.setAttribute('data-theme', themeName);
        localStorage.setItem('app-theme', themeName);
        updateThemeUI();
    }

    function setMode(modeName) {
        const root = document.documentElement;
        root.setAttribute('data-mode', modeName);
        localStorage.setItem('app-mode', modeName);
        updateThemeUI();
    }

    function toggleMode() {
        const currentMode = localStorage.getItem('app-mode') || 'dark';
        const newMode = currentMode === 'light' ? 'dark' : 'light';
        setMode(newMode);
    }

    function updateThemeUI() {
        const currentTheme = localStorage.getItem('app-theme') || 'default';
        const currentMode = localStorage.getItem('app-mode') || 'dark'; // Default to dark

        // Update Navbar Icons
        const sunIcon = document.querySelector('#theme-toggle [data-icon="sun"]');
        const moonIcon = document.querySelector('#theme-toggle [data-icon="moon"]');
        
        if (sunIcon && moonIcon) {
            if (currentMode === 'dark') {
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
            } else {
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            }
        }

        // Update Theme Selection UI
        document.querySelectorAll('.theme-option').forEach(btn => {
            const themeValue = btn.dataset.themeValue;
            if (themeValue === currentTheme) {
                btn.classList.add('ring-2', 'ring-(--widget-hover-border)', 'bg-(--hover-faint)');
            } else {
                btn.classList.remove('ring-2', 'ring-(--widget-hover-border)', 'bg-(--hover-faint)');
            }
        });

        // Update Mode Selection UI
        document.querySelectorAll('.mode-option').forEach(btn => {
            const modeValue = btn.dataset.modeValue;
            if (modeValue === currentMode) {
                btn.classList.add('bg-white', 'text-black', 'shadow-sm');
                btn.classList.remove('text-(--text-muted)', 'hover:text-(--text-strong)');
            } else {
                btn.classList.remove('bg-white', 'text-black', 'shadow-sm');
                btn.classList.add('text-(--text-muted)', 'hover:text-(--text-strong)');
            }
        });
    }

    // Initialize Theme
    document.addEventListener('DOMContentLoaded', () => {
        const savedTheme = localStorage.getItem('app-theme') || 'default';
        const savedMode = localStorage.getItem('app-mode') || 'dark';
        
        setTheme(savedTheme);
        setMode(savedMode);
    });
</script>
