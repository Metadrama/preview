<!-- Modern Glassmorphic Sidebar -->
<aside id="sidebar" class="sidebar-expanded glass border theme-border flex flex-col transition-collapse overflow-hidden shadow-refined-lg fixed left-6 top-20 bottom-24 rounded-2xl z-40">
    <!-- Sidebar Header -->
    <div class="flex items-center justify-between p-4 border-b theme-border">
        <span class="font-semibold text-base theme-strong-text sidebar-text">Widgets</span>
        <button onclick="toggleSidebar()" class="theme-icon-button p-1.5 rounded-lg transition-smooth" title="Collapse">
            <svg id="collapse-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
            </svg>
        </button>
    </div>

    <!-- Widget Toolbox -->
    <div class="flex-1 overflow-y-auto p-3">
        <div class="space-y-3" id="widget-toolbox">
            <!-- Charts Category -->
            <div class="widget-category">
                <div class="text-xs font-bold theme-muted-text uppercase tracking-wider mb-3 sidebar-text px-2">Charts</div>
                
                <div class="widget-tool" data-widget-type="line-chart" draggable="true">
                    <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-white/5 cursor-move transition-smooth border border-transparent hover:border-primary/30 group">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-sky-500/20 to-sky-600/10 flex items-center justify-center flex-shrink-0 group-hover:from-sky-500/30 group-hover:to-sky-600/20 transition-smooth">
                            <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                            </svg>
                        </div>
                        <div class="sidebar-text">
                            <div class="text-sm font-medium theme-strong-text">Line Chart</div>
                            <div class="text-xs theme-muted-text">Time series data</div>
                        </div>
                    </div>
                </div>

                <div class="widget-tool" data-widget-type="bar-chart" draggable="true">
                    <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-white/5 cursor-move transition-smooth border border-transparent hover:border-primary/30 group">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-500/20 to-indigo-600/10 flex items-center justify-center flex-shrink-0 group-hover:from-indigo-500/30 group-hover:to-indigo-600/20 transition-smooth">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div class="sidebar-text">
                            <div class="text-sm font-medium theme-strong-text">Bar Chart</div>
                            <div class="text-xs theme-muted-text">Comparative data</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Metrics Category -->
            <div class="widget-category mt-5">
                <div class="text-xs font-bold theme-muted-text uppercase tracking-wider mb-3 sidebar-text px-2">Metrics</div>
                
                <div class="widget-tool" data-widget-type="kpi-card" draggable="true">
                    <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-white/5 cursor-move transition-smooth border border-transparent hover:border-primary/30 group">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-emerald-500/20 to-emerald-600/10 flex items-center justify-center flex-shrink-0 group-hover:from-emerald-500/30 group-hover:to-emerald-600/20 transition-smooth">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <div class="sidebar-text">
                            <div class="text-sm font-medium theme-strong-text">KPI Card</div>
                            <div class="text-xs theme-muted-text">Key metric display</div>
                        </div>
                    </div>
                </div>

                <div class="widget-tool" data-widget-type="live-metric" draggable="true">
                    <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-white/5 cursor-move transition-smooth border border-transparent hover:border-primary/30 group">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-amber-500/20 to-amber-600/10 flex items-center justify-center flex-shrink-0 group-hover:from-amber-500/30 group-hover:to-amber-600/20 transition-smooth">
                            <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div class="sidebar-text">
                            <div class="text-sm font-medium theme-strong-text">Live Metric</div>
                            <div class="text-xs theme-muted-text">Real-time value</div>
                        </div>
                    </div>
                </div>

                <div class="widget-tool" data-widget-type="status-indicator" draggable="true">
                    <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-white/5 cursor-move transition-smooth border border-transparent hover:border-primary/30 group">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-rose-500/20 to-rose-600/10 flex items-center justify-center flex-shrink-0 group-hover:from-rose-500/30 group-hover:to-rose-600/20 transition-smooth">
                            <svg class="w-5 h-5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="sidebar-text">
                            <div class="text-sm font-medium theme-strong-text">Status</div>
                            <div class="text-xs theme-muted-text">System status</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Collapsed Icon Bar -->
    <div class="sidebar-icons hidden flex-col gap-3 p-3">
        <button onclick="toggleSidebar()" class="p-2.5 theme-icon-button rounded-lg transition-smooth" title="Expand">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
</aside>

<script>
    let sidebarExpanded = true;

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const collapseIcon = document.getElementById('collapse-icon');
        sidebarExpanded = !sidebarExpanded;

        if (sidebarExpanded) {
            sidebar.classList.remove('sidebar-collapsed');
            sidebar.classList.add('sidebar-expanded');
            sidebar.querySelectorAll('.sidebar-text').forEach(el => el.classList.remove('hidden'));
            sidebar.querySelectorAll('.sidebar-icons').forEach(el => el.classList.add('hidden'));
            collapseIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />';
        } else {
            sidebar.classList.remove('sidebar-expanded');
            sidebar.classList.add('sidebar-collapsed');
            sidebar.querySelectorAll('.sidebar-text').forEach(el => el.classList.add('hidden'));
            sidebar.querySelectorAll('.sidebar-icons').forEach(el => el.classList.remove('hidden'));
            collapseIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />';
        }
    }
</script>
