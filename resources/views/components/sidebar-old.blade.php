<!-- Dataviser-Style Floating Sidebar -->
<aside id="sidebar" class="sidebar-expanded flex flex-col overflow-hidden fixed left-6 top-20 bottom-6 rounded-2xl z-40 transition-all duration-300 ease-out" style="width: 280px; background: rgba(255, 255, 255, 0.02); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.08); box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5), 0 0 1px rgba(255, 255, 255, 0.1) inset;">
    <!-- Sidebar Header with Logo -->
    <div class="flex items-center justify-between px-5 py-4 border-b" style="border-color: rgba(255, 255, 255, 0.06);">
        <div class="flex items-center gap-2 sidebar-text">
            <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-sky-500 to-indigo-600 flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 16a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-3zM14 12a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1v-7z" />
                </svg>
            </div>
            <span class="font-semibold text-sm" style="color: rgba(255, 255, 255, 0.9);">dataviser://</span>
        </div>
        <button onclick="toggleSidebar()" class="p-1.5 rounded-lg transition-all duration-200 hover:bg-white/5" title="Collapse" style="color: rgba(255, 255, 255, 0.4);">
            <svg id="collapse-icon" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7" rx="1" opacity="0.4"/>
                <rect x="14" y="3" width="7" height="7" rx="1" opacity="0.4"/>
                <rect x="3" y="14" width="7" height="7" rx="1" opacity="0.4"/>
                <rect x="14" y="14" width="7" height="7" rx="1" opacity="0.4"/>
            </svg>
        </button>
    </div>

    <!-- Search Bar -->
    <div class="px-4 pt-3 pb-2 sidebar-text">
        <div class="relative">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4" style="color: rgba(255, 255, 255, 0.3);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input 
                type="text" 
                placeholder="Search data components" 
                id="widget-search"
                class="w-full pl-9 pr-3 py-2 text-xs rounded-lg transition-all duration-200 focus:outline-none focus:ring-1"
                style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.06); color: rgba(255, 255, 255, 0.7); caret-color: #60a5fa;"
                onkeyup="filterWidgets(this.value)"
            />
        </div>
    </div>

    <!-- Widget Toolbox -->
    <div class="flex-1 overflow-y-auto px-3 py-2" style="scrollbar-width: thin; scrollbar-color: rgba(255,255,255,0.1) transparent;">
        <div class="space-y-1" id="widget-toolbox">
            <!-- Expandable Section: Charts -->
            <div class="widget-category">
                <button onclick="toggleSection('charts')" class="flex items-center gap-2 w-full px-2 py-2 text-left rounded-lg transition-colors hover:bg-white/5 sidebar-text">
                    <svg id="chevron-charts" class="w-3 h-3 transition-transform" style="color: rgba(255, 255, 255, 0.4);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                    </svg>
                    <span class="text-xs font-semibold uppercase tracking-wider" style="color: rgba(255, 255, 255, 0.5);">Charts & Graphs</span>
                </button>
                <div id="section-charts" class="space-y-0.5 mt-1">
                    <div class="widget-tool" data-widget-type="po-trends-chart" draggable="true">
                        <div class="flex items-center gap-3 px-3 py-2.5 rounded-lg cursor-move transition-all duration-200 group" style="border: 1px solid transparent;" onmouseenter="this.style.background='rgba(56, 189, 248, 0.05)'; this.style.borderColor='rgba(56, 189, 248, 0.2)';" onmouseleave="this.style.background=''; this.style.borderColor='transparent';">
                            <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0" style="background: rgba(56, 189, 248, 0.1);">
                                <svg class="w-4 h-4" style="color: #38bdf8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0 sidebar-text">
                                <div class="text-sm font-medium" style="color: rgba(255, 255, 255, 0.9);">PO Trends</div>
                                <div class="text-xs" style="color: rgba(255, 255, 255, 0.4);">12-month timeline</div>
                            </div>
                            <button class="opacity-0 group-hover:opacity-100 p-1 rounded transition-all" style="color: rgba(255, 255, 255, 0.3);" onclick="event.stopPropagation(); showWidgetInfo('po-trends-chart');" title="Info">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                <div class="widget-tool" data-widget-type="category-analysis-chart" draggable="true">
                    <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-white/5 cursor-move transition-smooth border border-transparent hover:border-primary/30 group">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-500/20 to-indigo-600/10 flex items-center justify-center flex-shrink-0 group-hover:from-indigo-500/30 group-hover:to-indigo-600/20 transition-smooth">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div class="sidebar-text">
                            <div class="text-sm font-medium theme-strong-text">Category Analysis</div>
                            <div class="text-xs theme-muted-text">Top 10 categories</div>
                        </div>
                    </div>
                </div>

                <div class="widget-tool" data-widget-type="vendor-concentration-chart" draggable="true">
                    <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-white/5 cursor-move transition-smooth border border-transparent hover:border-primary/30 group">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-violet-500/20 to-violet-600/10 flex items-center justify-center flex-shrink-0 group-hover:from-violet-500/30 group-hover:to-violet-600/20 transition-smooth">
                            <svg class="w-5 h-5 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                            </svg>
                        </div>
                        <div class="sidebar-text">
                            <div class="text-sm font-medium theme-strong-text">Vendor Distribution</div>
                            <div class="text-xs theme-muted-text">Top 10 vendors</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Metrics Category -->
            <div class="widget-category mt-5">
                <div class="text-xs font-bold theme-muted-text uppercase tracking-wider mb-3 sidebar-text px-2">Metrics</div>
                
                <div class="widget-tool" data-widget-type="kpi-panel" draggable="true">
                    <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-white/5 cursor-move transition-smooth border border-transparent hover:border-primary/30 group">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-emerald-500/20 to-emerald-600/10 flex items-center justify-center flex-shrink-0 group-hover:from-emerald-500/30 group-hover:to-emerald-600/20 transition-smooth">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div class="sidebar-text">
                            <div class="text-sm font-medium theme-strong-text">KPI Panel</div>
                            <div class="text-xs theme-muted-text">4 key metrics</div>
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

        // Dispatch event for canvas to adjust
        window.dispatchEvent(new CustomEvent('sidebar-toggle', { 
            detail: { expanded: sidebarExpanded } 
        }));
    }
</script>
