import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
                display: ["Plus Jakarta Sans", ...defaultTheme.fontFamily.sans],
                mono: ["JetBrains Mono", ...defaultTheme.fontFamily.mono],
            },
            colors: {
                // ── Skills LABS Dark Theme (THM-inspired) ──
                "sl-bg": "#0D1117",
                "sl-surface": "#161B22",
                "sl-card": "#1A2035",
                "sl-card-hover": "#1E2640",
                "sl-border": "#30363D",
                "sl-border-sub": "#21262D",

                // Accents
                "sl-red": "#FF4655",
                "sl-red-dark": "#CC2936",
                "sl-red-dim": "#2D0A0F",
                "sl-green": "#00FF41",
                "sl-green-2": "#20C997",
                "sl-green-dim": "#0D3321",
                "sl-yellow": "#FFD60A",
                "sl-yellow-dim": "#2D2205",
                "sl-blue": "#58A6FF",
                "sl-blue-dim": "#0C1929",
                "sl-purple": "#BC8CFF",
                "sl-purple-dim": "#1A0F2E",
                "sl-orange": "#FF7F50",

                // Text
                "sl-text": "#E6EDF3",
                "sl-text-2": "#8B949E",
                "sl-text-muted": "#484F58",
            },
            boxShadow: {
                "glow-red": "0 0 20px rgba(255, 70, 85, 0.35)",
                "glow-red-lg": "0 0 40px rgba(255, 70, 85, 0.25)",
                "glow-green": "0 0 20px rgba(32, 201, 151, 0.35)",
                "glow-blue": "0 0 20px rgba(88, 166, 255, 0.35)",
                "glow-yellow": "0 0 20px rgba(255, 214, 10, 0.35)",
                "card-dark": "0 4px 24px rgba(0, 0, 0, 0.5)",
            },
            backgroundImage: {
                "dot-pattern": "radial-gradient(#30363D 1px, transparent 1px)",
                "grid-pattern":
                    "url(\"data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2330363D' fill-opacity='0.2'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E\")",
                "hero-gradient":
                    "linear-gradient(135deg, #0D1117 0%, #1C2333 60%, #2D1B1E 100%)",
            },
            backgroundSize: {
                "dot-sm": "20px 20px",
                "dot-md": "28px 28px",
            },
            animation: {
                blink: "blink 1s step-end infinite",
                "glow-pulse": "glowPulse 2s ease-in-out infinite alternate",
                "scan-line": "scanLine 4s linear infinite",
                "fade-in-up": "fadeInUp 0.5s ease-out",
                typing: "typing 2s steps(20, end)",
            },
            keyframes: {
                blink: {
                    "0%, 100%": { opacity: "1" },
                    "50%": { opacity: "0" },
                },
                glowPulse: {
                    "0%": { boxShadow: "0 0 5px rgba(255,70,85,0.2)" },
                    "100%": { boxShadow: "0 0 25px rgba(255,70,85,0.6)" },
                },
                scanLine: {
                    "0%": { transform: "translateY(-100%)" },
                    "100%": { transform: "translateY(100vh)" },
                },
                fadeInUp: {
                    "0%": { opacity: "0", transform: "translateY(16px)" },
                    "100%": { opacity: "1", transform: "translateY(0)" },
                },
                typing: {
                    from: { width: "0" },
                    to: { width: "100%" },
                },
            },
        },
    },

    plugins: [forms],
};
