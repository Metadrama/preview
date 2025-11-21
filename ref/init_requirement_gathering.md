# Berapit Mobility Procurement Dashboard - System Requirements

**Project Name:** Procurement Analytics Dashboard  
**Client:** Berapit Mobility Sdn Bhd  
**Document Version:** 1.1  
**Date:** November 16, 2025  
**Technology Stack:** HTMX, Laravel (PHP), Google Sheets API, TailwindCSS  

---

## 1. PURPOSE OF THE SYSTEM

### 1.1 Background
Berapit Mobility's procurement team currently maintains a master procurement file (1,081 POs, 672 vendors, MYR 607M outstanding) and manually generates two separate dashboards using unknown tools. This manual process is time-consuming, error-prone, and creates dependencies on specific personnel.

### 1.2 System Objectives
The Procurement Analytics Dashboard aims to:

1. **Automate Dashboard Generation**: Replace manual dashboard creation with real-time automated analytics
2. **Enable Data-Driven Oversight**: Provide procurement managers with instant visibility into spending patterns, vendor performance, and payment status
3. **Reduce People Dependencies**: Eliminate reliance on specific individuals for dashboard preparation
4. **Support Decision-Making**: Present actionable insights through hierarchical information design (KPI → Trends → Details)
5. **Maintain Data Integrity**: Use Google Sheets as single source of truth, eliminating data duplication

### 1.3 Success Criteria
- Dashboard updates automatically when source data changes
- Procurement team can access insights without opening Excel/Sheets
- Management can answer key oversight questions in <60 seconds
- Zero manual data entry or report generation required

---

## 2. FUNCTIONAL REQUIREMENTS (FR)

### FR-1: Data Integration
- **FR-1.1**: System shall connect to Google Sheets via API (Sheet ID: `1RooX6rBh6AyIkBUKdX4ZijUr8Gk93Bi4`)
- **FR-1.2**: System shall read data from "PO" and "Vendor" worksheets
- **FR-1.3**: System shall handle the following data types:
  - PO records: Number, Date, Vendor, Amount, Outstanding, Category, Status
  - Vendor records: Code, Name, Outstanding Amount, Contact details
- **FR-1.4**: System shall refresh data on page load or manual refresh trigger
- **FR-1.5**: System shall display last data refresh timestamp

### FR-2: Dashboard 1 - Procurement Lifecycle (PO-Centric)

#### FR-2.1: Top-Level KPI Cards
Display four hero metrics:
- Total PO Value (YTD in MYR)
- Total Outstanding Amount (MYR)
- Active Vendor Count
- PO Count (Current Month vs Previous Month with % change)

#### FR-2.2: PO Trends Panel
- **FR-2.2.1**: Line chart showing PO count and value by month (last 12 months)
- **FR-2.2.2**: Stacked bar chart showing PO value by category (R2/R3/R4/R7, OP, RV, GN, M01, CASH)
- **FR-2.2.3**: Funnel visualization of document status distribution

#### FR-2.3: Vendor Analytics Panel
- **FR-2.3.1**: Horizontal bar chart of Top 10 vendors by total spend
- **FR-2.3.2**: Pie chart showing vendor concentration (Top 5 vs Others)
- **FR-2.3.3**: Data table of vendors with outstanding amounts (sortable)

#### FR-2.4: Category Intelligence Panel
- **FR-2.4.1**: Treemap showing spend distribution by category and subcategory
- **FR-2.4.2**: Line chart showing category spend trends over time
- **FR-2.4.3**: Breakdown showing Cash vs Credit PO split

#### FR-2.5: Payment Health Panel
- **FR-2.5.1**: Stacked bar chart of outstanding amounts by aging buckets:
  - Current (0-30 days)
  - 31-60 days
  - 61-90 days
  - 91-120 days
  - 120+ days
- **FR-2.5.2**: Calculate and display average payment cycle (days)
- **FR-2.5.3**: Red flag alert list for overdue payments >90 days

### FR-3: Interactive Filters (Global)
- **FR-3.1**: Date range picker (start date - end date)
- **FR-3.2**: Multi-select category filter
- **FR-3.3**: Vendor search/filter with autocomplete
- **FR-3.4**: Document class filter (dropdown)
- **FR-3.5**: "Reset All Filters" button
- **FR-3.6**: Filters shall update all dashboard panels simultaneously

### FR-4: Data Export
- **FR-4.1**: Export current filtered data to Excel (.xlsx)
- **FR-4.2**: Export current view as PDF report
- **FR-4.3**: Export individual charts as PNG images

