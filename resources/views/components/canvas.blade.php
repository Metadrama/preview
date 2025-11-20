<!-- Main Canvas Area with Grid -->
<main class="flex-1 overflow-hidden">
    <div id="canvas-wrapper" class="h-full canvas-grid overflow-auto relative" style="transform-origin: top left;">
        <!-- Empty State -->
        <div id="empty-state" class="absolute inset-0 flex items-center justify-center pointer-events-none">
            <div class="text-center">
                <svg class="w-16 h-16 text-slate-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                </svg>
                <h3 class="text-lg font-medium text-slate-400 mb-2">Blank Canvas</h3>
                <p class="text-sm text-slate-500">Drag widgets from the sidebar to get started</p>
            </div>
        </div>

        <!-- GridStack Container -->
        <div class="grid-stack min-h-full" id="grid-canvas">
            <!-- Widgets will be added here dynamically -->
        </div>
    </div>
</main>

<style>
    /* GridStack specific styles */
    .grid-stack {
        position: relative;
    }

    .grid-stack-item {
        position: absolute;
    }

    .grid-stack-item-content {
        position: absolute;
        inset: 0;
    }

    .grid-stack-placeholder {
        background: rgba(14, 165, 233, 0.2) !important;
        border: 2px dashed rgb(14, 165, 233) !important;
        border-radius: 0.5rem;
    }

    /* Resize handles */
    .ui-resizable-handle {
        position: absolute;
        font-size: 0.1px;
        display: block;
        touch-action: none;
    }

    .ui-resizable-se {
        cursor: se-resize;
        width: 12px;
        height: 12px;
        right: 1px;
        bottom: 1px;
    }

    .ui-resizable-se::after {
        content: '';
        position: absolute;
        right: 3px;
        bottom: 3px;
        width: 8px;
        height: 8px;
        border-right: 2px solid rgba(148, 163, 184, 0.5);
        border-bottom: 2px solid rgba(148, 163, 184, 0.5);
    }
</style>
