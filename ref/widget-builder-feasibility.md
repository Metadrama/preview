# Custom Widget Builder - Feasibility Study & Strategy

**Project:** Berapit Mobility Dashboard Enhancement  
**Feature:** User-Created Widget Builder with Drag & Drop + Edit Tools  
**Date:** November 25, 2025  
**Version:** 1.0

---

## Executive Summary

Building a custom widget builder that allows users to create widgets from scratch with drag-and-drop positioning and editing tools is **feasible** for this project. The current codebase already implements 60% of the required infrastructure through GridStack.js integration. The remaining effort focuses on adding widget customization, property editing, and persistence layers.

**Estimated Development Time:**
- **Phase 1 (Basic Customization):** 2-3 weeks
- **Phase 2 (Advanced Editor):** 3-4 weeks  
- **Phase 3 (Polish & Templates):** 1-2 weeks
- **Total MVP:** 6-9 weeks

**Feasibility Score:** 8.5/10 (Highly Feasible)

---

## 1. Current State Analysis

### 1.1 What You Already Have ✅

Your codebase contains significant groundwork:

1. **GridStack.js Integration** (`canvas-manager.js`)
   - ✅ Drag-and-drop from sidebar to canvas
   - ✅ Widget positioning and resizing
   - ✅ Grid-based layout system (80 columns × 20px cell height)
   - ✅ Zoom controls and viewport management
   - ✅ Widget removal functionality

2. **Widget Template System** (`widget-templates.js`)
   - ✅ Structured widget definitions (5 types: KPI Card, Line Chart, Bar Chart, Live Metric, Status)
   - ✅ Templated HTML rendering with parameters
   - ✅ Consistent styling system (Tailwind + custom CSS)
   - ✅ Dynamic content updates (live metrics simulation)

3. **UI Infrastructure**
   - ✅ Glassmorphic design system with theme support
   - ✅ Responsive sidebar with widget toolbox
   - ✅ Tab management for multiple dashboards
   - ✅ Professional navigation and controls

4. **Tech Stack**
   - ✅ Laravel 11 backend (ready for persistence)
   - ✅ Vite build system
   - ✅ Tailwind CSS 4.0
   - ✅ Modern ES6+ JavaScript

### 1.2 What's Missing ❌

To enable user-created widgets from scratch, you need:

1. **Widget Property Editor**
   - Property panel UI (right sidebar or modal)
   - Field editors (text, color, number, dropdown, toggle)
   - Live preview of changes
   - Data source configuration

2. **Widget Creation Flow**
   - "Create Custom Widget" button
   - Widget type selection (KPI, Chart, Text, Image, etc.)
   - Step-by-step wizard or inline editor
   - Template library for common patterns

3. **Persistence Layer**
   - Database schema for custom widgets
   - Save/load dashboard layouts
   - Widget definition storage (JSON)
   - User-specific widget libraries

4. **Advanced Editing Features**
   - Style editor (colors, fonts, borders, spacing)
   - Data binding interface (API endpoints, static data)
   - Conditional formatting rules
   - Copy/paste/duplicate widgets

5. **Widget Element Builder**
   - Component library (text, icon, chart, image, shape)
   - Drag-and-drop within widget canvas
   - Layer management
   - Alignment and distribution tools

---

## 2. Technical Architecture

### 2.1 Component Breakdown

```
┌─────────────────────────────────────────────────────┐
│                  Dashboard Canvas                   │
│  ┌──────────────────────────────────────────────┐  │
│  │        GridStack Layout (Existing)            │  │
│  │  ┌────────┐  ┌────────┐  ┌────────┐         │  │
│  │  │Widget 1│  │Widget 2│  │Widget 3│         │  │
│  │  └────────┘  └────────┘  └────────┘         │  │
│  └──────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────┘
         │                              │
         │                              │
         ▼                              ▼
┌─────────────────────┐      ┌──────────────────────┐
│   Widget Library    │      │  Property Editor     │
│   (Left Sidebar)    │      │  (Right Sidebar)     │
│                     │      │                      │
│ • Pre-built         │      │ • Basic Properties   │
│ • Custom Created    │      │   - Title            │
│ • Templates         │      │   - Size             │
│ • Categories        │      │   - Colors           │
│                     │      │                      │
│ [+ Create Widget]   │      │ • Data Sources       │
└─────────────────────┘      │   - API URL          │
                             │   - Static Data      │
         │                   │   - Refresh Rate     │
         │                   │                      │
         ▼                   │ • Style Editor       │
┌─────────────────────┐      │   - Background       │
│  Widget Builder     │      │   - Border           │
│     (Modal)         │      │   - Typography       │
│                     │      │                      │
│ ┌─────────────────┐ │      │ • Advanced           │
│ │ Canvas          │ │      │   - Conditional      │
│ │                 │ │      │   - Animations       │
│ │  [Text][Icon]   │ │      │   - Interactions     │
│ │  [Chart][Image] │ │      └──────────────────────┘
│ │                 │ │
│ └─────────────────┘ │
│                     │
│ Component Library:  │
│ [Text] [Number]     │
│ [Icon] [Chart]      │
│ [Image] [Shape]     │
└─────────────────────┘
```

