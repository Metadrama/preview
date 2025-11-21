/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            backdropBlur: {
                xs: '2px',
            },
            animation: {
                'fade-in': 'fadeIn 0.3s ease-in-out',
                'slide-up': 'slideUp 0.3s ease-out',
                'glow': 'glow 2s ease-in-out infinite',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%': { transform: 'translateY(10px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
                glow: {
                    '0%, 100%': { opacity: '1' },
                    '50%': { opacity: '0.5' },
                },
            },
        },
    },
    plugins: [
        require('daisyui'),
    ],
    daisyui: {
        themes: [
            {
                industrial: {
                    "primary": "#0ea5e9",
                    "primary-content": "#ffffff",
                    "secondary": "#8b5cf6",
                    "secondary-content": "#ffffff",
                    "accent": "#06b6d4",
                    "accent-content": "#ffffff",
                    "neutral": "#1e293b",
                    "neutral-content": "#e2e8f0",
                    "base-100": "#0f172a",
                    "base-200": "#1e293b",
                    "base-300": "#334155",
                    "base-content": "#f1f5f9",
                    "info": "#3b82f6",
                    "success": "#10b981",
                    "warning": "#f59e0b",
                    "error": "#ef4444",
                },
            },
            {
                "industrial-light": {
                    "primary": "#0284c7",
                    "primary-content": "#f8fafc",
                    "secondary": "#7c3aed",
                    "secondary-content": "#f8fafc",
                    "accent": "#06b6d4",
                    "accent-content": "#0f172a",
                    "neutral": "#e2e8f0",
                    "neutral-content": "#0f172a",
                    "base-100": "#f8fafc",
                    "base-200": "#e2e8f0",
                    "base-300": "#cbd5e1",
                    "base-content": "#0f172a",
                    "info": "#2563eb",
                    "success": "#16a34a",
                    "warning": "#f59e0b",
                    "error": "#ef4444",
                },
            },
        ],
        darkTheme: "industrial",
        base: true,
        styled: true,
        utils: true,
    },
}
