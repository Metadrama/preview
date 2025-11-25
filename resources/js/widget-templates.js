// Widget Templates for Monitoring Dashboard
import Chart from 'chart.js/auto';

// Chart.js default configuration for DaisyUI theme
Chart.defaults.color = 'rgb(148, 163, 184)'; // slate-400
Chart.defaults.borderColor = 'rgb(51, 65, 85)'; // slate-700
Chart.defaults.font.family = 'ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto';

// Data fetching utility
const fetchDashboardData = async () => {
    try {
        const response = await fetch('/api/dashboard/purchase-orders');
        if (!response.ok) throw new Error('Failed to fetch data');
        return await response.json();
    } catch (error) {
        console.error('Dashboard data fetch error:', error);
        return { success: false, data: [], count: 0 };
    }
};

// Data transformation utilities
const transformers = {
    calculateTotalPOValue: (data) => {
        return data.reduce((sum, po) => {
            const amount = parseFloat((po['Total Amount in MYR'] || '0').replace(/,/g, ''));
            return sum + (isNaN(amount) ? 0 : amount);
        }, 0);
    },
    
    calculateOutstandingAmount: (data) => {
        return data
            .filter(po => po['PO Status'] !== 'Closed' && po['PO Status'] !== 'Cancelled')
            .reduce((sum, po) => {
                const amount = parseFloat((po['Total Amount in MYR'] || '0').replace(/,/g, ''));
                return sum + (isNaN(amount) ? 0 : amount);
            }, 0);
    },
    
    countActiveVendors: (data) => {
        const vendors = new Set(data
            .filter(po => po['PO Status'] !== 'Closed' && po['PO Status'] !== 'Cancelled')
            .map(po => po['Vendor Name'])
            .filter(Boolean));
        return vendors.size;
    },
    
    groupByCategory: (data) => {
        const groups = {};
        data.forEach(po => {
            // Use Document Class Description as fallback when Category is empty
            const category = po['Category'] || po['Document Class Description'] || 'Uncategorized';
            const amount = parseFloat((po['Total Amount in MYR'] || '0').toString().replace(/,/g, ''));
            if (!groups[category]) groups[category] = 0;
            groups[category] += isNaN(amount) ? 0 : amount;
        });
        return groups;
    },
    
    groupByMonth: (data) => {
        const groups = {};
        data.forEach(po => {
            const date = po['Purchase Order Date'];
            if (!date) return;
            const month = new Date(date).toLocaleString('default', { month: 'short', year: 'numeric' });
            const amount = parseFloat((po['Total Amount in MYR'] || '0').replace(/,/g, ''));
            if (!groups[month]) groups[month] = 0;
            groups[month] += isNaN(amount) ? 0 : amount;
        });
        return groups;
    }
};

// Format currency
const formatCurrency = (value) => {
    if (value >= 1000000) return `RM ${(value / 1000000).toFixed(1)}M`;
    if (value >= 1000) return `RM ${(value / 1000).toFixed(1)}K`;
    return `RM ${value.toFixed(0)}`;
};