### 2.2 Data Model

```javascript
// Custom Widget Definition Schema
{
  id: "widget-12345",
  type: "custom", // vs "template"
  name: "Sales Performance Card",
  createdBy: "user-id",
  createdAt: "2025-11-25T10:00:00Z",
  
  // Layout on canvas
  layout: {
    x: 0,
    y: 0,
    w: 20,
    h: 6,
    minW: 10,
    minH: 4,
    maxW: 40,
    maxH: 20
  },
  
  // Widget structure
  elements: [
    {
      id: "el-1",
      type: "text",
      content: "{{data.title}}",
      style: {
        fontSize: "24px",
        fontWeight: "bold",
        color: "#0ea5e9",
        position: { x: 10, y: 10 }
      }
    },
    {
      id: "el-2",
      type: "number",
      value: "{{data.value}}",
      format: "currency",
      style: {
        fontSize: "48px",
        color: "#22c55e",
        position: { x: 10, y: 50 }
      }
    },
    {
      id: "el-3",
      type: "chart",
      chartType: "line",
      data: "{{data.trend}}",
      options: {
        showGrid: false,
        color: "#3b82f6"
      },
      style: {
        position: { x: 0, y: 100 },
        width: "100%",
        height: 100
      }
    }
  ],
  
  // Data configuration
  dataSource: {
    type: "api", // or "static", "google-sheets"
    endpoint: "/api/widgets/sales-data",
    refreshInterval: 30000, // ms
    method: "GET",
    headers: {},
    transform: "data => ({ title: data.metric, value: data.total })"
  },
  
  // Widget container styling
  style: {
    background: "linear-gradient(145deg, rgba(40, 50, 70, 0.4), rgba(30, 41, 59, 0.4))",
    border: "1px solid rgba(255, 255, 255, 0.05)",
    borderRadius: "12px",
    padding: "16px"
  }
}
```

### 2.3 Technology Stack Recommendations

| Layer | Current | Enhancement | Rationale |
|-------|---------|-------------|-----------|
| **Layout Engine** | GridStack.js 12.3.3 | Keep | Proven, mature, handles drag-drop |
| **Property Editor** | None | Custom Vue 3 components | Lightweight, reactive, Laravel-friendly |
| **Widget Builder** | None | GrapesJS (embedded) OR Custom | GrapesJS = fast but opinionated; Custom = full control |
| **Chart Library** | SVG (hardcoded) | Chart.js or Apache ECharts | Industry standard, rich features |
| **Data Layer** | None | Laravel Eloquent + JSON columns | PostgreSQL JSONB or MySQL JSON |
| **Icon Library** | Inline SVG | Lucide (already in package.json) | 1000+ icons, tree-shakeable |
| **Color Picker** | None | Vanilla Picker or Pickr | No jQuery, small footprint |

---

## 3. Implementation Strategy

### 3.1 Phased Approach

#### **Phase 1: Foundation (Week 1-3)**

**Goal:** Enable basic widget customization without full builder UI

**Deliverables:**
1. ✅ Property editor panel (right sidebar)
   - Title, subtitle editing
   - Color picker (background, text, accent)
   - Size presets (small, medium, large)
   
2. ✅ Extended widget template system
   - Add `config` parameter to templates
   - Dynamic color/text injection
   - Template variants (e.g., KPI with/without trend)

3. ✅ Database schema
   ```sql
   CREATE TABLE dashboard_layouts (
     id BIGINT PRIMARY KEY,
     user_id BIGINT,
     name VARCHAR(255),
     widgets JSON, -- GridStack serialization
     created_at TIMESTAMP,
     updated_at TIMESTAMP
   );
   
   CREATE TABLE custom_widgets (
     id BIGINT PRIMARY KEY,
     user_id BIGINT,
     name VARCHAR(255),
     definition JSON, -- Widget schema
     thumbnail TEXT, -- Base64 or URL
     category VARCHAR(100),
     is_public BOOLEAN DEFAULT FALSE,
     created_at TIMESTAMP
   );
   ```

