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

    const widgetConfig = {
        id: widgetId,
        w: options.w || template.width,
        h: options.h || template.height,
        x: options.x,
        y: options.y,
        content: template.render(widgetId),
    };

    grid.addWidget(widgetConfig);

    // Animate widget appearance
    setTimeout(() => {
        const widget = document.getElementById(widgetId);
        if (widget) {
            widget.style.opacity = '0';
            widget.style.transform = 'scale(0.9)';
            setTimeout(() => {
                widget.style.transition = 'all 0.2s cubic-bezier(0.4, 0, 0.2, 1)';
                widget.style.opacity = '1';
                widget.style.transform = 'scale(1)';
            }, 10);
        }
    }, 10);
}

// Remove widget function (called from widget close buttons)
window.removeWidget = function (widgetId) {
    if (!grid) return;

    const widget = document.getElementById(widgetId);
    if (widget) {
        widget.style.transition = 'all 0.2s cubic-bezier(0.4, 0, 0.2, 1)';
        widget.style.opacity = '0';
        widget.style.transform = 'scale(0.9)';

        setTimeout(() => {
            const gridItem = widget.closest('.grid-stack-item');
            if (gridItem) {
                grid.removeWidget(gridItem);
            }
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
    const canvas = document.getElementById('canvas-wrapper');
    const zoomDisplay = document.getElementById('zoom-level');

    if (canvas) {
        canvas.style.transform = `scale(${currentZoom})`;
        canvas.style.transformOrigin = 'top left';
    }

    if (zoomDisplay) {
        zoomDisplay.textContent = `${Math.round(currentZoom * 100)}%`;
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    initializeCanvas();

    // Add sample widgets for demo
    setTimeout(() => {
        addWidget('kpi-card', { x: 0, y: 0 });
        addWidget('line-chart', { x: 3, y: 0 });
        addWidget('live-metric', { x: 9, y: 0 });
        addWidget('bar-chart', { x: 0, y: 2 });
        addWidget('status-indicator', { x: 6, y: 2 });
    }, 500);
});
