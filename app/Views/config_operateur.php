<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Configuration Opérateur | Aura Finance</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
                        "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                        "body-lg": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "700"}],
                        "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "numeric-data": ["24px", {"lineHeight": "24px", "letterSpacing": "-0.02em", "fontWeight": "500"}],
                        "title-md": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                        "display-lg": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}]
                    }
                }
            }
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
        }
        .bento-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 24px;
        }
        .bento-card {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 4px 12px rgba(112, 93, 0, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .bento-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(112, 93, 0, 0.12);
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #d0c6ab;
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-surface font-body-lg text-on-surface min-h-screen pb-24 md:pb-0">
<!-- Top Navigation Bar -->
<header class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-container-margin py-xs shadow-sm bg-surface">
<div class="flex items-center gap-sm">
<span class="font-headline-lg-mobile text-headline-lg-mobile font-bold text-primary">Aura Finance</span>
<div class="hidden md:flex gap-md ml-xl">
<a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="#">Accueil</a>
<a class="text-primary font-bold border-b-2 border-primary" href="#">Configuration</a>
<a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="#">Transactions</a>
<a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="#">Rapports</a>
</div>
</div>
<div class="flex items-center gap-sm">
<button class="hidden md:block px-sm py-base text-primary font-bold hover:bg-surface-container-high transition-colors rounded-lg">Switch Role</button>
<div class="flex gap-xs">
<span class="material-symbols-outlined p-xs hover:bg-surface-container-high rounded-full cursor-pointer transition-colors" data-icon="notifications">notifications</span>
<span class="material-symbols-outlined p-xs hover:bg-surface-container-high rounded-full cursor-pointer transition-colors" data-icon="account_circle">account_circle</span>
</div>
</div>
</header>
<main class="pt-24 px-container-margin max-w-[1200px] mx-auto pb-12">
<!-- Breadcrumbs / Title -->
<div class="mb-lg">
<h1 class="font-headline-lg text-headline-lg text-primary mb-base">Configuration de l'Opérateur</h1>
<p class="text-on-surface-variant font-body-sm">Paramétrez les préfixes mobiles, types d'opérations et barèmes de frais pour Madagascar.</p>
</div>
<div class="bento-grid">
<!-- Prefix Configuration Section -->
<section class="col-span-12 lg:col-span-4 bento-card p-md flex flex-col gap-md">
<div class="flex items-center justify-between">
<h2 class="font-title-md text-title-md flex items-center gap-xs">
<span class="material-symbols-outlined text-primary" data-icon="cell_tower">cell_tower</span>
                        Préfixes Valides
                    </h2>
<span class="px-xs py-base bg-primary-container text-on-primary-container text-[10px] font-bold rounded-full uppercase tracking-wider">Mobile</span>
</div>
<div class="flex gap-xs">
<input class="flex-1 bg-surface-container border-none focus:ring-2 focus:ring-primary rounded-lg font-body-sm px-sm py-xs" placeholder="Ex: 033" type="text"/>
<button class="bg-primary text-on-primary px-sm py-xs rounded-lg font-bold hover:opacity-90 active:scale-95 transition-all">Ajouter</button>
</div>
<div class="flex flex-wrap gap-xs overflow-y-auto max-h-48 custom-scrollbar">
<div class="flex items-center gap-xs bg-surface-container-high px-sm py-xs rounded-full group cursor-default">
<span class="font-bold text-primary">033</span>
<span class="text-on-surface-variant text-[10px]">Airtel</span>
<span class="material-symbols-outlined text-sm text-error opacity-0 group-hover:opacity-100 cursor-pointer transition-opacity" data-icon="close">close</span>
</div>
<div class="flex items-center gap-xs bg-surface-container-high px-sm py-xs rounded-full group cursor-default">
<span class="font-bold text-primary">034</span>
<span class="text-on-surface-variant text-[10px]">Telma</span>
<span class="material-symbols-outlined text-sm text-error opacity-0 group-hover:opacity-100 cursor-pointer transition-opacity" data-icon="close">close</span>
</div>
<div class="flex items-center gap-xs bg-surface-container-high px-sm py-xs rounded-full group cursor-default">
<span class="font-bold text-primary">032</span>
<span class="text-on-surface-variant text-[10px]">Orange</span>
<span class="material-symbols-outlined text-sm text-error opacity-0 group-hover:opacity-100 cursor-pointer transition-opacity" data-icon="close">close</span>
</div>
<div class="flex items-center gap-xs bg-surface-container-high px-sm py-xs rounded-full group cursor-default">
<span class="font-bold text-primary">037</span>
<span class="text-on-surface-variant text-[10px]">Airtel</span>
<span class="material-symbols-outlined text-sm text-error opacity-0 group-hover:opacity-100 cursor-pointer transition-opacity" data-icon="close">close</span>
</div>
<div class="flex items-center gap-xs bg-surface-container-high px-sm py-xs rounded-full group cursor-default">
<span class="font-bold text-primary">038</span>
<span class="text-on-surface-variant text-[10px]">Telma</span>
<span class="material-symbols-outlined text-sm text-error opacity-0 group-hover:opacity-100 cursor-pointer transition-opacity" data-icon="close">close</span>
</div>
</div>
</section>
<!-- Operation Types and Quick Actions -->
<section class="col-span-12 lg:col-span-8 bento-card p-md">
<div class="flex items-center justify-between mb-md">
<h2 class="font-title-md text-title-md flex items-center gap-xs">
<span class="material-symbols-outlined text-primary" data-icon="settings_suggest">settings_suggest</span>
                        Types d'Opérations
                    </h2>
<button class="text-primary font-bold text-body-sm flex items-center gap-base">
<span class="material-symbols-outlined text-lg" data-icon="add_circle">add_circle</span>
                        Nouveau Type
                    </button>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-sm">
<div class="p-sm bg-surface-container rounded-xl flex items-center justify-between border-l-4 border-primary">
<div>
<p class="font-bold text-primary">Retrait Cash</p>
<p class="text-[12px] text-on-surface-variant">Frais appliqués au retrait en point de vente</p>
</div>
<div class="flex gap-base">
<span class="material-symbols-outlined text-on-surface-variant hover:text-primary cursor-pointer p-base bg-white rounded-md" data-icon="edit">edit</span>
</div>
</div>
<div class="p-sm bg-surface-container rounded-xl flex items-center justify-between border-l-4 border-secondary">
<div>
<p class="font-bold text-secondary">Transfert Inter-compte</p>
<p class="text-[12px] text-on-surface-variant">Transfert entre deux clients Aura</p>
</div>
<div class="flex gap-base">
<span class="material-symbols-outlined text-on-surface-variant hover:text-primary cursor-pointer p-base bg-white rounded-md" data-icon="edit">edit</span>
</div>
</div>
<div class="p-sm bg-surface-container rounded-xl flex items-center justify-between border-l-4 border-primary">
<div>
<p class="font-bold text-primary">Dépôt d'argent</p>
<p class="text-[12px] text-on-surface-variant">Alimentation du compte client</p>
</div>
<div class="flex gap-base">
<span class="material-symbols-outlined text-on-surface-variant hover:text-primary cursor-pointer p-base bg-white rounded-md" data-icon="edit">edit</span>
</div>
</div>
<div class="p-sm bg-surface-container rounded-xl flex items-center justify-between border-l-4 border-secondary">
<div>
<p class="font-bold text-secondary">Paiement Facture</p>
<p class="text-[12px] text-on-surface-variant">Frais fixes ou variables par marchand</p>
</div>
<div class="flex gap-base">
<span class="material-symbols-outlined text-on-surface-variant hover:text-primary cursor-pointer p-base bg-white rounded-md" data-icon="edit">edit</span>
</div>
</div>
</div>
</section>
<!-- Main Pricing Table Section -->
<section class="col-span-12 bento-card overflow-hidden">
<div class="p-md flex flex-col md:flex-row md:items-center justify-between gap-md border-b border-outline-variant">
<div>
<h2 class="font-title-md text-title-md flex items-center gap-xs">
<span class="material-symbols-outlined text-primary" data-icon="table_chart">table_chart</span>
                            Barèmes de Frais : Retrait Cash
                        </h2>
<p class="text-on-surface-variant font-body-sm">Modification des tranches tarifaires en temps réel.</p>
</div>
<div class="flex gap-sm">
<div class="relative">
<span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-on-surface-variant" data-icon="search">search</span>
<input class="pl-xl pr-sm py-xs bg-surface-container border-none focus:ring-2 focus:ring-primary rounded-full text-body-sm w-full md:w-64" placeholder="Rechercher une tranche..." type="text"/>
</div>
<button class="bg-primary-container text-on-primary-container px-md py-xs rounded-full font-bold flex items-center gap-xs hover:bg-primary hover:text-on-primary transition-all active:scale-95 shadow-sm">
<span class="material-symbols-outlined text-lg" data-icon="add">add</span>
                            Tranche
                        </button>
</div>
</div>
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-secondary text-on-secondary uppercase text-[11px] tracking-[0.1em] font-bold">
<th class="px-md py-sm">ID</th>
<th class="px-md py-sm">Min (Ar)</th>
<th class="px-md py-sm">Max (Ar)</th>
<th class="px-md py-sm">Frais (Ar / %)</th>
<th class="px-md py-sm">Type de Frais</th>
<th class="px-md py-sm text-center">Statut</th>
<th class="px-md py-sm text-right">Actions</th>
</tr>
</thead>
<tbody class="text-body-sm font-medium divide-y divide-outline-variant">
<tr class="hover:bg-primary-container/5 transition-colors">
<td class="px-md py-md text-on-surface-variant">#001</td>
<td class="px-md py-md font-numeric-data text-headline-lg-mobile text-[16px]">0</td>
<td class="px-md py-md font-numeric-data text-headline-lg-mobile text-[16px]">5 000</td>
<td class="px-md py-md font-bold text-primary">150</td>
<td class="px-md py-md">
<span class="px-xs py-base bg-surface-container text-on-surface-variant rounded-md text-[10px]">FIXE</span>
</td>
<td class="px-md py-md text-center">
<span class="inline-flex items-center px-xs py-base bg-green-100 text-green-700 rounded-full text-[10px] font-bold">ACTIF</span>
</td>
<td class="px-md py-md text-right">
<div class="flex justify-end gap-xs">
<button class="p-xs hover:bg-surface-container-high rounded-lg transition-colors text-primary"><span class="material-symbols-outlined" data-icon="edit">edit</span></button>
<button class="p-xs hover:bg-error-container/20 rounded-lg transition-colors text-error"><span class="material-symbols-outlined" data-icon="delete">delete</span></button>
</div>
</td>
</tr>
<tr class="bg-surface-container-low hover:bg-primary-container/5 transition-colors">
<td class="px-md py-md text-on-surface-variant">#002</td>
<td class="px-md py-md font-numeric-data text-headline-lg-mobile text-[16px]">5 001</td>
<td class="px-md py-md font-numeric-data text-headline-lg-mobile text-[16px]">10 000</td>
<td class="px-md py-md font-bold text-primary">300</td>
<td class="px-md py-md">
<span class="px-xs py-base bg-surface-container text-on-surface-variant rounded-md text-[10px]">FIXE</span>
</td>
<td class="px-md py-md text-center">
<span class="inline-flex items-center px-xs py-base bg-green-100 text-green-700 rounded-full text-[10px] font-bold">ACTIF</span>
</td>
<td class="px-md py-md text-right">
<div class="flex justify-end gap-xs">
<button class="p-xs hover:bg-surface-container-high rounded-lg transition-colors text-primary"><span class="material-symbols-outlined" data-icon="edit">edit</span></button>
<button class="p-xs hover:bg-error-container/20 rounded-lg transition-colors text-error"><span class="material-symbols-outlined" data-icon="delete">delete</span></button>
</div>
</td>
</tr>
<tr class="hover:bg-primary-container/5 transition-colors">
<td class="px-md py-md text-on-surface-variant">#003</td>
<td class="px-md py-md font-numeric-data text-headline-lg-mobile text-[16px]">10 001</td>
<td class="px-md py-md font-numeric-data text-headline-lg-mobile text-[16px]">50 000</td>
<td class="px-md py-md font-bold text-primary">2.5 %</td>
<td class="px-md py-md">
<span class="px-xs py-base bg-surface-container text-on-surface-variant rounded-md text-[10px]">POURCENTAGE</span>
</td>
<td class="px-md py-md text-center">
<span class="inline-flex items-center px-xs py-base bg-green-100 text-green-700 rounded-full text-[10px] font-bold">ACTIF</span>
</td>
<td class="px-md py-md text-right">
<div class="flex justify-end gap-xs">
<button class="p-xs hover:bg-surface-container-high rounded-lg transition-colors text-primary"><span class="material-symbols-outlined" data-icon="edit">edit</span></button>
<button class="p-xs hover:bg-error-container/20 rounded-lg transition-colors text-error"><span class="material-symbols-outlined" data-icon="delete">delete</span></button>
</div>
</td>
</tr>
<tr class="bg-surface-container-low hover:bg-primary-container/5 transition-colors">
<td class="px-md py-md text-on-surface-variant">#004</td>
<td class="px-md py-md font-numeric-data text-headline-lg-mobile text-[16px]">50 001</td>
<td class="px-md py-md font-numeric-data text-headline-lg-mobile text-[16px]">100 000</td>
<td class="px-md py-md font-bold text-primary">1 200</td>
<td class="px-md py-md">
<span class="px-xs py-base bg-surface-container text-on-surface-variant rounded-md text-[10px]">FIXE</span>
</td>
<td class="px-md py-md text-center">
<span class="inline-flex items-center px-xs py-base bg-amber-100 text-amber-700 rounded-full text-[10px] font-bold">SUSPENDU</span>
</td>
<td class="px-md py-md text-right">
<div class="flex justify-end gap-xs">
<button class="p-xs hover:bg-surface-container-high rounded-lg transition-colors text-primary"><span class="material-symbols-outlined" data-icon="edit">edit</span></button>
<button class="p-xs hover:bg-error-container/20 rounded-lg transition-colors text-error"><span class="material-symbols-outlined" data-icon="delete">delete</span></button>
</div>
</td>
</tr>
</tbody>
</table>
</div>
<div class="p-md bg-surface-container-low flex justify-between items-center text-body-sm">
<p class="text-on-surface-variant">Affichage de 1 à 4 sur 12 tranches</p>
<div class="flex gap-base">
<button class="p-xs border border-outline-variant rounded-lg hover:bg-surface-container-high disabled:opacity-50" disabled=""><span class="material-symbols-outlined" data-icon="chevron_left">chevron_left</span></button>
<button class="px-sm py-xs bg-primary text-on-primary rounded-lg font-bold">1</button>
<button class="px-sm py-xs hover:bg-surface-container-high rounded-lg transition-colors">2</button>
<button class="px-sm py-xs hover:bg-surface-container-high rounded-lg transition-colors">3</button>
<button class="p-xs border border-outline-variant rounded-lg hover:bg-surface-container-high"><span class="material-symbols-outlined" data-icon="chevron_right">chevron_right</span></button>
</div>
</div>
</section>
</div>
</main>
<!-- Bottom Navigation Bar (Mobile only) -->
<nav class="md:hidden fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-xs pb-sm pt-base bg-surface shadow-md rounded-t-xl">
<a class="flex flex-col items-center justify-center text-secondary" href="#">
<span class="material-symbols-outlined" data-icon="home">home</span>
<span class="font-label-caps text-label-caps">Accueil</span>
</a>
<a class="flex flex-col items-center justify-center text-secondary" href="#">
<span class="material-symbols-outlined" data-icon="account_balance_wallet">account_balance_wallet</span>
<span class="font-label-caps text-label-caps">Transactions</span>
</a>
<a class="flex flex-col items-center justify-center bg-primary-container text-on-primary-container rounded-full px-sm py-base" href="#">
<span class="material-symbols-outlined" data-icon="grid_view">grid_view</span>
<span class="font-label-caps text-label-caps">Tarifs</span>
</a>
<a class="flex flex-col items-center justify-center text-secondary" href="#">
<span class="material-symbols-outlined" data-icon="person">person</span>
<span class="font-label-caps text-label-caps">Profil</span>
</a>
</nav>
<!-- Footer Section -->
<footer class="w-full flex flex-col items-center py-md px-container-margin mb-xl bg-surface-container-low border-t border-outline-variant mt-xl">
<span class="font-title-md text-primary mb-xs">Aura Finance Madagascar</span>
<div class="flex gap-md mb-sm">
<a class="text-on-surface-variant hover:text-primary transition-colors text-body-sm" href="#">Sécurité</a>
<a class="text-on-surface-variant hover:text-primary transition-colors text-body-sm" href="#">Aide</a>
<a class="text-on-surface-variant hover:text-primary transition-colors text-body-sm" href="#">Conditions</a>
</div>
<p class="text-secondary font-body-sm">© 2024 Aura Finance Madagascar. Tous droits réservés.</p>
</footer>
<!-- FAB for quick access to add new Barème (visible contextually) -->
<button class="fixed right-6 bottom-24 md:bottom-10 bg-primary-container text-on-primary-container w-14 h-14 rounded-full shadow-lg flex items-center justify-center hover:scale-105 active:scale-95 transition-all z-40 group">
<span class="material-symbols-outlined text-3xl" data-icon="add">add</span>
<span class="absolute right-16 bg-primary text-on-primary px-sm py-xs rounded-lg text-body-sm whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none shadow-xl">Nouvelle tranche</span>
</button>
<script>
        // Simple Interaction logic
        document.querySelectorAll('button').forEach(btn => {
            btn.addEventListener('mousedown', () => {
                btn.style.transform = 'scale(0.95)';
            });
            btn.addEventListener('mouseup', () => {
                btn.style.transform = 'scale(1)';
            });
        });

        // Search highlight mock
        const searchInput = document.querySelector('input[placeholder="Rechercher une tranche..."]');
        if(searchInput) {
            searchInput.addEventListener('input', (e) => {
                const term = e.target.value.toLowerCase();
                document.querySelectorAll('tbody tr').forEach(tr => {
                    const text = tr.innerText.toLowerCase();
                    tr.style.display = text.includes(term) ? '' : 'none';
                });
            });
        }
    </script>
</body></html>