4. ✅ Save/Load functionality
   - "Save Dashboard" button → stores GridStack state + widget configs
   - "Load Dashboard" dropdown → restores from DB
   - Auto-save every 30 seconds

**Tech Stack:**
- Laravel controllers for CRUD
- Alpine.js for property panel (already Alpine-friendly)
- LocalStorage as fallback

**Code Example:**
```javascript
// Enhanced widget template with config support
'kpi-card': {
  title: 'KPI Card',
  width: 20,
  height: 6,
  configurable: true,
  defaultConfig: {
    title: 'Total Revenue',
    valueColor: '#0ea5e9',
    trendColor: '#22c55e',
    backgroundColor: 'rgba(40, 50, 70, 0.4)'
  },
  render: (id, config = {}) => {
    const cfg = { ...defaultConfig, ...config };
    return `
      <div class="widget-card h-full" 
           style="background: ${cfg.backgroundColor}">
        <div class="text-xs">${cfg.title}</div>
        <div class="text-4xl" style="color: ${cfg.valueColor}">
          ${cfg.value || 'RM 0'}
        </div>
      </div>
    `;
  }
}
```

---

#### **Phase 2: Widget Builder UI (Week 4-6)**

**Goal:** Allow users to create custom widgets with visual editor

**Deliverables:**
1. ✅ Widget Builder Modal
   - Canvas area (300×200px preview)
   - Component palette (Text, Number, Icon, Chart, Image)
   - Drag-and-drop elements onto canvas
   - Property inspector (per-element styling)

2. ✅ Component Library
   ```javascript
   const builderComponents = {
     text: { icon: 'Type', defaultStyle: { fontSize: 14 } },
     number: { icon: 'Hash', format: ['decimal', 'currency', 'percent'] },
     icon: { icon: 'Smile', library: 'lucide' },
     chart: { icon: 'BarChart', types: ['line', 'bar', 'pie', 'donut'] },
     image: { icon: 'Image', upload: true },
     shape: { icon: 'Square', types: ['rectangle', 'circle', 'line'] }
   };
   ```

3. ✅ Data Binding Interface
   - "Add Data Source" button
   - API endpoint configuration
   - Static data input (JSON editor)
   - Variable mapping: `{{data.revenue}}` → element

4. ✅ Template Gallery
   - Save custom widgets as reusable templates
   - Community templates (if multi-user)
   - Duplicate existing widgets

**Tech Stack:**
- Vue 3 for builder modal (isolated from main app)
- Interact.js for element dragging within widget
- Monaco Editor for JSON/code editing

**UI Flow:**
```
User clicks "Create Custom Widget" 
  → Modal opens with blank canvas
  → Drag "Text" component onto canvas
  → Click text → Properties panel appears
    - Edit: "Sales Today"
    - Font size: 16px
    - Color: #ffffff
  → Drag "Number" component
    - Bind to: {{data.sales}}
    - Format: Currency (MYR)
  → Drag "Chart" component
    - Type: Line
    - Data: {{data.trend}}
  → Click "Save Widget"
    - Name: "Sales Dashboard Card"
    - Category: Custom
  → Widget appears in left sidebar
  → Drag to canvas like pre-built widgets
```

---

#### **Phase 3: Advanced Features (Week 7-9)**

**Goal:** Professional-grade widget builder with advanced capabilities

**Deliverables:**
1. ✅ Style Editor
   - Visual CSS editor (borders, shadows, gradients)
   - Spacing controls (padding, margin)
   - Animation presets (fade, slide, bounce)
   
2. ✅ Conditional Formatting
   ```javascript
   rules: [
     {
       condition: "data.value > 1000",
       style: { color: "#22c55e" } // green if > 1000
     },
     {
       condition: "data.value < 0",
       style: { color: "#ef4444" } // red if negative
     }
   ]
   ```

3. ✅ Advanced Data Features
   - Multiple data sources per widget
   - Data transformations (filters, aggregations)
   - Real-time WebSocket support
   - Caching strategies

4. ✅ Collaboration Features
   - Share custom widgets with team
   - Version history
   - Comments/annotations
   - Widget marketplace (internal)

5. ✅ Import/Export
   - Export widget as JSON
   - Import from file
   - Dashboard templates (entire layout)

**Tech Stack:**
- CodeMirror for formula editor
- Day.js for date handling
- Socket.io for real-time (if needed)

---

### 3.2 Alternative Approach: Integrate Existing Framework

