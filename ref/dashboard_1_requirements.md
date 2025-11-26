# Dashboard 1 Requirements - Procurement Lifecycle (PO-Centric)

**Project:** Berapit Mobility Procurement Analytics Dashboard  
**Dashboard:** Dashboard 1 - Procurement Lifecycle  
**Version:** 1.0  
**Date:** November 25, 2025  
**Technology Stack:** HTMX, Laravel (PHP), Google Sheets API, TailwindCSS  

---

## OVERVIEW

Dashboard 1 provides a comprehensive view of the procurement lifecycle, focusing on Purchase Orders (POs), vendor relationships, spending patterns, and payment health. It replaces manual dashboard creation with real-time automated analytics.

**Key Metrics:**
- 1,081 Purchase Orders
- 672 Vendors
- MYR 607M Outstanding Amount

---

## DATA INTEGRATION (FR-1)

### Source Configuration
- **Data Source:** Google Sheets via API
- **Sheet ID:** `1RooX6rBh6AyIkBUKdX4ZijUr8Gk93Bi4`
- **Worksheets:** "PO" and "Vendor"

### Data Structure

#### PO Records
- PO Number
- PO Date
- Vendor Name/Code
- PO Amount (MYR)
- Outstanding Amount (MYR)
- Category (R2/R3/R4/R7, OP, RV, GN, M01, CASH)
- Document Status

#### Vendor Records
- Vendor Code
- Vendor Name
- Total Outstanding Amount (MYR)
- Contact Details

### Data Refresh
- **Trigger:** Page load or manual refresh
- **Display:** Last refresh timestamp
- **Performance Target:** ≤3 seconds initial load

---

## DASHBOARD PANELS

### Panel 1: Top-Level KPI Cards (FR-2.1)

Four hero metrics displayed in equal-width cards:

1. **Total PO Value (YTD)**
   - Sum of all PO amounts (current year)
   - Display in MYR with thousand separators
   - Format: `MYR 607,000,000`

2. **Total Outstanding Amount**
   - Sum of all outstanding amounts across active POs
   - Display in MYR with thousand separators
   - Red/amber/green color coding based on thresholds

3. **Active Vendor Count**
   - Count of unique vendors with active POs
   - Display as integer
   - Include trend indicator (vs previous period)

4. **PO Count**
   - Current month PO count
   - Comparison with previous month
   - Display percentage change (↑/↓)
   - Format: `123 POs (+15% vs last month)`

**Visual Design:**
- Equal-width cards spanning dashboard width
- Large primary metric with supporting subtext
- Icon/badge for quick identification
- Subtle background color differentiation

---

### Panel 2: PO Trends (FR-2.2)

#### Chart 2A: PO Volume & Value Timeline
- **Type:** Dual-axis line chart
- **X-Axis:** Month (last 12 months)
- **Y-Axis Left:** PO Count (integer)
- **Y-Axis Right:** Total PO Value (MYR)
- **Lines:** 
  - PO Count (solid line, primary color)
  - PO Value (dashed line, secondary color)
- **Interaction:** Hover shows exact values, click filters by month

#### Chart 2B: PO Value by Category
- **Type:** Stacked bar chart
- **X-Axis:** Month (last 12 months)
- **Y-Axis:** PO Value (MYR)
- **Categories:** R2, R3, R4, R7, OP, RV, GN, M01, CASH
- **Color Scheme:** Distinct color per category
- **Interaction:** Click category segment to filter dashboard

#### Chart 2C: Document Status Funnel
- **Type:** Funnel visualization
- **Stages:**
  - POs Created
  - POs Approved
  - Goods/Services Received
  - Invoiced
  - Paid
- **Display:** Count and percentage at each stage
- **Interaction:** Click stage to show PO list

**Layout:** 60/40 split (2A+2B left, 2C right)

---

### Panel 3: Vendor Analytics (FR-2.3)

#### Chart 3A: Top 10 Vendors by Spend
- **Type:** Horizontal bar chart
- **X-Axis:** Total Spend (MYR)
- **Y-Axis:** Vendor Name
- **Sort:** Descending by spend
- **Display:** Top 10 vendors only
- **Interaction:** Click vendor bar to drill down

