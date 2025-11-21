const THEME_STORAGE_KEY = 'dashboard-theme';
const DARK_THEME = 'industrial';
const LIGHT_THEME = 'industrial-light';

function applyTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);

    const toggle = document.getElementById('theme-toggle');
    if (!toggle) return;

    const isLight = theme === LIGHT_THEME;
    const label = toggle.querySelector('[data-theme-label]');
    const sunIcon = toggle.querySelector('[data-icon="sun"]');
    const moonIcon = toggle.querySelector('[data-icon="moon"]');

    if (label) {
        label.textContent = isLight ? 'Light' : 'Dark';
    }

    if (sunIcon && moonIcon) {
        sunIcon.classList.toggle('hidden', !isLight);
        moonIcon.classList.toggle('hidden', isLight);
    }
}

function persistTheme(theme) {
    localStorage.setItem(THEME_STORAGE_KEY, theme);
}

function resolveInitialTheme() {
    const stored = localStorage.getItem(THEME_STORAGE_KEY);
    if (stored) return stored;

    const prefersLight = window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches;
    return prefersLight ? LIGHT_THEME : DARK_THEME;
}

function setTheme(theme) {
    applyTheme(theme);
    persistTheme(theme);
}

function toggleTheme() {
    const currentTheme = document.documentElement.getAttribute('data-theme') || DARK_THEME;
    const nextTheme = currentTheme === LIGHT_THEME ? DARK_THEME : LIGHT_THEME;
    setTheme(nextTheme);
}

document.addEventListener('DOMContentLoaded', () => {
    const initialTheme = resolveInitialTheme();
    setTheme(initialTheme);

    const toggleButton = document.getElementById('theme-toggle');
    if (toggleButton) {
        toggleButton.addEventListener('click', toggleTheme);
    }
});