Instead of building from scratch, integrate a mature framework:

#### **Option A: GrapesJS (Recommended for Speed)**

**Pros:**
- ✅ Battle-tested, 17k+ GitHub stars
- ✅ Plugin ecosystem (charts, forms, countdowns)
- ✅ Visual HTML/CSS editor built-in
- ✅ Asset manager included
- ✅ Responsive design tools
- ✅ 2-week implementation vs 6-9 weeks custom

**Cons:**
- ❌ Designed for full pages, not small widgets
- ❌ Learning curve for customization
- ❌ May feel "heavy" for simple widgets
- ❌ Harder to match your glassmorphic aesthetic

**Integration Complexity:** Medium  
**Time Savings:** ~4-5 weeks

**Implementation:**
```bash
npm install grapesjs grapesjs-preset-webpage
```

```javascript
// Create widget builder modal with GrapesJS
const editor = grapesjs.init({
  container: '#widget-builder-modal',
  width: '800px',
  height: '600px',
  plugins: ['gjs-preset-webpage', 'grapesjs-charts'],
  storageManager: false, // Use Laravel backend instead
  canvas: {
    styles: ['/css/app.css'], // Your Tailwind styles
  }
});

// Save widget definition
editor.on('component:update', () => {
  const html = editor.getHtml();
  const css = editor.getCss();
  saveWidget({ html, css }); // Laravel endpoint
});
```

---

#### **Option B: Craft.js (Best for React Fans)**

**Pros:**
- ✅ React-based (modern, component-driven)
- ✅ Full control over UI/UX
- ✅ Excellent TypeScript support
- ✅ Perfect for custom widget builders
- ✅ Smaller bundle size

**Cons:**
- ❌ Requires React (not currently in stack)
- ❌ More code to write vs GrapesJS
- ❌ Mixing React + Laravel Blade = complex

**Integration Complexity:** High (requires React setup)  
**Time Savings:** ~2 weeks

**Verdict:** Only if you're willing to introduce React

---

#### **Option C: Custom Builder (Full Control)**

**Pros:**
- ✅ Perfect fit for your Laravel/Vite/Tailwind stack
- ✅ Exactly matches your design system
- ✅ No external dependencies
- ✅ Learning opportunity

**Cons:**
- ❌ Longest development time (6-9 weeks)
- ❌ More testing/bug fixing
- ❌ Need to solve solved problems

**Verdict:** Best long-term investment if you have time

---

## 4. Risk Assessment

| Risk | Probability | Impact | Mitigation |
|------|-------------|--------|------------|
| **Scope Creep** | High | High | Strictly follow phased approach; resist feature requests |
| **Performance Issues** | Medium | High | Limit max widgets per dashboard (20); lazy-load charts |
| **User Adoption** | Medium | Medium | Provide rich template library; onboarding wizard |
| **Data Security** | Low | Critical | Validate all user inputs; sanitize HTML; API auth |
| **Browser Compatibility** | Low | Medium | Test on Chrome, Edge, Firefox, Safari |
| **Complex Widgets Break Layout** | Medium | Medium | Widget size validation; max element limits |
| **State Management Chaos** | High | High | Use Vuex or Pinia for builder state; clear documentation |

---

## 5. Resource Requirements

### 5.1 Development Team

**Minimum:**
- 1 Full-stack Developer (Laravel + JavaScript) – 6-9 weeks full-time

**Optimal:**
- 1 Backend Developer (Laravel, API design) – 3 weeks
- 1 Frontend Developer (Vue/Vanilla JS, CSS) – 4 weeks  
- 1 UI/UX Designer (wireframes, prototypes) – 1 week
- 1 QA Tester (manual + automated) – 2 weeks

### 5.2 Infrastructure

**Required:**
- Database: PostgreSQL 14+ (for JSONB) OR MySQL 8+ (for JSON columns)
- Cache: Redis (for widget data caching)
- Storage: S3 or local (for widget thumbnails, uploaded images)
- CDN: Optional (for faster asset delivery)

**Estimated Costs:**
- Development: $15,000 - $30,000 (contractor rates)
- Infrastructure: $50-100/month (AWS/DigitalOcean)

---

## 6. Competitive Analysis

### How Others Do It

| Platform | Approach | Widget Editor | Complexity |
|----------|----------|---------------|------------|
| **Tableau** | Drag-drop charts from data fields | Visual query builder | High |
| **Power BI** | Visualization pane with properties | Field mapping | Medium |
| **Google Data Studio** | Pre-built components + styling | Property panel | Medium |
| **Grafana** | JSON config + UI panels | Query editor + visual | High |
| **Klipfolio** | Drag-drop + formula editor | Data source wizard | High |
| **Metabase** | Question-based, no custom widgets | SQL + visualization | Low |