#### Chart 3B: Vendor Concentration
- **Type:** Pie chart
- **Segments:**
  - Top 5 Vendors (individual slices)
  - Others (aggregated)
- **Display:** Percentage and absolute value
- **Interaction:** Click slice to filter related panels

#### Chart 3C: Vendors with Outstanding Amounts
- **Type:** Data table
- **Columns:**
  - Vendor Name
  - Total Outstanding (MYR)
  - Number of POs
  - Oldest Outstanding Date
  - Aging Bucket
- **Features:**
  - Sortable columns
  - Search/filter
  - Pagination (25 rows per page)
  - Export to Excel button

**Layout:** 3A and 3B side-by-side (50/50), 3C full width below

---

### Panel 4: Category Intelligence (FR-2.4)

#### Chart 4A: Spend Distribution Treemap
- **Type:** Treemap
- **Hierarchy:** Category → Subcategory (if applicable)
- **Size:** Proportional to spend
- **Color:** Category grouping
- **Display:** Category name + MYR value on hover
- **Interaction:** Click to zoom into subcategories

#### Chart 4B: Category Spend Trends
- **Type:** Multi-line chart
- **X-Axis:** Month (last 12 months)
- **Y-Axis:** Spend (MYR)
- **Lines:** One per category (R2, R3, R4, etc.)
- **Legend:** Toggle category visibility
- **Interaction:** Click legend to show/hide categories

#### Chart 4C: Cash vs Credit Split
- **Type:** Stacked bar chart (horizontal)
- **Categories:**
  - Cash POs (count + value)
  - Credit POs (count + value)
- **Display:** Percentage and absolute values
- **Comparison:** Current month vs YTD average

**Layout:** 4A (60% width), 4B + 4C stacked (40% width)

---

### Panel 5: Payment Health (FR-2.5)

#### Chart 5A: Outstanding by Aging Buckets
- **Type:** Stacked bar chart
- **X-Axis:** Month (last 12 months)
- **Y-Axis:** Outstanding Amount (MYR)
- **Buckets:**
  - Current (0-30 days) - Green
  - 31-60 days - Yellow
  - 61-90 days - Orange
  - 91-120 days - Red
  - 120+ days - Dark Red
- **Interaction:** Click bucket to show PO details

#### Metric 5B: Average Payment Cycle
- **Calculation:** Average days from PO date to payment date
- **Display:** Large metric card
- **Comparison:** Current vs target (30 days)
- **Trend:** 3-month rolling average line chart

#### Chart 5C: Red Flag Alerts
- **Type:** Alert list table
- **Filter:** Outstanding >90 days
- **Columns:**
  - PO Number
  - Vendor Name
  - Outstanding Amount
  - Days Overdue
  - Category
  - Assigned Contact
- **Sort:** Descending by days overdue
- **Visual:** Red badge/icon for urgency
- **Action:** Click PO number to view details

**Layout:** 5A (50% width), 5B + 5C (50% width stacked)

---

## INTERACTIVE FILTERS (FR-3)

### Global Filter Panel

Positioned at top of dashboard (below KPI cards, above charts):

1. **Date Range Picker**
   - Start Date and End Date inputs
   - Preset options: This Month, Last Month, This Quarter, This Year, Custom
   - Default: Current Year-to-Date

2. **Category Multi-Select**
   - Checkboxes for: R2, R3, R4, R7, OP, RV, GN, M01, CASH
   - "Select All" / "Clear All" options
   - Selected count badge

3. **Vendor Search/Filter**
   - Autocomplete dropdown
   - Search by vendor code or name
   - Multi-select capability
   - Recently selected vendors shortcut

4. **Document Class Filter**
   - Dropdown: All, Standard PO, Rush Order, Recurring, One-Time
   - Single selection

5. **Status Filter**
   - Checkboxes: Created, Approved, Received, Invoiced, Paid
   - "Active" preset (Created + Approved + Received)

6. **Reset All Filters Button**
   - Returns dashboard to default state
   - Clear selection indicator

### Filter Behavior
- **Update Trigger:** Apply button OR auto-apply on selection (configurable)
- **HTMX Implementation:** Partial page updates without full reload
- **Performance:** Updates complete within 500ms
- **Visual Feedback:** Loading spinner on affected panels
- **Persistence:** Filter state saved in session (survives page refresh)

