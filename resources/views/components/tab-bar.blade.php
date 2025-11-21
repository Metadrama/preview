<!-- Modern Glassmorphic Tab Bar -->
<div class="glass fixed bottom-6 left-1/2 -translate-x-1/2 z-50 h-14 max-w-[90vw] flex items-center gap-4 px-4 rounded-2xl shadow-refined-lg border theme-border overflow-x-auto">
    <div class="flex items-center h-full" id="tab-container">
        <!-- Tabs will be rendered here -->
        <div class="tab tab-active flex items-center gap-2 px-4 h-full border-r theme-border-soft cursor-pointer group" data-tab-id="1">
            <span class="text-sm font-medium">Dashboard 1</span>
            <button class="ml-1 opacity-0 group-hover:opacity-100 theme-icon-button transition-smooth p-0.5 rounded" onclick="closeTab(event, '1')">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex items-center gap-2 ml-auto pr-3">
        <button onclick="createNewTab()" class="btn-glass flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium theme-muted-text rounded-lg" title="New Tab">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>New</span>
        </button>
        <div class="w-px h-5 theme-separator"></div>
        <button onclick="savePreset()" class="btn-glass flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium theme-muted-text rounded-lg" title="Save Preset">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
            </svg>
            <span>Save</span>
        </button>
        <button onclick="loadPreset()" class="btn-glass flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium theme-muted-text rounded-lg" title="Load Preset">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
            </svg>
            <span>Load</span>
        </button>
    </div>
</div>

<script>
    let tabCounter = 1;
    let activeTabId = '1';

    function createNewTab() {
        tabCounter++;
        const tabId = String(tabCounter);
        const container = document.getElementById('tab-container');
        
        // Deactivate all tabs
        container.querySelectorAll('.tab').forEach(tab => {
            tab.classList.remove('tab-active');
            tab.classList.add('tab-inactive');
        });

        const newTab = document.createElement('div');
        newTab.className = 'tab tab-active flex items-center gap-2 px-4 h-full border-r theme-border-soft cursor-pointer group';
        newTab.dataset.tabId = tabId;
        newTab.innerHTML = `
            <span class="text-sm font-medium">Dashboard ${tabCounter}</span>
            <button class="ml-1 opacity-0 group-hover:opacity-100 theme-icon-button transition-smooth p-0.5 rounded" onclick="closeTab(event, '${tabId}')">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        `;
        
        newTab.addEventListener('click', (e) => {
            if (!e.target.closest('button')) {
                switchTab(tabId);
            }
        });

        container.appendChild(newTab);
        activeTabId = tabId;
        
        // Clear canvas for new tab
        if (window.grid) {
            window.grid.removeAll();
        }
    }

    function switchTab(tabId) {
        activeTabId = tabId;
        document.querySelectorAll('.tab').forEach(tab => {
            if (tab.dataset.tabId === tabId) {
                tab.classList.add('tab-active');
                tab.classList.remove('tab-inactive');
            } else {
                tab.classList.remove('tab-active');
                tab.classList.add('tab-inactive');
            }
        });
        // Load tab's widgets (functionality to be implemented)
    }

    function closeTab(event, tabId) {
        event.stopPropagation();
        const tabs = document.querySelectorAll('.tab');
        if (tabs.length <= 1) {
            alert('Cannot close the last tab');
            return;
        }

        const tabElement = document.querySelector(`.tab[data-tab-id="${tabId}"]`);
        if (tabElement) {
            tabElement.remove();
            
            // If closing active tab, activate another
            if (activeTabId === tabId) {
                const remainingTabs = document.querySelectorAll('.tab');
                if (remainingTabs.length > 0) {
                    const firstTab = remainingTabs[0];
                    switchTab(firstTab.dataset.tabId);
                }
            }
        }
    }

    function savePreset() {
        const presetName = prompt('Enter preset name:');
        if (presetName) {
            const widgets = window.grid ? window.grid.save() : [];
            localStorage.setItem(`preset_${presetName}`, JSON.stringify(widgets));
            alert('Preset saved!');
        }
    }

    function loadPreset() {
        const presetName = prompt('Enter preset name to load:');
        if (presetName) {
            const saved = localStorage.getItem(`preset_${presetName}`);
            if (saved && window.grid) {
                window.grid.load(JSON.parse(saved));
                alert('Preset loaded!');
            } else {
                alert('Preset not found!');
            }
        }
    }

    // Add click listeners to initial tab
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', (e) => {
                if (!e.target.closest('button')) {
                    switchTab(tab.dataset.tabId);
                }
            });
        });
    });
</script>
