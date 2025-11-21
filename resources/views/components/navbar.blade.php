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
            <button id="theme-toggle" class="glass-light theme-icon-button flex items-center gap-2 px-3 py-1.5 rounded-lg transition-smooth" title="Toggle theme mode">
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
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md transform transition-all scale-95 opacity-0" id="settings-content">
        <div class="glass-strong rounded-2xl border border-(--glass-border) shadow-2xl overflow-hidden">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-(--divider)">
                <h2 class="text-lg font-semibold theme-strong-text">Settings</h2>
                <button onclick="toggleSettings()" class="theme-icon-button p-2 rounded-lg hover:bg-(--hover-faint)">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Body -->
            <div class="p-6 space-y-6">
                <!-- Theme Section -->
                <div>
                    <h3 class="text-sm font-medium theme-muted-text mb-3 uppercase tracking-wider">Appearance</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <button onclick="setTheme('default')" class="theme-option group relative p-3 rounded-xl border border-(--glass-border) hover:border-(--widget-hover-border) bg-(--bg-base) transition-all text-left" data-theme-value="default">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-4 h-4 rounded-full bg-slate-900 border border-slate-700"></div>
                                <span class="text-sm font-medium theme-strong-text">Default</span>
                            </div>
                            <p class="text-xs theme-muted-text">Deep blue & glass</p>
                        </button>

                        <button onclick="setTheme('industrial-light')" class="theme-option group relative p-3 rounded-xl border border-(--glass-border) hover:border-(--widget-hover-border) bg-[#f8fafc] transition-all text-left" data-theme-value="industrial-light">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-4 h-4 rounded-full bg-slate-100 border border-slate-300"></div>
                                <span class="text-sm font-medium text-slate-900">Industrial</span>
                            </div>
                            <p class="text-xs text-slate-500">Clean & technical</p>
                        </button>

                        <button onclick="setTheme('monochrome-light')" class="theme-option group relative p-3 rounded-xl border border-(--glass-border) hover:border-(--widget-hover-border) bg-white transition-all text-left" data-theme-value="monochrome-light">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-4 h-4 rounded-full bg-white border border-gray-300"></div>
                                <span class="text-sm font-medium text-black">Mono Light</span>
                            </div>
                            <p class="text-xs text-gray-500">Minimalist white</p>
                        </button>

                        <button onclick="setTheme('monochrome-dark')" class="theme-option group relative p-3 rounded-xl border border-(--glass-border) hover:border-(--widget-hover-border) bg-black transition-all text-left" data-theme-value="monochrome-dark">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-4 h-4 rounded-full bg-black border border-gray-700"></div>
                                <span class="text-sm font-medium text-white">Mono Dark</span>
                            </div>
                            <p class="text-xs text-gray-500">Minimalist black</p>
                        </button>
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
        
        if (themeName === 'default') {
            root.removeAttribute('data-theme');
        } else {
            root.setAttribute('data-theme', themeName);
        }

        // Save to local storage
        localStorage.setItem('app-theme', themeName);

        // Update UI active state
        updateThemeUI(themeName);
    }

    function updateThemeUI(activeTheme) {
        document.querySelectorAll('.theme-option').forEach(btn => {
            const themeValue = btn.dataset.themeValue;
            if (themeValue === activeTheme) {
                btn.classList.add('ring-2', 'ring-(--widget-hover-border)', 'bg-(--hover-faint)');
            } else {
                btn.classList.remove('ring-2', 'ring-(--widget-hover-border)', 'bg-(--hover-faint)');
            }
        });
    }

    // Initialize Theme
    document.addEventListener('DOMContentLoaded', () => {
        const savedTheme = localStorage.getItem('app-theme') || 'default';
        setTheme(savedTheme);
    });
</script>
