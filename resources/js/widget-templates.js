// Widget Templates for Monitoring Dashboard
export const widgetTemplates = {
    'kpi-card': {
        title: 'KPI Card',
        width: 3,
        height: 2,
        render: (id) => `
            <div class="widget-card h-full">
                <div class="widget-header">
                    <h3 class="text-sm font-medium text-slate-200">Total Revenue</h3>
                    <button onclick="removeWidget('${id}')" class="text-slate-500 hover:text-red-400 transition-snappy">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-6 flex flex-col justify-center h-full">
                    <div class="text-4xl font-bold text-sky-400 mb-2">RM 245.8K</div>
                    <div class="flex items-center gap-2 text-sm">
                        <span class="text-emerald-400 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            12.5%
                        </span>
                        <span class="text-slate-500">vs last month</span>
                    </div>
                </div>
            </div>
        `
    },

    'line-chart': {
        title: 'Line Chart',
        width: 6,
        height: 4,
        render: (id) => `
            <div class="widget-card h-full">
                <div class="widget-header">
                    <h3 class="text-sm font-medium text-slate-200">Performance Trend</h3>
                    <button onclick="removeWidget('${id}')" class="text-slate-500 hover:text-red-400 transition-snappy">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-4 h-full flex items-center justify-center">
                    <svg class="w-full h-full max-h-48" viewBox="0 0 400 200">
                        <defs>
                            <linearGradient id="grad-${id}" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" style="stop-color:rgb(14,165,233);stop-opacity:0.3" />
                                <stop offset="100%" style="stop-color:rgb(14,165,233);stop-opacity:0" />
                            </linearGradient>
                        </defs>
                        <polyline fill="url(#grad-${id})" points="0,180 50,150 100,130 150,140 200,90 250,100 300,60 350,80 400,40 400,200 0,200" />
                        <polyline fill="none" stroke="rgb(14,165,233)" stroke-width="2" points="0,180 50,150 100,130 150,140 200,90 250,100 300,60 350,80 400,40" />
                    </svg>
                </div>
            </div>
        `
    },

    'bar-chart': {
        title: 'Bar Chart',
        width: 6,
        height: 4,
        render: (id) => `
            <div class="widget-card h-full">
                <div class="widget-header">
                    <h3 class="text-sm font-medium text-slate-200">Monthly Comparison</h3>
                    <button onclick="removeWidget('${id}')" class="text-slate-500 hover:text-red-400 transition-snappy">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-4 h-full flex items-end justify-around gap-2">
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-indigo-500/30 rounded-t" style="height: 60%"></div>
                        <span class="text-xs text-slate-500 mt-2">Jan</span>
                    </div>
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-indigo-500/30 rounded-t" style="height: 75%"></div>
                        <span class="text-xs text-slate-500 mt-2">Feb</span>
                    </div>
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-indigo-500/30 rounded-t" style="height: 90%"></div>
                        <span class="text-xs text-slate-500 mt-2">Mar</span>
                    </div>
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-indigo-500 rounded-t" style="height: 100%"></div>
                        <span class="text-xs text-slate-400 mt-2 font-medium">Apr</span>
                    </div>
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-indigo-500/30 rounded-t" style="height: 45%"></div>
                        <span class="text-xs text-slate-500 mt-2">May</span>
                    </div>
                </div>
            </div>
        `
    },

    'live-metric': {
        title: 'Live Metric',
        width: 3,
        height: 2,
        render: (id) => `
            <div class="widget-card h-full">
                <div class="widget-header">
                    <h3 class="text-sm font-medium text-slate-200">Active Users</h3>
                    <button onclick="removeWidget('${id}')" class="text-slate-500 hover:text-red-400 transition-snappy">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-6 flex flex-col justify-center h-full">
                    <div class="flex items-baseline gap-2 mb-2">
                        <div class="text-4xl font-bold text-amber-400" id="live-value-${id}">1,247</div>
                        <div class="w-2 h-2 bg-amber-400 rounded-full animate-pulse-glow"></div>
                    </div>
                    <div class="text-sm text-slate-500">Real-time</div>
                </div>
            </div>
        `
    },

    'status-indicator': {
        title: 'Status',
        width: 3,
        height: 2,
        render: (id) => `
            <div class="widget-card h-full">
                <div class="widget-header">
                    <h3 class="text-sm font-medium text-slate-200">System Status</h3>
                    <button onclick="removeWidget('${id}')" class="text-slate-500 hover:text-red-400 transition-snappy">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-4 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-400">API Server</span>
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                            <span class="text-xs text-emerald-400">Online</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-400">Database</span>
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                            <span class="text-xs text-emerald-400">Online</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-400">Cache</span>
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></div>
                            <span class="text-xs text-amber-400">Warning</span>
                        </div>
                    </div>
                </div>
            </div>
        `
    }
};

// Simulate live updates for demo
setInterval(() => {
    document.querySelectorAll('[id^="live-value-"]').forEach(el => {
        const currentValue = parseInt(el.textContent.replace(/,/g, ''));
        const newValue = currentValue + Math.floor(Math.random() * 20) - 10;
        el.textContent = newValue.toLocaleString();
    });
}, 3000);