### FR-5: Drill-Down Functionality
- **FR-5.1**: Clicking any chart element shall filter related panels
- **FR-5.2**: Clicking vendor name shall show all POs for that vendor
- **FR-5.3**: Clicking category shall show breakdown by month
- **FR-5.4**: Breadcrumb trail shall show active drill-down path
- **FR-5.5**: "Back" button shall return to previous view state

### FR-6: User Interface
- **FR-6.1**: System shall implement the approved layout structure:
  - Top: KPI cards (4 metrics, equal width)
  - Middle: 60/40 split (Main chart left, Breakdown right)
  - Bottom: Detailed data table (full width)
- **FR-6.2**: System shall use shadcn-style component library
- **FR-6.3**: System shall be responsive (desktop, tablet, mobile)
- **FR-6.4**: System shall support dark/light theme toggle

---

## 3. NON-FUNCTIONAL REQUIREMENTS (NFR)

### NFR-1: Performance
- **NFR-1.1**: Dashboard initial load time shall be ≤3 seconds
- **NFR-1.2**: Chart rendering shall be ≤1 second after data load
- **NFR-1.3**: Filter application shall update visuals within 500ms
- **NFR-1.4**: System shall handle up to 10,000 PO records without performance degradation

### NFR-2: Reliability
- **NFR-2.1**: System uptime shall be ≥99% during business hours (8 AM - 6 PM MYT)
- **NFR-2.2**: System shall gracefully handle Google Sheets API failures with error messages
- **NFR-2.3**: Data refresh failures shall not crash the dashboard (show stale data warning)

### NFR-3: Usability
- **NFR-3.1**: Dashboard shall be usable without training for users familiar with Excel
- **NFR-3.2**: All interactive elements shall provide visual feedback (hover states, loading indicators)
- **NFR-3.3**: Error messages shall be user-friendly (no technical jargon)
- **NFR-3.4**: System shall provide tooltips for all chart elements

### NFR-4: Security
- **NFR-4.1**: Google Sheets API credentials shall be stored securely (not in code)
- **NFR-4.2**: System shall use read-only access to Google Sheets
- **NFR-4.3**: Dashboard shall be accessible only within company network (initial deployment)
- **NFR-4.4**: No PII or sensitive vendor details shall be logged

### NFR-5: Maintainability
- **NFR-5.1**: Backend code shall follow PSR-12 PHP coding standards
- **NFR-5.2**: Frontend shall minimize JavaScript (HTMX attributes only)
- **NFR-5.3**: All controller methods shall have PHPUnit tests
- **NFR-5.4**: Blade templates shall be well-documented with comments
- **NFR-5.5**: System shall have comprehensive inline documentation

### NFR-6: Scalability
- **NFR-6.1**: System architecture shall support adding Dashboard 2 (Operations Utilization) without major refactoring
- **NFR-6.2**: Component library shall be reusable across multiple dashboards
- **NFR-6.3**: Data layer shall be abstracted to allow switching from Google Sheets to database if needed

### NFR-7: Compatibility
- **NFR-7.1**: System shall work on modern browsers (Chrome, Edge, Firefox, Safari - latest 2 versions)
- **NFR-7.2**: System shall be accessible on Windows, macOS, and Linux
- **NFR-7.3**: Mobile view shall maintain core functionality on iOS/Android devices

---

## 4. CONSTRAINTS

### 4.1 Technical Constraints
- **C-4.1.1**: Data source MUST be Google Sheets (existing master file)
- **C-4.1.2**: Backend MUST be Laravel (PHP 8.3+)
- **C-4.1.3**: Frontend interactivity MUST use HTMX (no heavy JavaScript frameworks)
- **C-4.1.4**: Styling MUST use TailwindCSS with shadcn-inspired components
- **C-4.1.5**: No database migration allowed (Google Sheets remains source of truth)

### 4.2 Data Constraints
- **C-4.2.1**: Current data lacks MSRF (Material/Service Request Form) records
- **C-4.2.2**: Current data lacks operational utilization metrics (manpower hours, equipment rental days)
- **C-4.2.3**: Dashboard 2 (Operations Utilization) cannot be built until data is available
- **C-4.2.4**: Outstanding amounts may have negative values (require handling)

### 4.3 Business Constraints
- **C-4.3.1**: Dashboard must match existing team expectations (based on two reference PDFs)
- **C-4.3.2**: System must not create dependencies on specific individuals
- **C-4.3.3**: Deployment must be achievable without dedicated IT support initially