**Your Niche:** Simpler than Tableau, more flexible than Metabase

---

## 7. Feasibility Verdict

### ✅ Feasible: Here's Why

1. **Strong Foundation:** You're 60% there with GridStack integration
2. **Modern Stack:** Laravel + Vite + Tailwind = solid base
3. **Clear Requirements:** Procurement dashboard has defined widget needs
4. **Incremental Path:** Can ship Phase 1 in 3 weeks, iterate based on feedback
5. **Proven Libraries:** GridStack, Chart.js, GrapesJS are mature solutions

### ⚠️ Challenges to Manage

1. **Time Investment:** 6-9 weeks is significant for one developer
2. **User Education:** Custom builder = learning curve for procurement team
3. **Maintenance Burden:** More code = more bugs to fix
4. **Over-Engineering Risk:** Do users really need full builder, or just color/text changes?

---

## 8. Recommendations

### 8.1 Recommended Path: Hybrid Approach

**Phase 1: Enhanced Templates (3 weeks)**
- Add property editor for pre-built widgets
- Let users customize colors, titles, data sources
- Save/load dashboards
- **Result:** 80% of value, 30% of effort

**Phase 2A: Evaluate Demand (1 week)**
- Ship Phase 1 to users
- Gather feedback: Do they want full builder?
- If yes → Phase 2B; If no → iterate on templates

**Phase 2B: Full Builder OR GrapesJS (4-5 weeks)**
- If users need custom layouts → Build widget builder
- If users want rich editing → Integrate GrapesJS
- **Result:** Data-driven decision

### 8.2 MVP Feature Set (Must-Have)

**For Phase 1 Launch:**
- ✅ 10 pre-built widget templates (you have 5)
- ✅ Property editor: title, colors, data source
- ✅ Save/load dashboards (per user)
- ✅ Duplicate widgets
- ✅ Resize & reposition (already works)

**Can Wait for Phase 2:**
- ⏸️ Custom widget builder modal
- ⏸️ Drag-drop elements within widget
- ⏸️ Conditional formatting
- ⏸️ Widget marketplace

---

## 9. Next Steps

### Immediate Actions (Week 1)

1. **Decision Point:** Full builder vs Enhanced templates?
   - Meet with stakeholders (procurement team)
   - Demo current dashboard
   - Show mockups of both approaches

2. **Technical Preparation:**
   - Set up database migrations (dashboard_layouts, custom_widgets)
   - Create Laravel API routes (/api/dashboards, /api/widgets)
   - Scaffold property editor UI (Alpine.js or Vue)

3. **Design Work:**
   - Wireframe property editor panel
   - Design widget builder modal (if approved)
   - Create component palette icons

### Development Roadmap

**Week 1-2:** Backend + Database
- Eloquent models for dashboards & widgets
- RESTful API endpoints
- JSON schema validation

**Week 3-4:** Property Editor
- Right sidebar panel
- Form controls (color picker, text inputs)
- Live preview updates
- Save functionality

**Week 5-6:** Widget Builder Modal (if approved)
- Canvas area with drag-drop
- Component palette
- Element property inspector

**Week 7-8:** Polish & Testing
- Cross-browser testing
- Performance optimization
- Documentation
- User training

**Week 9:** Launch
- Deploy to production
- Monitor for bugs
- Gather feedback

---

## 10. Success Metrics

Track these KPIs post-launch:

**Adoption:**
- % of users who customize widgets (target: 60%+)
- Average # of custom widgets per user (target: 3+)
- Dashboard save frequency (target: 2x/week)

**Engagement:**
- Time spent in widget editor (target: <5 min per widget)
- # of dashboards created (target: 50+ in first month)
- Feature usage heatmap (which properties edited most)

**Quality:**
- Bug reports per week (target: <5)
- User satisfaction score (target: 4/5)
- Support tickets related to builder (target: <10% of total)

---

## 11. Conclusion

**Building a custom widget builder is feasible and strategically sound** for your Laravel dashboard project. The existing GridStack foundation provides 60% of the needed functionality. By following a phased approach—starting with enhanced templates before committing to a full visual builder—you can deliver value quickly while managing risk.

**Recommended immediate actions:**
1. ✅ Implement Phase 1 (Enhanced Templates) in 3 weeks
2. ✅ Validate user demand before building full editor
3. ✅ Consider GrapesJS integration if speed is priority
4. ✅ Allocate 6-9 weeks for full custom builder if needed