export const widgetTemplates = {
    'kpi-panel': {
        title: 'KPI Panel - Dashboard Metrics',
        width: 80,
        height: 8,
        render: (id) => {
            const html = `
                <div class="widget-card h-full group relative">
                    <button onclick="removeWidget('${id}')" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 text-slate-500 hover:text-red-400 transition-snappy z-10 p-1 rounded hover:bg-white/5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <div class="p-4 h-full">
                        <div class="text-xs font-medium text-slate-400 mb-3 uppercase tracking-wider">Key Performance Indicators</div>
                        <div class="grid grid-cols-4 gap-4 h-[calc(100%-2rem)]">
                            <!-- Total PO Value -->
                            <div class="glass rounded-lg p-4 flex flex-col justify-between">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="text-xs font-medium text-slate-400 uppercase tracking-wider">Total PO Value</div>
                                    <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1 flex flex-col justify-center">
                                    <div class="text-3xl font-bold text-white mb-1" id="kpi-total-${id}">
                                        <span class="text-lg text-slate-500">Loading...</span>
                                    </div>
                                    <div class="text-xs text-slate-500" id="kpi-total-change-${id}">Calculating...</div>
                                </div>
                            </div>
                            
                            <!-- Outstanding Amount -->
                            <div class="glass rounded-lg p-4 flex flex-col justify-between">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="text-xs font-medium text-slate-400 uppercase tracking-wider">Outstanding</div>
                                    <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1 flex flex-col justify-center">
                                    <div class="text-3xl font-bold text-white mb-1" id="kpi-outstanding-${id}">
                                        <span class="text-lg text-slate-500">Loading...</span>
                                    </div>
                                    <div class="text-xs text-slate-500" id="kpi-outstanding-change-${id}">Calculating...</div>
                                </div>
                            </div>
                            
                            <!-- Active Vendors -->
                            <div class="glass rounded-lg p-4 flex flex-col justify-between">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="text-xs font-medium text-slate-400 uppercase tracking-wider">Active Vendors</div>
                                    <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1 flex flex-col justify-center">
                                    <div class="text-3xl font-bold text-white mb-1" id="kpi-vendors-${id}">
                                        <span class="text-lg text-slate-500">Loading...</span>
                                    </div>
                                    <div class="text-xs text-slate-500" id="kpi-vendors-change-${id}">Calculating...</div>
                                </div>
                            </div>
                            
                            <!-- Total PO Count -->
                            <div class="glass rounded-lg p-4 flex flex-col justify-between">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="text-xs font-medium text-slate-400 uppercase tracking-wider">Total POs</div>
                                    <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div class="flex-1 flex flex-col justify-center">
                                    <div class="text-3xl font-bold text-white mb-1" id="kpi-count-${id}">
                                        <span class="text-lg text-slate-500">Loading...</span>
                                    </div>
                                    <div class="text-xs text-slate-500" id="kpi-count-change-${id}">Calculating...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // Fetch data and update all KPIs
            setTimeout(async () => {
                const result = await fetchDashboardData();
                if (result.success && result.data.length > 0) {
                    const data = result.data;
                    
                    // Calculate all metrics
                    const totalValue = transformers.calculateTotalPOValue(data);
                    const outstandingValue = transformers.calculateOutstandingAmount(data);
                    const activeVendors = transformers.countActiveVendors(data);
                    const totalCount = data.length;
                    
                    // Update Total PO Value
                    const totalEl = document.getElementById(`kpi-total-${id}`);
                    const totalChangeEl = document.getElementById(`kpi-total-change-${id}`);
                    if (totalEl) totalEl.textContent = formatCurrency(totalValue);
                    if (totalChangeEl) {
                        const percentage = ((totalValue / (totalValue + outstandingValue)) * 100).toFixed(1);
                        totalChangeEl.innerHTML = `<span class="text-emerald-400">${percentage}% completed</span>`;
                    }
                    
                    // Update Outstanding Amount
                    const outstandingEl = document.getElementById(`kpi-outstanding-${id}`);
                    const outstandingChangeEl = document.getElementById(`kpi-outstanding-change-${id}`);
                    if (outstandingEl) outstandingEl.textContent = formatCurrency(outstandingValue);
                    if (outstandingChangeEl) {
                        const percentage = ((outstandingValue / totalValue) * 100).toFixed(1);
                        outstandingChangeEl.innerHTML = `<span class="text-amber-400">${percentage}% pending</span>`;
                    }
                    
                    // Update Active Vendors
                    const vendorsEl = document.getElementById(`kpi-vendors-${id}`);
                    const vendorsChangeEl = document.getElementById(`kpi-vendors-change-${id}`);
                    if (vendorsEl) vendorsEl.textContent = activeVendors.toLocaleString();
                    if (vendorsChangeEl) {
                        const avgPerVendor = (totalValue / activeVendors);
                        vendorsChangeEl.innerHTML = `<span class="text-emerald-400">${formatCurrency(avgPerVendor)}/vendor</span>`;
                    }
                    
                    // Update Total PO Count
                    const countEl = document.getElementById(`kpi-count-${id}`);
                    const countChangeEl = document.getElementById(`kpi-count-change-${id}`);
                    if (countEl) countEl.textContent = totalCount.toLocaleString();
                    if (countChangeEl) {
                        const avgValue = totalValue / totalCount;
                        countChangeEl.innerHTML = `<span class="text-indigo-400">${formatCurrency(avgValue)}/PO avg</span>`;
                    }
                }
            }, 100);
            
            return html;
        }
    },

    'po-trends-chart': {
        title: 'PO Value Trends',
        width: 80,
        height: 14,
        render: (id) => {
            const html = `
                <div class="widget-card h-full group relative">
                    <button onclick="removeWidget('${id}')" class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 text-slate-500 hover:text-red-400 transition-snappy z-10 p-1.5 rounded-lg hover:bg-white/5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    
                    <div class="p-5 h-full flex flex-col">
                        <!-- Header with summary stats -->
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-sky-500/20 to-sky-600/10 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-semibold theme-strong-text uppercase tracking-wider">Purchase Order Trends</h3>
                                </div>
                                <p class="text-xs theme-muted-text pl-10">Monthly PO values over the past 12 months</p>
                            </div>
                            <div id="po-trends-summary-${id}" class="text-right">
                                <div class="text-xs theme-muted-text">Loading...</div>
                            </div>
                        </div>
                        
                        <!-- Chart container -->
                        <div class="flex-1 min-h-0 glass p-4 rounded-xl">
                            <canvas id="chart-${id}"></canvas>
                        </div>
                    </div>
                </div>
            `;
            
            // Initialize chart with real data
            setTimeout(async () => {
                const canvas = document.getElementById(`chart-${id}`);
                const summaryEl = document.getElementById(`po-trends-summary-${id}`);
                if (!canvas) return;
                
                const result = await fetchDashboardData();
                if (result.success && result.data.length > 0) {
                    const monthData = transformers.groupByMonth(result.data);
                    const sortedMonths = Object.keys(monthData).sort();
                    const last12Months = sortedMonths.slice(-12);
                    const values = last12Months.map(month => monthData[month]);
                    
                    // Update summary stats
                    if (summaryEl && values.length > 0) {
                        const avgValue = values.reduce((sum, val) => sum + val, 0) / values.length;
                        const lastValue = values[values.length - 1];
                        const trend = lastValue > avgValue ? '↑' : '↓';
                        const trendColor = lastValue > avgValue ? 'text-emerald-400' : 'text-amber-400';
                        
                        summaryEl.innerHTML = `
                            <div class="text-xs theme-muted-text mb-0.5">12-Month Avg</div>
                            <div class="text-sm font-semibold theme-strong-text">${formatCurrency(avgValue)}</div>
                            <div class="text-xs ${trendColor} mt-0.5">${trend} ${((lastValue / avgValue - 1) * 100).toFixed(1)}%</div>
                        `;
                    }
                    
                    // Create gradient for fill
                    const ctx = canvas.getContext('2d');
                    const gradient = ctx.createLinearGradient(0, 0, 0, canvas.height);
                    gradient.addColorStop(0, 'rgba(56, 189, 248, 0.2)');
                    gradient.addColorStop(1, 'rgba(56, 189, 248, 0)');
                    
                    new Chart(canvas, {
                        type: 'line',
                        data: {
                            labels: last12Months.map(month => {
                                const [year, monthNum] = month.split('-');
                                const date = new Date(year, monthNum - 1);
                                return date.toLocaleDateString('en-US', { month: 'short', year: '2-digit' });
                            }),
                            datasets: [{
                                label: 'PO Value',
                                data: values,
                                borderColor: 'rgb(56, 189, 248)',
                                backgroundColor: gradient,
                                borderWidth: 2,
                                fill: true,
                                tension: 0.4,
                                pointRadius: 4,
                                pointHoverRadius: 6,
                                pointBackgroundColor: 'rgb(56, 189, 248)',
                                pointBorderColor: 'rgba(15, 23, 42, 0.8)',
                                pointBorderWidth: 2,
                                pointHoverBackgroundColor: 'rgb(125, 211, 252)',
                                pointHoverBorderColor: 'rgb(56, 189, 248)',
                                pointHoverBorderWidth: 3
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            interaction: {
                                mode: 'index',
                                intersect: false
                            },
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                                    titleColor: 'rgb(226, 232, 240)',
                                    bodyColor: 'rgb(148, 163, 184)',
                                    borderColor: 'rgba(56, 189, 248, 0.3)',
                                    borderWidth: 1,
                                    padding: 12,
                                    displayColors: false,
                                    callbacks: {
                                        label: (context) => `${formatCurrency(context.parsed.y)}`
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: { 
                                        color: 'rgba(51, 65, 85, 0.3)',
                                        drawBorder: false
                                    },
                                    border: { display: false },
                                    ticks: {
                                        callback: (value) => formatCurrency(value)
                                    }
                                },
                                x: {
                                    grid: { display: false },
                                    border: { display: false }
                                }
                            }
                        }
                    });
                }
            }, 100);
            
            return html;
        }
    },

    'category-analysis-chart': {
        title: 'Category Analysis',
        width: 80,
        height: 14,
        render: (id) => {
            const html = `
                <div class="widget-card h-full group relative">
                    <button onclick="removeWidget('${id}')" class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 text-slate-500 hover:text-red-400 transition-snappy z-10 p-1.5 rounded-lg hover:bg-white/5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    
                    <div class="p-5 h-full flex flex-col">
                        <!-- Header with summary stats -->
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500/20 to-indigo-600/10 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-semibold theme-strong-text uppercase tracking-wider">Purchase Order by Category</h3>
                                </div>
                                <p class="text-xs theme-muted-text pl-10">Top spending categories ranked by total value</p>
                            </div>
                            <div id="category-summary-${id}" class="text-right">
                                <div class="text-xs theme-muted-text">Loading...</div>
                            </div>
                        </div>
                        
                        <!-- Chart container -->
                        <div class="flex-1 min-h-0 glass p-4 rounded-xl">
                            <canvas id="chart-${id}"></canvas>
                        </div>
                    </div>
                </div>
            `;
            
            // Initialize chart with real data
            setTimeout(async () => {
                const canvas = document.getElementById(`chart-${id}`);
                const summaryEl = document.getElementById(`category-summary-${id}`);
                if (!canvas) return;
                
                const result = await fetchDashboardData();
                if (result.success && result.data.length > 0) {
                    const categoryData = transformers.groupByCategory(result.data);
                    const sortedCategories = Object.entries(categoryData)
                        .sort((a, b) => b[1] - a[1])
                        .slice(0, 10); // Top 10 categories
                    
                    const labels = sortedCategories.map(([cat]) => cat);
                    const values = sortedCategories.map(([, val]) => val);
                    
                    // Update summary stats
                    if (summaryEl && sortedCategories.length > 0) {
                        const totalValue = values.reduce((sum, val) => sum + val, 0);
                        const topCategory = sortedCategories[0];
                        const topPercentage = totalValue > 0 
                            ? ((topCategory[1] / totalValue) * 100).toFixed(1) 
                            : '0.0';
                        
                        summaryEl.innerHTML = `
                            <div class="text-xs theme-muted-text mb-0.5">Top Category</div>
                            <div class="text-sm font-semibold theme-strong-text truncate max-w-[200px]">${topCategory[0]}</div>
                            <div class="text-xs text-indigo-400 mt-0.5">${topPercentage}% of total</div>
                        `;
                    }
                    
                    // Generate gradient colors for bars
                    const generateColor = (index, total) => {
                        const intensity = 1 - (index / total) * 0.5;
                        return `rgba(99, 102, 241, ${intensity})`;
                    };
                    
                    new Chart(canvas, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Total Value',
                                data: values,
                                backgroundColor: values.map((_, i) => generateColor(i, values.length)),
                                borderColor: 'rgba(99, 102, 241, 0.8)',
                                borderWidth: 1,
                                borderRadius: 6,
                                borderSkipped: false
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            indexAxis: 'y',
                            interaction: {
                                mode: 'index',
                                intersect: false
                            },
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                                    titleColor: 'rgb(226, 232, 240)',
                                    bodyColor: 'rgb(148, 163, 184)',
                                    borderColor: 'rgba(99, 102, 241, 0.3)',
                                    borderWidth: 1,
                                    padding: 12,
                                    displayColors: false,
                                    callbacks: {
                                        label: (context) => `${formatCurrency(context.parsed.x)}`
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    beginAtZero: true,
                                    grid: { 
                                        color: 'rgba(51, 65, 85, 0.3)',
                                        drawBorder: false
                                    },
                                    border: { display: false },
                                    ticks: {
                                        callback: (value) => formatCurrency(value)
                                    }
                                },
                                y: {
                                    grid: { display: false },
                                    border: { display: false },
                                    ticks: {
                                        autoSkip: false,
                                        font: { size: 11 }
                                    }
                                }
                            }
                        }
                    });
                }
            }, 100);
            
            return html;
        }
    },

    'vendor-concentration-chart': {
        title: 'Vendor Concentration',
        width: 40,
        height: 14,
        render: (id) => {
            const html = `
                <div class="widget-card h-full group relative">
                    <button onclick="removeWidget('${id}')" class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 text-slate-500 hover:text-red-400 transition-snappy z-10 p-1.5 rounded-lg hover:bg-white/5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    
                    <div class="p-5 h-full flex flex-col">
                        <!-- Header with summary stats -->
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-violet-500/20 to-violet-600/10 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-semibold theme-strong-text uppercase tracking-wider">Vendor Concentration</h3>
                                </div>
                                <p class="text-xs theme-muted-text pl-10">Top 10 vendors by purchase value</p>
                            </div>
                            <div id="vendor-summary-${id}" class="text-right">
                                <div class="text-xs theme-muted-text">Loading...</div>
                            </div>
                        </div>
                        
                        <!-- Chart container -->
                        <div class="flex-1 min-h-0 glass p-4 rounded-xl flex items-center justify-center">
                            <div class="w-full max-w-[280px]">
                                <canvas id="chart-${id}"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // Initialize chart with real data
            setTimeout(async () => {
                const canvas = document.getElementById(`chart-${id}`);
                const summaryEl = document.getElementById(`vendor-summary-${id}`);
                if (!canvas) return;
                
                const result = await fetchDashboardData();
                if (result.success && result.data.length > 0) {
                    // Group by vendor
                    const vendorData = {};
                    result.data.forEach(po => {
                        const vendor = po['Vendor Name'] || 'Unknown';
                        const amount = parseFloat((po['Total Amount in MYR'] || '0').toString().replace(/,/g, ''));
                        vendorData[vendor] = (vendorData[vendor] || 0) + amount;
                    });
                    
                    // Sort by value and take top 10, rest as "Others"
                    const sortedVendors = Object.entries(vendorData)
                        .sort((a, b) => b[1] - a[1]);
                    
                    const top10 = sortedVendors.slice(0, 10);
                    const othersSum = sortedVendors.slice(10).reduce((sum, [, val]) => sum + val, 0);
                    
                    const labels = top10.map(([vendor]) => vendor);
                    const values = top10.map(([, value]) => value);
                    
                    if (othersSum > 0) {
                        labels.push('Others');
                        values.push(othersSum);
                    }
                    
                    // Update summary stats
                    if (summaryEl && top10.length > 0) {
                        const totalValue = values.reduce((sum, val) => sum + val, 0);
                        const topVendor = top10[0];
                        const topPercentage = ((topVendor[1] / totalValue) * 100).toFixed(1);
                        
                        summaryEl.innerHTML = `
                            <div class="text-xs theme-muted-text mb-0.5">Top Vendor</div>
                            <div class="text-sm font-semibold theme-strong-text truncate max-w-[180px]">${topVendor[0]}</div>
                            <div class="text-xs text-violet-400 mt-0.5">${topPercentage}% share</div>
                        `;
                    }
                    
                    // DaisyUI-inspired color palette
                    const colors = [
                        'rgba(139, 92, 246, 0.8)',  // violet
                        'rgba(99, 102, 241, 0.8)',  // indigo
                        'rgba(59, 130, 246, 0.8)',  // blue
                        'rgba(56, 189, 248, 0.8)',  // sky
                        'rgba(34, 197, 94, 0.8)',   // emerald
                        'rgba(234, 179, 8, 0.8)',   // yellow
                        'rgba(251, 146, 60, 0.8)',  // orange
                        'rgba(239, 68, 68, 0.8)',   // red
                        'rgba(236, 72, 153, 0.8)',  // pink
                        'rgba(168, 85, 247, 0.8)',  // purple
                        'rgba(100, 116, 139, 0.6)'  // slate (for "Others")
                    ];
                    
                    new Chart(canvas, {
                        type: 'doughnut',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: values,
                                backgroundColor: colors.slice(0, labels.length),
                                borderColor: 'rgba(15, 23, 42, 0.8)',
                                borderWidth: 2,
                                hoverOffset: 8
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            cutout: '60%',
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'right',
                                    labels: {
                                        boxWidth: 12,
                                        boxHeight: 12,
                                        padding: 10,
                                        font: { size: 10 },
                                        generateLabels: (chart) => {
                                            const data = chart.data;
                                            return data.labels.map((label, i) => {
                                                const value = data.datasets[0].data[i];
                                                const total = data.datasets[0].data.reduce((sum, val) => sum + val, 0);
                                                const percentage = ((value / total) * 100).toFixed(1);
                                                return {
                                                    text: `${label} (${percentage}%)`,
                                                    fillStyle: data.datasets[0].backgroundColor[i],
                                                    hidden: false,
                                                    index: i
                                                };
                                            });
                                        }
                                    }
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                                    titleColor: 'rgb(226, 232, 240)',
                                    bodyColor: 'rgb(148, 163, 184)',
                                    borderColor: 'rgba(139, 92, 246, 0.3)',
                                    borderWidth: 1,
                                    padding: 12,
                                    callbacks: {
                                        label: (context) => {
                                            const value = formatCurrency(context.parsed);
                                            const total = context.dataset.data.reduce((sum, val) => sum + val, 0);
                                            const percentage = ((context.parsed / total) * 100).toFixed(1);
                                            return `${value} (${percentage}%)`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            }, 100);
            
            return html;
        }
    },

    'live-metric': {
        title: 'Live Metric',
        width: 20,
        height: 6,
        render: (id) => `
            <div class="widget-card h-full group relative">
                <button onclick="removeWidget('${id}')" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 text-slate-500 hover:text-red-400 transition-snappy z-10 p-1 rounded hover:bg-white/5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="p-6 flex flex-col justify-center h-full">
                    <div class="text-xs font-medium text-slate-400 mb-1 uppercase tracking-wider">Active Users</div>
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
        width: 20,
        height: 6,
        render: (id) => `
            <div class="widget-card h-full group relative">
                <button onclick="removeWidget('${id}')" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 text-slate-500 hover:text-red-400 transition-snappy z-10 p-1 rounded hover:bg-white/5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="p-4 space-y-3 h-full flex flex-col justify-center">
                    <div class="text-xs font-medium text-slate-400 mb-1 uppercase tracking-wider">System Status</div>
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