### 4.4 Timeline Constraints
- **C-4.4.1**: Phase 1 (Dashboard 1) must be functional for initial review within 2 weeks
- **C-4.4.2**: User acceptance testing window: 1 week after Phase 1 delivery
- **C-4.4.3**: Dashboard 2 development blocked until operational data sources identified

### 4.5 Resource Constraints
- **C-4.5.1**: Development: Single developer
- **C-4.5.2**: Testing: Procurement team (no dedicated QA)
- **C-4.5.3**: Hosting: Local/internal server (no cloud hosting budget initially)

---

## 5. DELIVERABLES

### 5.1 Phase 1: Dashboard 1 - Procurement Lifecycle (Core MVP)

#### 5.1.1 Software Components
- **D-5.1.1**: Complete Laravel application with source code
  - **Backend (Laravel)**:
    - `app/Http/Controllers/DashboardController.php` - Main dashboard logic
    - `app/Services/GoogleSheetsService.php` - Google Sheets API integration
    - `app/Models/` - Data models (PurchaseOrder, Vendor)
    - `routes/web.php` - Route definitions
    - `config/services.php` - Google API configuration
  - **Frontend (Blade + HTMX)**:
    - `resources/views/dashboard.blade.php` - Main dashboard layout
    - `resources/views/components/` - Reusable components (KPI cards, charts, filters)
    - `resources/views/partials/` - HTMX-loadable partials
    - `public/js/htmx.min.js` - HTMX library (CDN or local)
  - **Assets**:
    - `resources/css/app.css` - TailwindCSS configuration
    - `public/build/` - Compiled assets (CSS/JS)
  
#### 5.1.2 Documentation
- **D-5.1.2**: Installation guide (`INSTALLATION.md`)
  - Prerequisites (PHP 8.3+, Composer, Node.js)
  - Laravel installation steps
  - Google Cloud service account setup
  - Environment configuration (.env setup)
  - Database migration (if needed for caching)
  - Asset compilation (npm run build)
  - First-time run instructions (php artisan serve)
  
- **D-5.1.3**: User manual (`USER_MANUAL.md`)
  - Dashboard navigation guide
  - Filter usage instructions
  - Export functionality guide
  - Troubleshooting common issues
  
- **D-5.1.4**: Developer documentation (`DEVELOPER.md`)
  - MVC architecture overview
  - HTMX interaction patterns
  - Code structure explanation
  - How to add new charts/metrics
  - Blade component creation guide
  - Testing procedures (PHPUnit)

#### 5.1.3 Configuration Files
- **D-5.1.5**: `composer.json` - PHP dependencies (Laravel, Google Sheets library)
- **D-5.1.6**: `package.json` - Frontend dependencies (TailwindCSS, HTMX)
- **D-5.1.7**: `.env.example` - Environment variables template
- **D-5.1.8**: `config/google-sheets.php` - Google Sheets configuration
- **D-5.1.9**: `credentials.json.example` - Google API service account template
- **D-5.1.10**: `tailwind.config.js` - TailwindCSS configuration
- **D-5.1.11**: `.gitignore` - Version control exclusions

#### 5.1.4 Deployment Package
- **D-5.1.12**: Runnable application accessible via `php artisan serve`
- **D-5.1.13**: Deployment script for production server
- **D-5.1.14**: Apache/Nginx configuration examples
- **D-5.1.15**: Sample data seeder (if Google Sheets unavailable)

### 5.2 Phase 2: Dashboard 2 - Operations Utilization (Future)

#### 5.2.1 Prerequisites (Not Yet Available)
- **D-5.2.1**: Operational data collection strategy document
- **D-5.2.2**: Data source identification (where manpower/equipment data lives)
- **D-5.2.3**: Updated Google Sheets structure with new tabs:
  - Manpower Spend Table
  - Equipment Rental Table
  - Equipment Master
  - Personnel Master

#### 5.2.2 Software Components (TBD)
- **D-5.2.4**: Extended dashboard with operations metrics
- **D-5.2.5**: New component library for utilization visualizations
- **D-5.2.6**: Updated documentation

### 5.3 Knowledge Transfer
- **D-5.3.1**: Live walkthrough session with procurement team (2 hours)
- **D-5.3.2**: Recorded video tutorial demonstrating key features
- **D-5.3.3**: Handover session covering maintenance procedures