**Key Success Factor:** Start small, ship fast, iterate based on real user feedback. The procurement team may be perfectly happy with configurable templates—no need to over-engineer unless proven necessary.

---

**Document Prepared By:** GitHub Copilot  
**Review Status:** Draft  
**Next Review Date:** Post Phase 1 User Testing  

---

## Appendix A: Code Samples

### A.1 Enhanced Widget Template with Config

```javascript
// widget-templates-v2.js
export const widgetTemplates = {
  'kpi-card': {
    title: 'KPI Card',
    category: 'metrics',
    width: 20,
    height: 6,
    configurable: true,
    
    // Default configuration schema
    config: {
      title: { type: 'text', label: 'Title', default: 'Total Revenue' },
      subtitle: { type: 'text', label: 'Subtitle', default: 'Year to Date' },
      value: { type: 'number', label: 'Value', default: 245800 },
      format: { type: 'select', label: 'Format', options: ['currency', 'number', 'percent'], default: 'currency' },
      trend: { type: 'number', label: 'Trend %', default: 12.5 },
      trendDirection: { type: 'select', label: 'Trend', options: ['up', 'down', 'neutral'], default: 'up' },
      valueColor: { type: 'color', label: 'Value Color', default: '#0ea5e9' },
      trendColor: { type: 'color', label: 'Trend Color', default: '#22c55e' },
      bgColor: { type: 'color', label: 'Background', default: 'rgba(40, 50, 70, 0.4)' }
    },
    
    render: (id, userConfig = {}) => {
      // Merge user config with defaults
      const cfg = Object.keys(widgetTemplates['kpi-card'].config).reduce((acc, key) => {
        acc[key] = userConfig[key] ?? widgetTemplates['kpi-card'].config[key].default;
        return acc;
      }, {});
      
      // Format value based on type
      const formattedValue = formatValue(cfg.value, cfg.format);
      
      // Trend icon
      const trendIcon = cfg.trendDirection === 'up' 
        ? '<path d="M5 10l7-7m0 0l7 7m-7-7v18" />'
        : '<path d="M19 14l-7 7m0 0l-7-7m7 7V3" />';
      
      return `
        <div class="widget-card h-full group relative" 
             style="background: ${cfg.bgColor}"
             data-widget-id="${id}">
          <button onclick="editWidget('${id}')" 
                  class="absolute top-2 right-8 opacity-0 group-hover:opacity-100 text-slate-500 hover:text-sky-400 transition-snappy z-10 p-1 rounded hover:bg-white/5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
          </button>
          <button onclick="removeWidget('${id}')" 
                  class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 text-slate-500 hover:text-red-400 transition-snappy z-10 p-1 rounded hover:bg-white/5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
          <div class="p-6 flex flex-col justify-center h-full">
            <div class="text-xs font-medium text-slate-400 mb-1 uppercase tracking-wider">${cfg.title}</div>
            <div class="text-sm text-slate-500 mb-2">${cfg.subtitle}</div>
            <div class="text-4xl font-bold mb-2" style="color: ${cfg.valueColor}">${formattedValue}</div>
            <div class="flex items-center gap-2 text-sm">
              <span class="flex items-center gap-1" style="color: ${cfg.trendColor}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  ${trendIcon}
                </svg>
                ${cfg.trend}%
              </span>
              <span class="text-slate-500">vs last period</span>
            </div>
          </div>
        </div>
      `;
    }
  }
};

function formatValue(value, format) {
  switch(format) {
    case 'currency': return `RM ${(value/1000).toFixed(1)}K`;
    case 'percent': return `${value.toFixed(1)}%`;
    default: return value.toLocaleString();
  }
}
```

### A.2 Property Editor Component (Alpine.js)

