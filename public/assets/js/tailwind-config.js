// Aura Finance — Configuration Tailwind commune
// Utilisée par : config_operateur.php, connexion.php, gain.php, historique_client.php
// (auparavant dupliquée intégralement dans chaque page)
tailwind.config = {
    darkMode: "class",
    theme: {
        extend: {
            "colors": {
                "on-tertiary-container": "#506076",
                "on-secondary": "#ffffff",
                "on-secondary-fixed": "#131b2e",
                "on-tertiary-fixed-variant": "#38485d",
                "inverse-on-surface": "#eff1f3",
                "on-surface": "#191c1e",
                "error-container": "#ffdad6",
                "secondary-fixed-dim": "#bec6e0",
                "surface-variant": "#e0e3e5",
                "surface-tint": "#705d00",
                "secondary-fixed": "#dae2fd",
                "on-secondary-container": "#5c647a",
                "inverse-primary": "#e9c400",
                "on-primary": "#ffffff",
                "on-error": "#ffffff",
                "tertiary-container": "#cadbf5",
                "surface-container-lowest": "#ffffff",
                "primary-fixed": "#ffe16d",
                "background": "#f7f9fb",
                "on-primary-fixed-variant": "#544600",
                "surface-bright": "#f7f9fb",
                "on-primary-fixed": "#221b00",
                "primary-fixed-dim": "#e9c400",
                "surface-dim": "#d8dadc",
                "on-tertiary-fixed": "#0b1c30",
                "on-tertiary": "#ffffff",
                "on-secondary-fixed-variant": "#3f465c",
                "primary": "#705d00",
                "surface": "#f7f9fb",
                "tertiary-fixed-dim": "#b7c8e1",
                "outline-variant": "#d0c6ab",
                "secondary": "#565e74",
                "outline": "#7e775f",
                "surface-container-high": "#e6e8ea",
                "on-surface-variant": "#4d4732",
                "on-error-container": "#93000a",
                "secondary-container": "#dae2fd",
                "surface-container-highest": "#e0e3e5",
                "tertiary-fixed": "#d3e4fe",
                "surface-container-low": "#f2f4f6",
                "error": "#ba1a1a",
                "surface-container": "#eceef0",
                "inverse-surface": "#2d3133",
                "on-background": "#191c1e",
                "primary-container": "#ffd700",
                "on-primary-container": "#705e00",
                "tertiary": "#505f76"
            },
            "borderRadius": {
                "DEFAULT": "0.25rem",
                "lg": "0.5rem",
                "xl": "0.75rem",
                "full": "9999px"
            },
            "spacing": {
                "xs": "8px",
                "lg": "32px",
                "sm": "16px",
                "md": "24px",
                "xl": "48px",
                "container-margin": "20px",
                "base": "4px",
                "gutter": "12px"
            },
            "fontFamily": {
                "headline-lg": ["Inter"],
                "body-lg": ["Inter"],
                "label-caps": ["Inter"],
                "headline-lg-mobile": ["Inter"],
                "numeric-data": ["Inter"],
                "title-md": ["Inter"],
                "display-lg": ["Inter"],
                "body-sm": ["Inter"]
            },
            "fontSize": {
                "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                "body-lg": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                "label-caps": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "700" }],
                "headline-lg-mobile": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                "numeric-data": ["24px", { "lineHeight": "24px", "letterSpacing": "-0.02em", "fontWeight": "500" }],
                "title-md": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                "display-lg": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                "body-sm": ["14px", { "lineHeight": "20px", "fontWeight": "400" }]
            }
        }
    }
}