### 5.4 Testing Artifacts
- **D-5.4.1**: Test plan document
- **D-5.4.2**: PHPUnit test suite (Feature and Unit tests)
- **D-5.4.3**: Browser testing checklist (HTMX interactions)
- **D-5.4.4**: User acceptance test (UAT) checklist
- **D-5.4.5**: Bug tracking spreadsheet template

### 5.5 Support Materials
- **D-5.5.1**: FAQ document addressing common questions
- **D-5.5.2**: Contact list for technical support
- **D-5.5.3**: Maintenance schedule recommendations (data refresh, backups, updates)

---

## 6. OUT OF SCOPE (Phase 1)

The following are explicitly **NOT included** in Phase 1:

1. **Dashboard 2** (Operations Utilization) - blocked by missing data
2. **User authentication/authorization** - internal network access only
3. **Role-based access control** - all users see same dashboard
4. **Data editing** - read-only dashboard (no write-back to Sheets)
5. **Automated alerts/notifications** - manual monitoring only
6. **Mobile app** - web interface only (responsive design included)
7. **Multi-language support** - English only
8. **Historical data archiving** - uses live Google Sheets data
9. **Advanced analytics** (ML/predictive modeling)
10. **Integration with other systems** (ERP, accounting software)

---

## 7. ACCEPTANCE CRITERIA

Phase 1 will be considered complete when:

1. ✅ Dashboard successfully connects to Google Sheets and displays live data
2. ✅ All four KPI cards show correct calculated values
3. ✅ All charts in FR-2 render with accurate data
4. ✅ Global filters update all panels simultaneously
5. ✅ Export to Excel/PDF functions work without errors
6. ✅ Dashboard loads in <3 seconds on company network
7. ✅ Procurement manager can answer these questions in <60 seconds:
   - "Which vendor has the highest outstanding?"
   - "What's our spending trend over the last 6 months?"
   - "How many POs are overdue >90 days?"
8. ✅ System runs for 5 consecutive business days without crashes
9. ✅ Documentation is clear enough for team to run locally

---

## 8. ASSUMPTIONS

1. Google Sheets will remain the master data source for foreseeable future
2. Internet connectivity is stable for Google Sheets API access
3. Current data structure in Google Sheets will not change significantly
4. Server environment supports PHP 8.3+ and Composer
5. Procurement team has basic command-line familiarity for installation
6. Dashboard will be hosted on internal server (not public internet)
7. Data volume will not exceed 10,000 PO records in next 12 months
8. Standard web server (Apache/Nginx) is available for deployment

---

## 9. DEPENDENCIES

1. **Google Cloud Platform**: Service account with Sheets API enabled
2. **Google Sheets Access**: Read permissions to procurement master file
3. **PHP Environment**: PHP 8.3+ with required extensions (mbstring, xml, curl, zip)
4. **Composer**: PHP dependency manager
5. **Node.js & NPM**: For asset compilation (TailwindCSS)
6. **Web Server**: Apache or Nginx with mod_rewrite/url_rewrite enabled
7. **Network Access**: Ability to reach Google Sheets API endpoints
8. **Browser Compatibility**: Modern browser with HTMX support (all modern browsers)

---

## 10. RISKS & MITIGATION

| Risk | Impact | Probability | Mitigation |
|------|--------|-------------|------------|
| Google Sheets API rate limits exceeded | High | Medium | Implement Laravel cache, request throttling |
| Data structure changes break dashboard | High | Low | Create data validation layer, document schema |
| HTMX browser compatibility issues | Low | Low | Test on all target browsers, provide fallback |
| Poor adoption due to UI unfamiliarity | Medium | Medium | Conduct user testing early, iterate on design |
| Performance issues with large datasets | Medium | Medium | Implement pagination, lazy loading, Redis cache |
| Google Sheets becomes unavailable | High | Low | Cache last successful data load in database/Redis |
| PHP hosting limitations | Medium | Low | Document minimum server requirements early |

---

**Document Approval:**

| Role | Name | Signature | Date |
|------|------|-----------|------|
| Project Owner | [TBD] | ___________ | ______ |
| Procurement Manager | [TBD] | ___________ | ______ |
| Technical Lead | [TBD] | ___________ | ______ |

---

**Revision History:**

| Version | Date | Author | Changes |
|---------|------|--------|---------|
| 1.0 | 2025-11-16 | System Analyst | Initial requirements document (Reflex/Python) |
| 1.1 | 2025-11-16 | System Analyst | Updated to HTMX + Laravel stack |
