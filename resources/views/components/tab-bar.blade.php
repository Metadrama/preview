<!-- Canvas Tab Bar - Monochrome -->
<div class="bg-neutral-950 border-b border-neutral-900 h-10 flex items-center overflow-x-auto">
    <div class="flex items-center h-full" id="tab-container">
        <!-- Tabs will be rendered here -->
        <div class="tab tab-active flex items-center gap-2 px-3 h-full border-r border-neutral-900 cursor-pointer transition-snappy" data-tab-id="1">
            <span class="text-sm">Dashboard 1</span>
            <button class="ml-2 hover:text-red-400 transition-snappy" onclick="closeTab(event, '1')">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex items-center gap-1 ml-auto pr-2">
        <button onclick="createNewTab()" class="flex items-center gap-1.5 px-3 py-1 text-xs text-slate-400 hover:text-slate-200 hover:bg-slate-800 rounded transition-snappy" title="New Tab">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>New</span>
        </button>
        <div class="w-px h-4 bg-slate-700 mx-1"></div>
        <button onclick="savePreset()" class="flex items-center gap-1.5 px-3 py-1 text-xs text-slate-400 hover:text-slate-200 hover:bg-slate-800 rounded transition-snappy" title="Save Preset">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
            </svg>
            <span>Save</span>
        </button>
        <button onclick="loadPreset()" class="flex items-center gap-1.5 px-3 py-1 text-xs text-slate-400 hover:text-slate-200 hover:bg-slate-800 rounded transition-snappy" title="Load Preset">
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
        newTab.className = 'tab tab-active flex items-center gap-2 px-4 h-full border-r border-slate-800 cursor-pointer transition-snappy';
        newTab.dataset.tabId = tabId;
        newTab.innerHTML = `
            <span class="text-sm">Dashboard ${tabCounter}</span>
            <button class="ml-2 hover:text-red-400 transition-snappy" onclick="closeTab(event, '${tabId}')">
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
