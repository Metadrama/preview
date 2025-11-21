// Canvas Manager - GridStack Integration
import { GridStack } from 'gridstack';
import 'gridstack/dist/gridstack.min.css';
import { widgetTemplates } from './widget-templates.js';

let grid = null;
let widgetCounter = 0;
let currentZoom = 1.0;

// Initialize GridStack
export function initializeCanvas() {
    const gridElement = document.getElementById('grid-canvas');
    if (!gridElement) return;

    grid = GridStack.init({
        cellHeight: 60,
        margin: 8,
        minRow: 1,
        column: 12,
        animate: true,
        float: false,
        disableOneColumnMode: true,
        acceptWidgets: true,
        removable: false,
    }, gridElement);

    // Make grid globally accessible
    window.grid = grid;

    // Setup drag from sidebar
    setupDragFromSidebar();

    // Setup zoom controls
    setupZoomControls();

    // Hide empty state when widgets are added
    grid.on('added', () => {
        updateEmptyState();
    });

    grid.on('removed', () => {
        updateEmptyState();
    });
}

function updateEmptyState() {
    const emptyState = document.getElementById('empty-state');
    const hasWidgets = grid && grid.getGridItems().length > 0;
    if (emptyState) {
        emptyState.style.display = hasWidgets ? 'none' : 'flex';
    }
}

function setupDragFromSidebar() {
    const widgetTools = document.querySelectorAll('.widget-tool');

    widgetTools.forEach(tool => {
        tool.addEventListener('dragstart', (e) => {
            const widgetType = e.target.closest('.widget-tool').dataset.widgetType;
            const template = widgetTemplates[widgetType];

            if (template) {
                e.dataTransfer.effectAllowed = 'copy';
                e.dataTransfer.setData('text/plain', widgetType);

                // Create custom drag image
                const dragImage = e.target.closest('.widget-tool').cloneNode(true);
                dragImage.style.opacity = '0.8';
                dragImage.style.backgroundColor = '#1e293b';
                dragImage.style.padding = '8px';
                dragImage.style.borderRadius = '8px';
                document.body.appendChild(dragImage);
                e.dataTransfer.setDragImage(dragImage, 0, 0);
                setTimeout(() => dragImage.remove(), 0);
            }
        });
    });

    // Handle drop on canvas
    const canvasWrapper = document.getElementById('canvas-wrapper');
    if (canvasWrapper) {
        canvasWrapper.addEventListener('dragover', (e) => {
            e.preventDefault();
            e.dataTransfer.dropEffect = 'copy';
        });

        canvasWrapper.addEventListener('drop', (e) => {
            e.preventDefault();
            const widgetType = e.dataTransfer.getData('text/plain');
            const template = widgetTemplates[widgetType];

            if (template && grid) {
                addWidget(widgetType);
            }
        });
    }
}

export function addWidget(type, options = {}) {
    const template = widgetTemplates[type];
    if (!template || !grid) return;

    widgetCounter++;
    const widgetId = `widget-${widgetCounter}`;

    // Create widget without content first - GridStack escapes HTML in content
    const widgetConfig = {
        id: widgetId,
        w: options.w || template.width,
        h: options.h || template.height,
        x: options.x,
        y: options.y,
    };

    const addedWidget = grid.addWidget(widgetConfig);

    // CRITICAL FIX: Manually insert HTML using innerHTML after widget creation
    // This prevents GridStack from escaping the HTML as text
    if (addedWidget) {
        const contentElement = addedWidget.querySelector('.grid-stack-item-content');
        if (contentElement) {
            contentElement.innerHTML = template.render(widgetId);
        }
    }

    // Animate widget appearance
    setTimeout(() => {
        if (addedWidget) {
            addedWidget.style.opacity = '0';
            addedWidget.style.transform = 'scale(0.9)';
            setTimeout(() => {
                addedWidget.style.transition = 'all 0.2s cubic-bezier(0.4, 0, 0.2, 1)';
                addedWidget.style.opacity = '1';
                addedWidget.style.transform = 'scale(1)';
            }, 10);
        }
    }, 10);
}

// Remove widget function (called from widget close buttons)
window.removeWidget = function (widgetId) {
    if (!grid) return;

    // Find the grid item containing this widget
    const allItems = grid.getGridItems();
    const targetItem = Array.from(allItems).find(item => {
        const content = item.querySelector('.grid-stack-item-content');
        return content && content.querySelector(`#${widgetId}`);
    });

    if (targetItem) {
        targetItem.style.transition = 'all 0.2s cubic-bezier(0.4, 0, 0.2, 1)';
        targetItem.style.opacity = '0';
        targetItem.style.transform = 'scale(0.9)';

        setTimeout(() => {
            grid.removeWidget(targetItem);
        }, 200);
    }
};

// Zoom Controls
function setupZoomControls() {
    window.adjustZoom = function (delta) {
        currentZoom = Math.min(Math.max(currentZoom + delta, 0.5), 2.0);
        applyZoom();
    };

    window.resetZoom = function () {
        currentZoom = 1.0;
        applyZoom();
    };
}

function applyZoom() {
    const gridCanvas = document.getElementById('grid-canvas');
    const canvasWrapper = document.getElementById('canvas-wrapper');
    const zoomDisplay = document.getElementById('zoom-level');

    if (gridCanvas) {
        // Only scale the grid content, not the wrapper
        gridCanvas.style.transform = `scale(${currentZoom})`;
        gridCanvas.style.transformOrigin = 'top left';

        // Adjust grid width/height to compensate for scaling
        // This ensures the grid expands to fill the viewport when zoomed out
        const scaledWidth = 100 / currentZoom;
        const scaledHeight = 100 / currentZoom;
        gridCanvas.style.width = `${scaledWidth}%`;
        gridCanvas.style.minHeight = `${scaledHeight}%`;
    }

    if (canvasWrapper) {
        // Update grid background size to scale with zoom
        // Base grid size is 20px, scale it inversely with zoom
        const gridSize = 20 / currentZoom;
        canvasWrapper.style.backgroundSize = `${gridSize}px ${gridSize}px`;
    }

    if (zoomDisplay) {
        zoomDisplay.textContent = `${Math.round(currentZoom * 100)}%`;
    }
}

// Scroll-to-Zoom Functionality
function setupScrollToZoom() {
    const canvasWrapper = document.getElementById('canvas-wrapper');
    if (!canvasWrapper) return;

    canvasWrapper.addEventListener('wheel', (e) => {
        // Check if Ctrl key is pressed for zoom
        if (e.ctrlKey || e.metaKey) {
            e.preventDefault();

            // Determine zoom direction
            const delta = -Math.sign(e.deltaY);
            const zoomAmount = delta * 0.05; // 5% per scroll tick

            // Apply zoom
            currentZoom = Math.min(Math.max(currentZoom + zoomAmount, 0.5), 2.0);
            applyZoom();
        }
        // Otherwise allow normal scrolling
    }, { passive: false });
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    initializeCanvas();

    // Initialize scroll-to-zoom
    setupScrollToZoom();

    // Add sample widgets for demo
    setTimeout(() => {
        addWidget('kpi-card', { x: 0, y: 0 });
        addWidget('line-chart', { x: 3, y: 0 });
        addWidget('live-metric', { x: 9, y: 0 });
        addWidget('bar-chart', { x: 0, y: 2 });
        addWidget('status-indicator', { x: 6, y: 2 });
    }, 500);
});
