<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Aura Finance - Tableau de Bord Opérateur</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .active-icon {
            font-variation-settings: 'FILL' 1;
        }
        /* Custom scrollbar for better UI */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #d0c6ab;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #7e775f;
        }
    </style>
<script id="tailwind-config">
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
                },
            },
        }
    </script>
</head>
<body class="bg-surface text-on-surface font-body-lg min-h-screen pb-24 md:pb-0">
<!-- TopAppBar -->
<header class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-container-margin py-xs shadow-sm bg-surface dark:bg-surface-dim">
<div class="flex items-center gap-sm">
<span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 1;">account_balance</span>
<h1 class="font-headline-lg-mobile text-headline-lg-mobile font-bold text-primary dark:text-primary-fixed">Aura Finance</h1>
</div>
<div class="flex items-center gap-sm">
<button class="hidden md:flex items-center px-sm py-xs rounded-full bg-secondary-container text-on-secondary-container hover:bg-surface-container-high transition-colors active:scale-95">
<span class="font-label-caps text-label-caps">Switch Role</span>
</button>
<div class="flex gap-xs">
<button class="p-xs rounded-full hover:bg-surface-container-high transition-colors active:scale-95">
<span class="material-symbols-outlined text-on-surface-variant">notifications</span>
</button>
<button class="p-xs rounded-full hover:bg-surface-container-high transition-colors active:scale-95">
<span class="material-symbols-outlined text-on-surface-variant">account_circle</span>
</button>
</div>
</div>
</header>
<!-- Main Content -->
<main class="pt-20 px-container-margin max-w-[1200px] mx-auto space-y-md">
<!-- Welcome Section & Stats Bento Grid -->
<section class="mt-sm">
<div class="mb-md">
<h2 class="font-headline-lg text-headline-lg text-on-surface">Bonjour, Opérateur</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant">Voici un aperçu de vos activités aujourd'hui.</p>
</div>
<!-- Dashboard Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-md">
<!-- Total Gains Card -->
<div class="bg-inverse-surface text-inverse-on-surface p-md rounded-xl shadow-md flex flex-col justify-between h-48 relative overflow-hidden group">
<div class="relative z-10">
<p class="font-label-caps text-label-caps opacity-80 mb-base uppercase tracking-widest">Gains Totaux (Frais)</p>
<h3 class="font-display-lg text-display-lg text-primary-container">1.250.000 <span class="text-title-md">Ar</span></h3>
</div>
<div class="flex justify-between items-end relative z-10">
<div class="flex flex-col">
<span class="text-body-sm text-green-400 flex items-center gap-base">
<span class="material-symbols-outlined text-sm">trending_up</span> +12% vs hier
                            </span>
</div>
<span class="material-symbols-outlined text-5xl opacity-20 group-hover:scale-110 transition-transform">payments</span>
</div>
<!-- Subtle background decoration -->
<div class="absolute -right-4 -bottom-4 w-32 h-32 bg-primary opacity-5 rounded-full blur-3xl"></div>
</div>
<!-- Transfers Card -->
<div class="bg-surface-container-high p-md rounded-xl shadow-sm flex flex-col justify-between h-48 border border-outline-variant/30">
<div>
<p class="font-label-caps text-label-caps text-on-surface-variant mb-base uppercase tracking-widest">Opérations de Transfert</p>
<h3 class="font-headline-lg text-headline-lg text-on-surface">84 <span class="font-title-md text-on-surface-variant">items</span></h3>
</div>
<div class="flex justify-between items-center">
<div class="h-1.5 w-full bg-outline-variant rounded-full overflow-hidden mr-sm">
<div class="bg-primary h-full w-3/4"></div>
</div>
<span class="text-body-sm font-bold text-primary">75%</span>
</div>
</div>
<!-- Withdrawals Card -->
<div class="bg-surface-container-high p-md rounded-xl shadow-sm flex flex-col justify-between h-48 border border-outline-variant/30">
<div>
<p class="font-label-caps text-label-caps text-on-surface-variant mb-base uppercase tracking-widest">Opérations de Retrait</p>
<h3 class="font-headline-lg text-headline-lg text-on-surface">42 <span class="font-title-md text-on-surface-variant">items</span></h3>
</div>
<div class="flex justify-between items-end">
<div class="flex gap-xs">
<span class="px-sm py-base rounded-full bg-primary-container text-on-primary-container font-label-caps text-label-caps">Stable</span>
</div>
<span class="material-symbols-outlined text-on-surface-variant/40 text-4xl">atm</span>
</div>
</div>
</div>
</section>
<!-- Customer Accounts & Transactions Section -->
<section class="grid grid-cols-1 lg:grid-cols-3 gap-md">
<!-- Customer List Table (Large Column) -->
<div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-outline-variant/20 overflow-hidden">
<div class="p-md border-b border-outline-variant/10 flex justify-between items-center">
<h3 class="font-title-md text-title-md text-on-surface flex items-center gap-xs">
<span class="material-symbols-outlined">group</span>
                        Comptes Clients
                    </h3>