---

## DRILL-DOWN FUNCTIONALITY (FR-5)

### Interaction Patterns

#### From Charts to Details
- **Vendor Chart Click** → Shows all POs for that vendor
- **Category Chart Click** → Shows month-by-month breakdown
- **Month Data Point Click** → Shows PO list for that month
- **Status Funnel Click** → Shows POs in that stage

#### Breadcrumb Navigation
- Display active drill-down path
- Example: `All Data > Category: R3 > Vendor: ABC Sdn Bhd`
- Click any breadcrumb level to return to that view

#### Back Button
- Returns to previous view state
- Restores previous filters
- Keyboard shortcut: Esc key

#### PO Detail Modal
- Triggered by clicking PO number anywhere
- Displays complete PO information
- Shows related documents/notes
- Close button and overlay click to dismiss

---

## DATA EXPORT (FR-4)

### Export Options

1. **Export to Excel (.xlsx)**
   - Button location: Top-right of dashboard
   - Exports currently filtered data
   - Includes all PO and vendor details
   - Respects active filters
   - Filename format: `Procurement_Dashboard_YYYY-MM-DD.xlsx`

2. **Export to PDF Report**
   - Button location: Top-right of dashboard
   - Generates print-optimized report
   - Includes:
     - KPI summary
     - All visible charts (as images)
     - Summary tables
     - Filter parameters used
     - Generated timestamp
   - Filename format: `Procurement_Report_YYYY-MM-DD.pdf`

3. **Export Individual Charts as PNG**
   - Button appears on chart hover (top-right corner)
   - Exports chart at high resolution (1920x1080)
   - Transparent or white background option
   - Filename format: `Chart_[ChartName]_YYYY-MM-DD.png`

### Export Requirements
- All exports complete within 5 seconds
- File size limits: Excel <10MB, PDF <5MB, PNG <2MB
- Download prompt or auto-download (browser dependent)

---

## USER INTERFACE SPECIFICATIONS (FR-6)

### Layout Structure

```
┌─────────────────────────────────────────────────────────────────┐
│ Header: Logo, Title, Refresh Button, Export Menu, Theme Toggle │
├─────────────────────────────────────────────────────────────────┤
│ KPI Cards: [Total PO Value] [Outstanding] [Vendors] [PO Count] │
├─────────────────────────────────────────────────────────────────┤
│ Global Filters: Date Range | Category | Vendor | Status | Reset│
├─────────────────────────────────────────────────────────────────┤
│ Panel 2: PO Trends                                              │
│ ┌────────────────────────────────┬──────────────────────────┐   │
│ │ Chart 2A: Volume & Value (60%) │ Chart 2C: Funnel (40%)   │   │
│ │ Chart 2B: By Category (60%)    │                          │   │
│ └────────────────────────────────┴──────────────────────────┘   │
├─────────────────────────────────────────────────────────────────┤
│ Panel 3: Vendor Analytics                                       │
│ ┌──────────────────────┬──────────────────────┐                 │
│ │ Chart 3A: Top 10     │ Chart 3B: Concentration│               │
│ └──────────────────────┴──────────────────────┘                 │
│ ┌───────────────────────────────────────────────────────────┐   │
│ │ Chart 3C: Outstanding Table (Full Width)                  │   │
│ └───────────────────────────────────────────────────────────┘   │
├─────────────────────────────────────────────────────────────────┤
│ Panel 4: Category Intelligence                                  │
│ ┌────────────────────────────────┬──────────────────────────┐   │
│ │ Chart 4A: Treemap (60%)        │ Chart 4B: Trends         │   │
│ │                                 │ Chart 4C: Cash/Credit    │   │
│ └────────────────────────────────┴──────────────────────────┘   │
├─────────────────────────────────────────────────────────────────┤
│ Panel 5: Payment Health                                         │
│ ┌─────────────────────────────┬────────────────────────────┐    │
│ │ Chart 5A: Aging Buckets     │ Metric 5B: Avg Cycle       │    │
│ │                              │ Chart 5C: Red Flags        │    │
│ └─────────────────────────────┴────────────────────────────┘    │
└─────────────────────────────────────────────────────────────────┘
```

