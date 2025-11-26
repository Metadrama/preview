<!-- Dataviser-Style Floating Sidebar -->
<aside id="sidebar" class="sidebar-expanded glass border theme-border flex flex-col overflow-hidden fixed left-6 top-20 bottom-6 rounded-2xl z-40 transition-all duration-300 ease-out shadow-2xl" style="width: 280px;">
    <!-- Sidebar Header with Logo -->
    <div class="flex items-center justify-between px-5 py-4 border-b theme-border">
        <div class="flex items-center gap-2 sidebar-text">
            <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-sky-500 to-indigo-600 flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 16a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-3zM14 12a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1v-7z" />
                </svg>
            </div>
            <span class="font-semibold text-sm theme-strong-text">dataviser://</span>
        </div>
        <button onclick="toggleSidebar()" class="p-1.5 rounded-lg transition-all duration-200 theme-icon-button hover:bg-white/5" title="Collapse">
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
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 theme-muted-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input 
                type="text" 
                placeholder="Search data components" 
                id="widget-search"
                class="w-full pl-9 pr-3 py-2 text-xs rounded-lg transition-all duration-200 focus:outline-none focus:ring-1 focus:ring-primary/50 glass border theme-border theme-strong-text"
                style="caret-color: #60a5fa;"
                onkeyup="filterWidgets(this.value)"
            />
        </div>
    </div>

    <!-- Widget Toolbox -->
    <div class="flex-1 overflow-y-auto px-3 py-2">
        <div class="space-y-1" id="widget-toolbox">
            <!-- Expandable Section: Charts -->
            <div class="widget-category">
                <button onclick="toggleSection('charts')" class="flex items-center gap-2 w-full px-2 py-2 text-left rounded-lg transition-colors hover:bg-white/5 sidebar-text">
                    <svg id="chevron-charts" class="w-3 h-3 transition-transform theme-muted-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                    </svg>
                    <span class="text-xs font-semibold uppercase tracking-wider theme-muted-text">Charts & Graphs</span>
                </button>
                <div id="section-charts" class="space-y-0.5 mt-1">
                    <div class="widget-tool" data-widget-type="po-trends-chart" draggable="true">
                        <div class="flex items-center gap-3 px-3 py-2.5 rounded-lg cursor-move transition-all duration-200 border border-transparent hover:border-sky-500/30 hover:bg-sky-500/5 group">
                            <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0 bg-sky-500/10">
                                <svg class="w-4 h-4 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0 sidebar-text">
                                <div class="text-sm font-medium theme-strong-text">PO Trends</div>
                                <div class="text-xs theme-muted-text">12-month timeline</div>
                            </div>
                            <button class="opacity-0 group-hover:opacity-100 p-1 rounded transition-all theme-icon-button" onclick="event.stopPropagation(); showWidgetInfo('po-trends-chart');" title="Info">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="widget-tool" data-widget-type="category-analysis-chart" draggable="true">
                        <div class="flex items-center gap-3 px-3 py-2.5 rounded-lg cursor-move transition-all duration-200 group" style="border: 1px solid transparent;" onmouseenter="this.style.background='rgba(99, 102, 241, 0.05)'; this.style.borderColor='rgba(99, 102, 241, 0.2)';" onmouseleave="this.style.background=''; this.style.borderColor='transparent';">
                            <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0" style="background: rgba(99, 102, 241, 0.1);">
                                <svg class="w-4 h-4" style="color: #6366f1;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0 sidebar-text">
                                <div class="text-sm font-medium" style="color: rgba(255, 255, 255, 0.9);">Category Analysis</div>
                                <div class="text-xs" style="color: rgba(255, 255, 255, 0.4);">Top 10 categories</div>
                            </div>
                            <button class="opacity-0 group-hover:opacity-100 p-1 rounded transition-all" style="color: rgba(255, 255, 255, 0.3);" onclick="event.stopPropagation(); showWidgetInfo('category-analysis-chart');" title="Info">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="widget-tool" data-widget-type="vendor-concentration-chart" draggable="true">
                        <div class="flex items-center gap-3 px-3 py-2.5 rounded-lg cursor-move transition-all duration-200 group" style="border: 1px solid transparent;" onmouseenter="this.style.background='rgba(139, 92, 246, 0.05)'; this.style.borderColor='rgba(139, 92, 246, 0.2)';" onmouseleave="this.style.background=''; this.style.borderColor='transparent';">
                            <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0" style="background: rgba(139, 92, 246, 0.1);">
                                <svg class="w-4 h-4" style="color: #8b5cf6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0 sidebar-text">
                                <div class="text-sm font-medium" style="color: rgba(255, 255, 255, 0.9);">Vendor Distribution</div>
                                <div class="text-xs" style="color: rgba(255, 255, 255, 0.4);">Top 10 vendors</div>
                            </div>
                            <button class="opacity-0 group-hover:opacity-100 p-1 rounded transition-all" style="color: rgba(255, 255, 255, 0.3);" onclick="event.stopPropagation(); showWidgetInfo('vendor-concentration-chart');" title="Info">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Expandable Section: Metrics & KPIs -->
            <div class="widget-category mt-3">
                <button onclick="toggleSection('metrics')" class="flex items-center gap-2 w-full px-2 py-2 text-left rounded-lg transition-colors hover:bg-white/5 sidebar-text">
                    <svg id="chevron-metrics" class="w-3 h-3 transition-transform" style="color: rgba(255, 255, 255, 0.4);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                    </svg>
                    <span class="text-xs font-semibold uppercase tracking-wider" style="color: rgba(255, 255, 255, 0.5);">Metrics & KPIs</span>
                </button>
                <div id="section-metrics" class="space-y-0.5 mt-1">
                    <div class="widget-tool" data-widget-type="kpi-panel" draggable="true">
                        <div class="flex items-center gap-3 px-3 py-2.5 rounded-lg cursor-move transition-all duration-200 group" style="border: 1px solid transparent;" onmouseenter="this.style.background='rgba(34, 197, 94, 0.05)'; this.style.borderColor='rgba(34, 197, 94, 0.2)';" onmouseleave="this.style.background=''; this.style.borderColor='transparent';">
                            <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0" style="background: rgba(34, 197, 94, 0.1);">
                                <svg class="w-4 h-4" style="color: #22c55e;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0 sidebar-text">
                                <div class="text-sm font-medium" style="color: rgba(255, 255, 255, 0.9);">KPI Panel</div>
                                <div class="text-xs" style="color: rgba(255, 255, 255, 0.4);">4 key metrics</div>
                            </div>
                            <button class="opacity-0 group-hover:opacity-100 p-1 rounded transition-all" style="color: rgba(255, 255, 255, 0.3);" onclick="event.stopPropagation(); showWidgetInfo('kpi-panel');" title="Info">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="widget-tool" data-widget-type="live-metric" draggable="true">
                        <div class="flex items-center gap-3 px-3 py-2.5 rounded-lg cursor-move transition-all duration-200 group" style="border: 1px solid transparent;" onmouseenter="this.style.background='rgba(251, 191, 36, 0.05)'; this.style.borderColor='rgba(251, 191, 36, 0.2)';" onmouseleave="this.style.background=''; this.style.borderColor='transparent';">
                            <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0" style="background: rgba(251, 191, 36, 0.1);">
                                <svg class="w-4 h-4" style="color: #fbbf24;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0 sidebar-text">
                                <div class="text-sm font-medium" style="color: rgba(255, 255, 255, 0.9);">Live Metric</div>
                                <div class="text-xs" style="color: rgba(255, 255, 255, 0.4);">Real-time value</div>
                            </div>
                            <button class="opacity-0 group-hover:opacity-100 p-1 rounded transition-all" style="color: rgba(255, 255, 255, 0.3);" onclick="event.stopPropagation(); showWidgetInfo('live-metric');" title="Info">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="widget-tool" data-widget-type="status-indicator" draggable="true">
                        <div class="flex items-center gap-3 px-3 py-2.5 rounded-lg cursor-move transition-all duration-200 group" style="border: 1px solid transparent;" onmouseenter="this.style.background='rgba(244, 63, 94, 0.05)'; this.style.borderColor='rgba(244, 63, 94, 0.2)';" onmouseleave="this.style.background=''; this.style.borderColor='transparent';">
                            <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0" style="background: rgba(244, 63, 94, 0.1);">
                                <svg class="w-4 h-4" style="color: #f43f5e;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0 sidebar-text">
                                <div class="text-sm font-medium" style="color: rgba(255, 255, 255, 0.9);">Status</div>
                                <div class="text-xs" style="color: rgba(255, 255, 255, 0.4);">System status</div>
                            </div>
                            <button class="opacity-0 group-hover:opacity-100 p-1 rounded transition-all" style="color: rgba(255, 255, 255, 0.3);" onclick="event.stopPropagation(); showWidgetInfo('status-indicator');" title="Info">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Collapsed Icon Bar -->
    <div class="sidebar-icons hidden flex-col gap-3 p-3">
        <button onclick="toggleSidebar()" class="p-2.5 rounded-lg transition-all" style="color: rgba(255, 255, 255, 0.4); background: rgba(255, 255, 255, 0.03);" title="Expand">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7" rx="1" opacity="0.4"/>
                <rect x="14" y="3" width="7" height="7" rx="1" opacity="0.4"/>
                <rect x="3" y="14" width="7" height="7" rx="1" opacity="0.4"/>
                <rect x="14" y="14" width="7" height="7" rx="1" opacity="0.4"/>
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
            sidebar.style.width = '280px';
            sidebar.classList.remove('sidebar-collapsed');
            sidebar.classList.add('sidebar-expanded');
            sidebar.querySelectorAll('.sidebar-text').forEach(el => el.classList.remove('hidden'));
            sidebar.querySelectorAll('.sidebar-icons').forEach(el => el.classList.add('hidden'));
            collapseIcon.innerHTML = '<rect x="3" y="3" width="7" height="7" rx="1" opacity="0.4"/><rect x="14" y="3" width="7" height="7" rx="1" opacity="0.4"/><rect x="3" y="14" width="7" height="7" rx="1" opacity="0.4"/><rect x="14" y="14" width="7" height="7" rx="1" opacity="0.4"/>';
        } else {
            sidebar.style.width = '60px';
            sidebar.classList.remove('sidebar-expanded');
            sidebar.classList.add('sidebar-collapsed');
            sidebar.querySelectorAll('.sidebar-text').forEach(el => el.classList.add('hidden'));
            sidebar.querySelectorAll('.sidebar-icons').forEach(el => el.classList.remove('hidden'));
            collapseIcon.innerHTML = '<path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>';
        }

        // Dispatch event for canvas to adjust
        window.dispatchEvent(new CustomEvent('sidebar-toggle', { 
            detail: { expanded: sidebarExpanded } 
        }));
    }

    // Collapsible sections
    function toggleSection(sectionId) {
        const section = document.getElementById(`section-${sectionId}`);
        const chevron = document.getElementById(`chevron-${sectionId}`);
        
        if (section.style.display === 'none') {
            section.style.display = 'block';
            chevron.style.transform = 'rotate(0deg)';
        } else {
            section.style.display = 'none';
            chevron.style.transform = 'rotate(-90deg)';
        }
    }

    // Widget search filter
    function filterWidgets(searchTerm) {
        const widgets = document.querySelectorAll('.widget-tool');
        const term = searchTerm.toLowerCase();
        
        widgets.forEach(widget => {
            const text = widget.textContent.toLowerCase();
            widget.style.display = text.includes(term) ? 'block' : 'none';
        });
    }

    // Show widget info (placeholder)
    function showWidgetInfo(widgetType) {
        alert(`Widget Info: ${widgetType}\n\nThis feature will show detailed information about the widget, including:\n• Description\n• Data sources\n• Configuration options\n• Usage examples`);
    }
</script>