<div class="flex gap-xs">
<button class="p-base rounded-lg hover:bg-surface-container transition-colors">
<span class="material-symbols-outlined text-secondary">search</span>
</button>
<button class="p-base rounded-lg hover:bg-surface-container transition-colors">
<span class="material-symbols-outlined text-secondary">filter_list</span>
</button>
</div>
</div>
<div class="overflow-x-auto">
<table class="w-full text-left">
<thead class="bg-surface-container-low text-on-surface-variant">
<tr>
<th class="px-md py-sm font-label-caps text-label-caps">Client</th>
<th class="px-md py-sm font-label-caps text-label-caps">Numéro</th>
<th class="px-md py-sm font-label-caps text-label-caps">Solde Actuel</th>
<th class="px-md py-sm font-label-caps text-label-caps">Statut</th>
<th class="px-md py-sm"></th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant/10">
<tr class="hover:bg-surface-container-lowest transition-colors">
<td class="px-md py-sm">
<div class="flex items-center gap-sm">
<div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container font-bold">RM</div>
<div class="font-body-sm font-bold">Rakoto Marie</div>
</div>
</td>
<td class="px-md py-sm text-body-sm font-numeric-data">034 56 789 12</td>
<td class="px-md py-sm font-numeric-data font-bold text-on-surface">450.000 Ar</td>
<td class="px-md py-sm">
<span class="px-xs py-base bg-green-100 text-green-700 rounded text-[10px] font-bold uppercase">Actif</span>
</td>
<td class="px-md py-sm text-right">
<button class="material-symbols-outlined text-on-surface-variant/60 hover:text-primary">more_vert</button>
</td>
</tr>
<tr class="hover:bg-surface-container-lowest transition-colors">
<td class="px-md py-sm">
<div class="flex items-center gap-sm">
<div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container font-bold">JA</div>
<div class="font-body-sm font-bold">Jean Andriana</div>
</div>
</td>
<td class="px-md py-sm text-body-sm font-numeric-data">032 44 222 99</td>
<td class="px-md py-sm font-numeric-data font-bold text-on-surface">1.200 Ar</td>
<td class="px-md py-sm">
<span class="px-xs py-base bg-error-container text-on-error-container rounded text-[10px] font-bold uppercase">Bas</span>
</td>
<td class="px-md py-sm text-right">
<button class="material-symbols-outlined text-on-surface-variant/60 hover:text-primary">more_vert</button>
</td>
</tr>
<tr class="hover:bg-surface-container-lowest transition-colors">
<td class="px-md py-sm">
<div class="flex items-center gap-sm">
<div class="w-10 h-10 rounded-full bg-tertiary-container flex items-center justify-center text-on-tertiary-container font-bold">FT</div>
<div class="font-body-sm font-bold">Faniry Tiana</div>
</div>
</td>
<td class="px-md py-sm text-body-sm font-numeric-data">033 11 999 44</td>
<td class="px-md py-sm font-numeric-data font-bold text-on-surface">2.150.000 Ar</td>
<td class="px-md py-sm">
<span class="px-xs py-base bg-green-100 text-green-700 rounded text-[10px] font-bold uppercase">Actif</span>
</td>
<td class="px-md py-sm text-right">
<button class="material-symbols-outlined text-on-surface-variant/60 hover:text-primary">more_vert</button>
</td>
</tr>
</tbody>
</table>
</div>
<div class="p-sm bg-surface-container-low text-center">
<button class="text-primary font-label-caps text-label-caps hover:underline">Voir tous les clients</button>
</div>
</div>
<!-- Recent Summary Operations (Right Column) -->
<div class="bg-white rounded-xl shadow-sm border border-outline-variant/20 overflow-hidden flex flex-col">
<div class="p-md border-b border-outline-variant/10">
<h3 class="font-title-md text-title-md text-on-surface">Résumé des Opérations</h3>
</div>
<div class="p-md space-y-md flex-grow overflow-y-auto max-h-[400px]">
<div class="flex items-center gap-sm">
<div class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center">
<span class="material-symbols-outlined text-green-600">call_received</span>
</div>
<div class="flex-grow">
<p class="font-body-sm font-bold text-on-surface">Dépôt Client</p>
<p class="text-[12px] text-on-surface-variant">Aujourd'hui, 14:20</p>
</div>
<div class="text-right">
<p class="font-numeric-data font-bold text-green-600">+ 50.000 Ar</p>
</div>
</div>
<div class="flex items-center gap-sm">
<div class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center">
<span class="material-symbols-outlined text-secondary">call_made</span>
</div>
<div class="flex-grow">
<p class="font-body-sm font-bold text-on-surface">Transfert Envoyé</p>
<p class="text-[12px] text-on-surface-variant">Aujourd'hui, 13:45</p>
</div>
<div class="text-right">
<p class="font-numeric-data font-bold text-secondary">- 12.500 Ar</p>
</div>
</div>
<div class="flex items-center gap-sm">
<div class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center">
<span class="material-symbols-outlined text-primary">local_atm</span>
</div>
<div class="flex-grow">
<p class="font-body-sm font-bold text-on-surface">Retrait Espèces</p>
<p class="text-[12px] text-on-surface-variant">Aujourd'hui, 11:10</p>
</div>
<div class="text-right">
<p class="font-numeric-data font-bold text-secondary">- 200.000 Ar</p>
</div>
</div>
<div class="flex items-center gap-sm opacity-50">
<div class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center">
<span class="material-symbols-outlined text-secondary">sync</span>
</div>
<div class="flex-grow">
<p class="font-body-sm font-bold text-on-surface">Ajustement Solde</p>
<p class="text-[12px] text-on-surface-variant">Hier, 18:30</p>
</div>
<div class="text-right">
<p class="font-numeric-data font-bold">--</p>
</div>
</div>
</div>
<button class="m-md py-sm bg-primary text-on-primary rounded-xl font-label-caps text-label-caps hover:brightness-110 active:scale-95 transition-all">
                    Nouvelle Opération
                </button>