### Design System (shadcn-inspired)

#### Color Palette
- **Primary:** Blue (#3b82f6) - Actions, links
- **Secondary:** Slate (#64748b) - Text, borders
- **Success:** Green (#22c55e) - Positive metrics
- **Warning:** Amber (#f59e0b) - Caution indicators
- **Danger:** Red (#ef4444) - Alerts, overdue items
- **Background:** White (#ffffff) / Dark (#0f172a)

#### Typography
- **Headings:** Inter font, bold
- **Body:** Inter font, regular
- **Numbers:** Tabular figures for alignment
- **Currency:** MYR symbol, comma separators

#### Components
- **Cards:** Rounded corners (8px), subtle shadow
- **Buttons:** Rounded (6px), hover state, disabled state
- **Inputs:** Outlined, focus ring, placeholder text
- **Tables:** Alternating row colors, hover highlight
- **Charts:** Consistent padding, axis labels, tooltips

### Responsive Breakpoints

- **Desktop:** ≥1280px (full layout as shown)
- **Tablet:** 768px - 1279px (2-column grid, some charts stack)
- **Mobile:** <768px (single column, simplified charts)

### Theme Toggle
- **Light Mode:** Default, high contrast
- **Dark Mode:** Dark backgrounds, adjusted colors for readability
- **Toggle Location:** Top-right header
- **Persistence:** User preference saved in browser storage

### Accessibility
- **Keyboard Navigation:** Tab through all interactive elements
- **Screen Reader:** ARIA labels on charts and data points
- **Color Contrast:** WCAG AA compliance minimum
- **Focus Indicators:** Visible focus rings on all controls

---

## PERFORMANCE REQUIREMENTS (NFR-1)

### Load Time Targets
- **Initial Dashboard Load:** ≤3 seconds
- **Chart Rendering:** ≤1 second after data loaded
- **Filter Application:** ≤500ms visual update
- **Export Generation:** ≤5 seconds

### Data Volume Capacity
- **PO Records:** Up to 10,000 without degradation
- **Vendors:** Up to 1,000
- **Concurrent Users:** 10-20 (initial deployment)

### Optimization Strategies
- Laravel response caching (5-minute TTL)
- Google Sheets data caching (avoid repeated API calls)
- Lazy loading for off-screen charts
- Pagination for large tables (25-50 rows per page)
- Asset minification (CSS/JS)

---

## TECHNICAL IMPLEMENTATION NOTES

### Backend (Laravel)

#### Controllers
- `DashboardController@index` - Main dashboard view
- `DashboardController@refreshData` - Manual data refresh (HTMX)
- `DashboardController@filterData` - Apply filters (HTMX)
- `DashboardController@exportExcel` - Excel export
- `DashboardController@exportPdf` - PDF export

#### Services
- `GoogleSheetsService` - API integration, data fetching
- `DataTransformer` - Transform Sheets data to models
- `ChartDataService` - Aggregate data for charts
- `ExportService` - Handle Excel/PDF generation

#### Models
- `PurchaseOrder` - PO data model
- `Vendor` - Vendor data model

#### Routes (web.php)
```php
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/dashboard/refresh', [DashboardController::class, 'refreshData'])->name('dashboard.refresh');
Route::post('/dashboard/filter', [DashboardController::class, 'filterData'])->name('dashboard.filter');
Route::get('/dashboard/export/excel', [DashboardController::class, 'exportExcel'])->name('dashboard.export.excel');
Route::get('/dashboard/export/pdf', [DashboardController::class, 'exportPdf'])->name('dashboard.export.pdf');
```

### Frontend (Blade + HTMX)

#### Main View
- `resources/views/dashboard.blade.php` - Full page layout

#### Components
- `components/kpi-card.blade.php` - KPI metric card
- `components/chart-container.blade.php` - Chart wrapper
- `components/filter-panel.blade.php` - Global filters
- `components/data-table.blade.php` - Sortable table

#### Partials (HTMX-loadable)
- `partials/kpi-cards.blade.php` - KPI section
- `partials/po-trends.blade.php` - Panel 2
- `partials/vendor-analytics.blade.php` - Panel 3
- `partials/category-intelligence.blade.php` - Panel 4
- `partials/payment-health.blade.php` - Panel 5

#### JavaScript Libraries
- **HTMX** (v1.9+) - Dynamic updates
- **Chart.js** (v4+) or **Apache ECharts** - Chart rendering
- **Alpine.js** (optional) - Lightweight interactivity

#### CSS
- TailwindCSS (v3+) with custom configuration
- shadcn-inspired component styles

---

## ACCEPTANCE CRITERIA

Dashboard 1 is considered complete when:

✅ **Functional Requirements**
1. Dashboard connects to Google Sheets and displays live data
2. All four KPI cards show accurate calculated values
3. All 11 charts/tables render with correct data
4. Global filters update all panels simultaneously within 500ms
5. Drill-down interactions work (click chart → filter related panels)
6. Export to Excel/PDF functions produce valid files
7. Breadcrumb navigation reflects current drill-down state

✅ **Performance Requirements**
8. Dashboard initial load completes in ≤3 seconds
9. Filter updates complete in ≤500ms
10. System handles 1,081 POs + 672 vendors without lag

✅ **Usability Requirements**
11. Procurement manager can answer key questions in <60 seconds:
    - "Which vendor has the highest outstanding?"
    - "What's our spending trend over last 6 months?"
    - "How many POs are overdue >90 days?"
12. Dashboard works on Chrome, Edge, Firefox (latest 2 versions)
13. Responsive layout functions on tablet and mobile devices
14. Dark/light theme toggle works without layout breaks

✅ **Reliability Requirements**
15. System runs for 5 consecutive business days without crashes
16. Google Sheets API failures show graceful error message (not crash)
17. Stale data warning appears if refresh fails

✅ **Documentation Requirements**
18. Installation guide enables team member to run locally
19. User manual answers common "how do I..." questions
20. Code comments explain HTMX interaction patterns

---

## SUCCESS METRICS (POST-DEPLOYMENT)

### Efficiency Gains
- **Time to Generate Dashboard:** Manual (2+ hours) → Automated (<5 seconds)
- **Time to Answer Oversight Questions:** Excel search (5-10 min) → Dashboard (<60 sec)
- **Data Accuracy:** Manual errors eliminated (0% error rate target)

### Adoption Metrics
- **Daily Active Users:** Track unique visitors per day
- **Feature Usage:** Log which filters/exports are most used
- **Session Duration:** Average time spent analyzing data

### Business Impact
- **Overdue Payment Reduction:** Track 90+ day overdue PO count (target: -20% in 3 months)
- **Vendor Concentration Awareness:** Management visibility into top vendor dependencies
- **Budget Tracking:** YTD spend vs budget variance monitoring

---

## FUTURE ENHANCEMENTS (Post-Phase 1)

1. **Automated Alerts:** Email notifications for overdue payments >90 days
2. **Forecasting:** Predictive spend modeling based on historical trends
3. **Vendor Performance Scores:** Calculate on-time delivery, quality ratings
4. **Budget vs Actual:** Overlay budget lines on spend charts
5. **Approval Workflow Tracking:** Visualize bottlenecks in PO approval process
6. **Mobile App:** Native iOS/Android apps for on-the-go access
7. **Integration:** Connect to accounting system (future data source)
8. **Dashboard 2:** Operations Utilization (pending data availability)

---

## REFERENCES

- **Main Requirements Document:** `init_requirement_gathering.md`
- **Google Sheets Data Source:** Sheet ID `1RooX6rBh6AyIkBUKdX4ZijUr8Gk93Bi4`
- **Design Reference:** Two legacy dashboard PDFs (provided by client)
- **Technology Stack:**
  - Laravel Framework: https://laravel.com/docs
  - HTMX: https://htmx.org/docs/
  - TailwindCSS: https://tailwindcss.com/docs
  - shadcn UI: https://ui.shadcn.com/
  - Google Sheets API: https://developers.google.com/sheets/api

---

**Document Status:** APPROVED FOR DEVELOPMENT  
**Next Steps:** Begin Phase 1 implementation  
**Target Completion:** 2 weeks from approval date
