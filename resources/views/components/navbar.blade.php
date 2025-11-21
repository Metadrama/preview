<!-- Main Top Navbar - Monochromatic Design -->
<nav class="sticky top-0 z-50 bg-black/95 backdrop-blur-sm border-b border-neutral-800 h-12">
    <div class="h-full flex items-center justify-between px-4">
        <!-- Left: Branding -->
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-2">
                <span class="font-semibold text-white">wip - preview</span>
            </div>
        </div>

        <!-- Center: Quick Stats -->
        <div class="flex items-center gap-4 text-xs text-neutral-500">
            <div class="flex items-center gap-1.5">
                <div class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></div>
                <span>Live</span>
            </div>
            <div class="hidden md:block">
                <span id="current-time">--:--:--</span>
            </div>
        </div>

        <!-- Right: Actions -->
        <div class="flex items-center gap-2">
            <!-- Zoom Controls -->
            <div class="flex items-center gap-1 bg-neutral-900 rounded px-2 py-1 border border-neutral-800">
                <button onclick="adjustZoom(-0.1)" class="text-neutral-500 hover:text-white transition-snappy" title="Zoom Out">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                    </svg>
                </button>
                <span class="text-xs text-neutral-500 w-12 text-center" id="zoom-level">100%</span>
                <button onclick="adjustZoom(0.1)" class="text-neutral-500 hover:text-white transition-snappy" title="Zoom In">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </button>
                <button onclick="resetZoom()" class="text-neutral-500 hover:text-white transition-snappy ml-1" title="Reset Zoom">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </button>
            </div>

            <!-- Settings -->
            <button class="p-1.5 text-neutral-500 hover:text-white hover:bg-neutral-900 rounded transition-snappy" title="Settings">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </button>

            <!-- User Profile -->
            <div class="relative">
                <button class="flex items-center gap-2 p-1 hover:bg-neutral-900 rounded transition-snappy">
                    <div class="w-7 h-7 rounded-full bg-gradient-to-br from-neutral-700 to-neutral-900 flex items-center justify-center text-xs font-semibold text-white border border-neutral-700">
                        BM
                    </div>
                </button>
            </div>
        </div>
    </div>
</nav>

<script>
    // Update current time
    function updateTime() {
        const now = new Date();
        const timeStr = now.toLocaleTimeString('en-US', { hour12: false });
        const timeEl = document.getElementById('current-time');
        if (timeEl) timeEl.textContent = timeStr;
    }
    setInterval(updateTime, 1000);
    updateTime();
</script>