</div>
</section>
<!-- Dynamic Visualization (Simulated with Gradient Pattern) -->
<section class="mb-xl">
<div class="w-full h-48 bg-surface-container-highest rounded-xl relative overflow-hidden flex items-center justify-center">
<div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#705d00 1px, transparent 1px); background-size: 20px 20px;"></div>
<div class="relative z-10 text-center">
<span class="material-symbols-outlined text-5xl text-outline mb-xs">analytics</span>
<p class="font-body-sm text-on-surface-variant italic">Analyse des flux monétaires hebdomadaires (Visualisation en temps réel)</p>
</div>
<!-- Animated decorative wave using SVG -->
<div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none">
<svg class="relative block w-[200%] h-12" preserveaspectratio="none" viewbox="0 0 1200 120">
<path d="M0,64 C150,112 350,112 500,64 C650,16 850,16 1000,64 C1150,112 1350,112 1500,64 L1500,120 L0,120 Z" fill="rgba(112, 93, 0, 0.05)"></path>
</svg>
</div>
</div>
</section>
</main>
<!-- BottomNavBar (Mobile Only) -->
<nav class="md:hidden fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-xs pb-sm pt-base shadow-md bg-surface dark:bg-surface-container rounded-t-xl">
<a class="flex flex-col items-center justify-center bg-primary-container dark:bg-primary-fixed text-on-primary-container dark:text-on-primary-fixed rounded-full px-sm py-base active:scale-90 transition-all duration-200" href="#">
<span class="material-symbols-outlined active-icon">home</span>
<span class="font-label-caps text-label-caps mt-1">Accueil</span>
</a>
<a class="flex flex-col items-center justify-center text-secondary dark:text-secondary-fixed-dim hover:bg-surface-variant transition-all active:scale-90" href="#">
<span class="material-symbols-outlined">account_balance_wallet</span>
<span class="font-label-caps text-label-caps mt-1">Transactions</span>
</a>
<a class="flex flex-col items-center justify-center text-secondary dark:text-secondary-fixed-dim hover:bg-surface-variant transition-all active:scale-90" href="#">
<span class="material-symbols-outlined">grid_view</span>
<span class="font-label-caps text-label-caps mt-1">Tarifs</span>
</a>
<a class="flex flex-col items-center justify-center text-secondary dark:text-secondary-fixed-dim hover:bg-surface-variant transition-all active:scale-90" href="#">
<span class="material-symbols-outlined">settings</span>
<span class="font-label-caps text-label-caps mt-1">Config</span>
</a>
</nav>
<!-- Footer -->
<footer class="w-full flex flex-col items-center py-md px-container-margin mb-xl md:mb-0 border-t border-outline-variant bg-surface-container-low dark:bg-surface-container-lowest">
<div class="flex flex-col md:flex-row justify-between w-full max-w-[1200px] gap-md items-center">
<div class="flex flex-col items-center md:items-start">
<p class="font-title-md text-primary font-bold">Aura Finance</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">© 2024 Aura Finance Madagascar.</p>
</div>
<div class="flex gap-lg">
<a class="font-body-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Sécurité</a>
<a class="font-body-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Aide</a>
<a class="font-body-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Conditions</a>
</div>
<div class="flex gap-sm">
<button class="p-xs bg-surface-variant rounded-full opacity-80 hover:opacity-100 transition-opacity">
<span class="material-symbols-outlined text-sm">language</span>
</button>
<button class="p-xs bg-surface-variant rounded-full opacity-80 hover:opacity-100 transition-opacity">
<span class="material-symbols-outlined text-sm">share</span>
</button>
</div>
</div>
</footer>
<!-- FAB for quick action (Dashboard Context) -->
<button class="fixed right-6 bottom-24 md:bottom-12 z-40 w-14 h-14 bg-primary-container text-on-primary-container rounded-2xl shadow-lg flex items-center justify-center active:scale-90 transition-transform hover:rotate-12">
<span class="material-symbols-outlined text-3xl">add</span>
</button>
<script>
        // Micro-interaction: Update active state on nav click (demo only)
        document.querySelectorAll('nav a').forEach(link => {
            link.addEventListener('click', (e) => {
                document.querySelectorAll('nav a').forEach(l => {
                    l.classList.remove('bg-primary-container', 'text-on-primary-container');
                    l.classList.add('text-secondary');
                    l.querySelector('span').classList.remove('active-icon');
                });
                link.classList.add('bg-primary-container', 'text-on-primary-container');
                link.classList.remove('text-secondary');
                link.querySelector('span').classList.add('active-icon');
            });
        });

        // Simple numbers increment animation for the gains card
        function animateValue(obj, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                const value = Math.floor(progress * (end - start) + start);
                obj.innerHTML = value.toLocaleString('fr-FR') + ' <span class="text-title-md">Ar</span>';
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }

        // Trigger animation after load
        window.addEventListener('load', () => {
            const gainsElement = document.querySelector('h3.font-display-lg');
            if(gainsElement) {
                animateValue(gainsElement, 1000000, 1250000, 1500);
            }
        });
    </script>
</body></html>