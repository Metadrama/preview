<!-- Collapsible Sidebar - VSCode Style -->
<aside id="sidebar" class="sidebar-expanded bg-slate-900 border-r border-slate-800 flex flex-col transition-collapse overflow-hidden">
    <!-- Sidebar Header -->
    <div class="flex items-center justify-between p-3 border-b border-slate-800">
        <span class="font-medium text-sm text-slate-200 sidebar-text">Widgets</span>
        <button onclick="toggleSidebar()" class="text-slate-400 hover:text-slate-200 transition-snappy" title="Collapse">
            <svg id="collapse-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
            </svg>
        </button>
    </div>

    <!-- Widget Toolbox -->
    <div class="flex-1 overflow-y-auto p-2">
        <div class="space-y-2" id="widget-toolbox">
            <!-- Charts Category -->
            <div class="widget-category">
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-2 sidebar-text px-2">Charts</div>
                
                <div class="widget-tool" data-widget-type="line-chart" draggable="true">
                    <div class="flex items-center gap-3 p-2 rounded hover:bg-slate-800 cursor-move transition-snappy">
                        <div class="w-8 h-8 rounded bg-sky-500/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                            </svg>
                        </div>
                        <div class="sidebar-text">
                            <div class="text-sm text-slate-200">Line Chart</div>
                            <div class="text-xs text-slate-500">Time series data</div>
                        </div>
                    </div>
                </div>

                <div class="widget-tool" data-widget-type="bar-chart" draggable="true">
                    <div class="flex items-center gap-3 p-2 rounded hover:bg-slate-800 cursor-move transition-snappy">
                        <div class="w-8 h-8 rounded bg-indigo-500/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div class="sidebar-text">
                            <div class="text-sm text-slate-200">Bar Chart</div>
                            <div class="text-xs text-slate-500">Comparative data</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Metrics Category -->
            <div class="widget-category mt-4">
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-2 sidebar-text px-2">Metrics</div>
                
                <div class="widget-tool" data-widget-type="kpi-card" draggable="true">
                    <div class="flex items-center gap-3 p-2 rounded hover:bg-slate-800 cursor-move transition-snappy">
                        <div class="w-8 h-8 rounded bg-emerald-500/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <div class="sidebar-text">
                            <div class="text-sm text-slate-200">KPI Card</div>
                            <div class="text-xs text-slate-500">Key metric display</div>
                        </div>
                    </div>
                </div>

                <div class="widget-tool" data-widget-type="live-metric" draggable="true">
                    <div class="flex items-center gap-3 p-2 rounded hover:bg-slate-800 cursor-move transition-snappy">
                        <div class="w-8 h-8 rounded bg-amber-500/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div class="sidebar-text">
                            <div class="text-sm text-slate-200">Live Metric</div>
                            <div class="text-xs text-slate-500">Real-time value</div>
                        </div>
                    </div>
                </div>

                <div class="widget-tool" data-widget-type="status-indicator" draggable="true">
                    <div class="flex items-center gap-3 p-2 rounded hover:bg-slate-800 cursor-move transition-snappy">
                        <div class="w-8 h-8 rounded bg-rose-500/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="sidebar-text">
                            <div class="text-sm text-slate-200">Status</div>
                            <div class="text-xs text-slate-500">System status</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Collapsed Icon Bar -->
    <div class="sidebar-icons hidden flex-col gap-2 p-2">
        <button onclick="toggleSidebar()" class="p-2 text-slate-400 hover:text-slate-200 hover:bg-slate-800 rounded transition-snappy" title="Expand">
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