```html
<!-- resources/views/components/property-editor.blade.php -->
<div x-data="propertyEditor()" 
     x-show="$store.editor.activeWidget" 
     class="fixed right-6 top-20 bottom-24 w-80 glass border theme-border rounded-2xl p-4 overflow-y-auto z-50">
  
  <div class="flex items-center justify-between mb-4">
    <h3 class="font-semibold text-lg theme-strong-text">Properties</h3>
    <button @click="closeEditor()" class="theme-icon-button p-1.5 rounded-lg">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
  </div>

  <!-- Widget Name -->
  <div class="mb-4">
    <label class="block text-xs font-medium theme-muted-text mb-2">Widget Name</label>
    <input type="text" 
           x-model="widgetConfig.name" 
           @input="updateWidget()"
           class="w-full px-3 py-2 glass border theme-border rounded-lg theme-strong-text">
  </div>

  <!-- Dynamic Fields Based on Widget Type -->
  <template x-for="(field, key) in widgetSchema" :key="key">
    <div class="mb-4">
      <label class="block text-xs font-medium theme-muted-text mb-2" x-text="field.label"></label>
      
      <!-- Text Input -->
      <template x-if="field.type === 'text'">
        <input type="text" 
               x-model="widgetConfig[key]" 
               @input="updateWidget()"
               class="w-full px-3 py-2 glass border theme-border rounded-lg theme-strong-text">
      </template>

      <!-- Number Input -->
      <template x-if="field.type === 'number'">
        <input type="number" 
               x-model="widgetConfig[key]" 
               @input="updateWidget()"
               class="w-full px-3 py-2 glass border theme-border rounded-lg theme-strong-text">
      </template>

      <!-- Color Picker -->
      <template x-if="field.type === 'color'">
        <div class="flex gap-2">
          <input type="color" 
                 x-model="widgetConfig[key]" 
                 @input="updateWidget()"
                 class="w-12 h-10 rounded cursor-pointer">
          <input type="text" 
                 x-model="widgetConfig[key]" 
                 @input="updateWidget()"
                 class="flex-1 px-3 py-2 glass border theme-border rounded-lg theme-strong-text font-mono text-sm">
        </div>
      </template>

      <!-- Select Dropdown -->
      <template x-if="field.type === 'select'">
        <select x-model="widgetConfig[key]" 
                @change="updateWidget()"
                class="w-full px-3 py-2 glass border theme-border rounded-lg theme-strong-text">
          <template x-for="option in field.options" :key="option">
            <option :value="option" x-text="option"></option>
          </template>
        </select>
      </template>
    </div>
  </template>

  <!-- Save Button -->
  <button @click="saveWidget()" 
          class="w-full py-2 bg-sky-500 hover:bg-sky-600 text-white rounded-lg font-medium transition-smooth">
    Save Changes
  </button>
</div>

<script>
function propertyEditor() {
  return {
    widgetConfig: {},
    widgetSchema: {},
    
    init() {
      // Load widget config when editor opens
      this.$watch('$store.editor.activeWidget', (widgetId) => {
        if (widgetId) {
          this.loadWidget(widgetId);
        }
      });
    },
    
    loadWidget(widgetId) {
      const widget = window.grid.getGridItems().find(item => 
        item.querySelector(`[data-widget-id="${widgetId}"]`)
      );
      
      if (widget) {
        const widgetType = widget.dataset.widgetType;
        const template = widgetTemplates[widgetType];
        
        // Load schema and current values
        this.widgetSchema = template.config;
        this.widgetConfig = JSON.parse(widget.dataset.widgetConfig || '{}');
      }
    },
    
    updateWidget() {
      // Live preview: re-render widget with new config
      const widgetId = this.$store.editor.activeWidget;
      const widget = window.grid.getGridItems().find(item => 
        item.querySelector(`[data-widget-id="${widgetId}"]`)
      );
      
      if (widget) {
        const widgetType = widget.dataset.widgetType;
        const template = widgetTemplates[widgetType];
        const content = widget.querySelector('.grid-stack-item-content');
        content.innerHTML = template.render(widgetId, this.widgetConfig);
        widget.dataset.widgetConfig = JSON.stringify(this.widgetConfig);
      }
    },
    
    saveWidget() {
      // Persist to backend
      fetch('/api/widgets/update', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          widget_id: this.$store.editor.activeWidget,
          config: this.widgetConfig
        })
      }).then(() => {
        this.closeEditor();
        alert('Widget saved!');
      });
    },
    
    closeEditor() {
      this.$store.editor.activeWidget = null;
    }
  }
}
</script>
```

### A.3 Laravel API Controller

