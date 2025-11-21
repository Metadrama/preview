<!-- Modern Canvas Area with Infinite Grid -->
<main class="flex-1 overflow-hidden">
    <div id="canvas-wrapper" class="h-full canvas-grid overflow-auto relative">
        <!-- Empty State -->
        <div id="empty-state" class="absolute inset-0 flex items-center justify-center pointer-events-none z-10">
            <div class="text-center animate-fade-in">
                <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-primary/10 to-secondary/10 flex items-center justify-center">
                    <svg class="w-10 h-10 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-slate-400 mb-2">Blank Canvas</h3>
                <p class="text-sm text-slate-500">Drag widgets from the sidebar to get started</p>
                <p class="text-xs text-slate-600 mt-2">Tip: Use Ctrl+Scroll to zoom</p>
            </div>
        </div>

        <!-- GridStack Container - This is what gets scaled -->
        <div class="grid-stack min-h-full" id="grid-canvas" style="width: 100%; min-height: 100%;">
            <!-- Widgets will be added here dynamically -->
        </div>
    </div>
</main>

<style>
    /* GridStack specific styles */
    .grid-stack {
        position: relative;
        transform-origin: top left;
    }

    .grid-stack-item {
        position: absolute;
    }

    .grid-stack-item-content {
        position: absolute;
        inset: 0;
    }

    .grid-stack-placeholder {
        background: rgba(14, 165, 233, 0.15) !important;
        border: 2px dashed rgba(14, 165, 233, 0.5) !important;
        border-radius: 12px !important;
        box-shadow: 0 0 20px rgba(14, 165, 233, 0.2) !important;
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
        width: 16px;
        height: 16px;
        right: 2px;
        bottom: 2px;
    }

    .ui-resizable-se::after {
        content: '';
        position: absolute;
        right: 4px;
        bottom: 4px;
        width: 10px;
        height: 10px;
        border-right: 2px solid rgba(148, 163, 184, 0.4);
        border-bottom: 2px solid rgba(148, 163, 184, 0.4);
        border-radius: 0 0 2px 0;
        transition: all 0.2s ease;
    }

    .ui-resizable-se:hover::after {
        border-right-color: rgba(14, 165, 233, 0.8);
        border-bottom-color: rgba(14, 165, 233, 0.8);
    }

    /* Ensure canvas wrapper fills and scrolls properly */
    #canvas-wrapper {
        position: relative;
    }

    /* Grid canvas scales but maintains infinite background */
    #grid-canvas {
        will-change: transform;
        transition: transform 0.1s ease-out;
    }
</style>