```php
<?php
// app/Http/Controllers/Api/DashboardController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DashboardLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    /**
     * Save dashboard layout
     */
    public function saveLayout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'widgets' => 'required|array',
            'widgets.*.id' => 'required|string',
            'widgets.*.type' => 'required|string',
            'widgets.*.x' => 'required|integer',
            'widgets.*.y' => 'required|integer',
            'widgets.*.w' => 'required|integer',
            'widgets.*.h' => 'required|integer',
            'widgets.*.config' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $layout = DashboardLayout::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'name' => $request->name
            ],
            [
                'widgets' => $request->widgets,
            ]
        );

        return response()->json([
            'message' => 'Dashboard saved successfully',
            'layout' => $layout
        ], 200);
    }

    /**
     * Load dashboard layout
     */
    public function loadLayout($id)
    {
        $layout = DashboardLayout::where('user_id', auth()->id())
            ->findOrFail($id);

        return response()->json([
            'layout' => $layout
        ], 200);
    }

    /**
     * List all user dashboards
     */
    public function listLayouts()
    {
        $layouts = DashboardLayout::where('user_id', auth()->id())
            ->orderBy('updated_at', 'desc')
            ->get(['id', 'name', 'updated_at']);

        return response()->json([
            'layouts' => $layouts
        ], 200);
    }

    /**
     * Delete dashboard
     */
    public function deleteLayout($id)
    {
        DashboardLayout::where('user_id', auth()->id())
            ->findOrFail($id)
            ->delete();

        return response()->json([
            'message' => 'Dashboard deleted successfully'
        ], 200);
    }
}
```

### A.4 Database Migration

```php
<?php
// database/migrations/2025_11_25_000001_create_dashboard_layouts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dashboard_layouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->json('widgets'); // GridStack widget array
            $table->timestamps();
            
            $table->index(['user_id', 'name']);
        });

        Schema::create('custom_widgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('category')->default('custom');
            $table->json('definition'); // Widget schema
            $table->text('thumbnail')->nullable();
            $table->boolean('is_public')->default(false);
            $table->timestamps();
            
            $table->index(['user_id', 'category']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_widgets');
        Schema::dropIfExists('dashboard_layouts');
    }
};
```

---

## Appendix B: Wireframes

### B.1 Property Editor Panel

```
┌─────────────────────────┐
│ Properties          [X] │
├─────────────────────────┤
│                         │
│ Widget Name             │
│ ┌─────────────────────┐ │
│ │ Sales Performance   │ │
│ └─────────────────────┘ │
│                         │
│ Title                   │
│ ┌─────────────────────┐ │
│ │ Total Revenue       │ │
│ └─────────────────────┘ │
│                         │
│ Value Color             │
│ ┌──┐ ┌───────────────┐ │
│ │██│ │ #0ea5e9       │ │
│ └──┘ └───────────────┘ │
│                         │
│ Trend Color             │
│ ┌──┐ ┌───────────────┐ │
│ │██│ │ #22c55e       │ │
│ └──┘ └───────────────┘ │
│                         │
│ Background              │
│ ┌──┐ ┌───────────────┐ │
│ │██│ │ rgba(40...)   │ │
│ └──┘ └───────────────┘ │
│                         │
│ Format                  │
│ ┌─────────────────────┐ │
│ │ Currency (MYR)   ▼ │ │
│ └─────────────────────┘ │
│                         │
│ ┌─────────────────────┐ │
│ │   Save Changes      │ │
│ └─────────────────────┘ │
└─────────────────────────┘
```

### B.2 Widget Builder Modal

```
┌──────────────────────────────────────────────────────────┐
│ Create Custom Widget                              [X]    │
├────────────┬───────────────────────────────┬─────────────┤
│            │                               │             │
│ Components │         Canvas                │ Properties  │
│            │                               │             │
│ ┌────────┐ │  ┌───────────────────────┐   │ Element:    │
│ │ [T] Te││ │  │ Sales Today           │   │ Text        │
│ │ xt     │ │  │                       │   │             │
│ └────────┘ │  │     RM 125,450        │   │ Content:    │
│            │  │                       │   │ ┌─────────┐ │
│ ┌────────┐ │  │  ▁▂▃▅▇ (chart)       │   │ │Sales... │ │
│ │ [#] Nu││ │  │                       │   │ └─────────┘ │
│ │ mber   │ │  └───────────────────────┘   │             │
│ └────────┘ │                               │ Font Size:  │
│            │                               │ ┌─────────┐ │
│ ┌────────┐ │                               │ │ 24px    │ │
│ │ [📊] Ch││ │                               │ └─────────┘ │
│ │ art    │ │                               │             │
│ └────────┘ │                               │ Color:      │
│            │                               │ ┌──┐ ┌────┐ │
│ ┌────────┐ │                               │ │██│ │... │ │
│ │ [🎨] Ic││ │                               │ └──┘ └────┘ │
│ │ on     │ │                               │             │
│ └────────┘ │                               │             │
└────────────┴───────────────────────────────┴─────────────┘
                    ┌──────┐  ┌──────┐
                    │Cancel│  │ Save │
                    └──────┘  └──────┘
```

---

**End of Document**
