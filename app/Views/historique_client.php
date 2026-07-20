<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Aura Finance - Historique des Transactions</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="<?= base_url('assets/css/aura-finance.css') ?>" rel="stylesheet"/>
<script src="<?= base_url('assets/js/tailwind-config.js') ?>"></script>
</head>
<body class="bg-surface text-on-surface">
<!-- TopAppBar -->
<header class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-container-margin py-xs shadow-sm bg-surface">
<div class="flex items-center gap-sm">
<a class="font-headline-lg-mobile text-headline-lg-mobile font-bold text-primary" href="#">Aura Finance</a>
</div>
<div class="flex items-center gap-sm">
<button class="hidden md:flex px-sm py-base bg-primary-container text-on-primary-container font-medium rounded-lg hover:bg-opacity-90 transition-all active:scale-95">
                Switch Role
            </button>
<div class="flex gap-xs">
<button class="p-base rounded-full hover:bg-surface-container-high transition-colors">
<span class="material-symbols-outlined text-on-surface-variant">notifications</span>
</button>
<button class="p-base rounded-full hover:bg-surface-container-high transition-colors">
<span class="material-symbols-outlined text-on-surface-variant">account_circle</span>
</button>
</div>
</div>
</header>
<main class="pt-xl pb-32 px-container-margin max-w-5xl mx-auto mt-lg">
<!-- Header Section with Back Button -->
<div class="flex flex-col md:flex-row md:items-end justify-between mb-lg gap-md">
<div>
<a class="inline-flex items-center text-primary font-medium hover:underline mb-sm transition-transform active:scale-95" href="#">
<span class="material-symbols-outlined mr-xs">arrow_back</span>
                    Retour au portail
                </a>
<h1 class="font-headline-lg text-headline-lg text-on-surface">Historique des Transactions</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant mt-xs">Suivez vos opérations financières en temps réel.</p>
</div>
<!-- Filter Chips -->
<div class="flex gap-xs overflow-x-auto pb-base no-scrollbar">
<button class="px-md py-xs bg-primary text-on-primary rounded-full font-label-caps text-label-caps whitespace-nowrap">TOUT</button>
<button class="px-md py-xs bg-surface-container-high text-on-surface-variant rounded-full font-label-caps text-label-caps whitespace-nowrap hover:bg-primary-container transition-colors">DÉPÔTS</button>
<button class="px-md py-xs bg-surface-container-high text-on-surface-variant rounded-full font-label-caps text-label-caps whitespace-nowrap hover:bg-primary-container transition-colors">RETRAITS</button>
<button class="px-md py-xs bg-surface-container-high text-on-surface-variant rounded-full font-label-caps text-label-caps whitespace-nowrap hover:bg-primary-container transition-colors">TRANSFERTS</button>
</div>
</div>
<!-- Transactions Table Container -->
<div class="bg-surface rounded-xl shadow-sm border border-outline-variant overflow-hidden">
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-primary text-on-primary">
<th class="px-sm py-md font-label-caps text-label-caps uppercase tracking-wider">Date &amp; Heure</th>
<th class="px-sm py-md font-label-caps text-label-caps uppercase tracking-wider">Type</th>
<th class="px-sm py-md font-label-caps text-label-caps uppercase tracking-wider">Destinataire</th>
<th class="px-sm py-md font-label-caps text-label-caps uppercase tracking-wider text-right">Frais</th>
<th class="px-sm py-md font-label-caps text-label-caps uppercase tracking-wider text-right">Montant</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant">
<!-- Transaction Row 1 -->
<tr class="transaction-row hover:bg-surface-container transition-colors">
<td class="px-sm py-md">
<div class="font-body-sm text-body-sm text-on-surface">12 Oct 2023</div>
<div class="text-[12px] text-on-surface-variant">14:25</div>
</td>
<td class="px-sm py-md">
<div class="flex items-center gap-xs">
<span class="material-symbols-outlined text-primary text-[20px]">send</span>
<span class="font-body-sm text-body-sm">Transfert</span>
</div>
</td>
<td class="px-sm py-md font-numeric-data text-[16px] text-on-surface">034 56 789 01</td>
<td class="px-sm py-md text-right font-body-sm text-body-sm text-secondary">250 Ar</td>
<td class="px-sm py-md text-right font-numeric-data text-body-lg text-error">- 15 000 Ar</td>
</tr>
<!-- Transaction Row 2 -->
<tr class="transaction-row hover:bg-surface-container transition-colors">
<td class="px-sm py-md">
<div class="font-body-sm text-body-sm text-on-surface">10 Oct 2023</div>
<div class="text-[12px] text-on-surface-variant">09:12</div>
</td>
<td class="px-sm py-md">
<div class="flex items-center gap-xs">
<span class="material-symbols-outlined text-primary text-[20px]">payments</span>
<span class="font-body-sm text-body-sm">Dépôt</span>
</div>
</td>
<td class="px-sm py-md font-body-sm text-body-sm text-on-surface-variant">—</td>
<td class="px-sm py-md text-right font-body-sm text-body-sm text-secondary">0 Ar</td>
<td class="px-sm py-md text-right font-numeric-data text-body-lg text-[#2e7d32]">+ 50 000 Ar</td>
</tr>
<!-- Transaction Row 3 -->
<tr class="transaction-row hover:bg-surface-container transition-colors">
<td class="px-sm py-md">
<div class="font-body-sm text-body-sm text-on-surface">08 Oct 2023</div>
<div class="text-[12px] text-on-surface-variant">18:45</div>
</td>
<td class="px-sm py-md">
<div class="flex items-center gap-xs">
<span class="material-symbols-outlined text-primary text-[20px]">account_balance_wallet</span>
<span class="font-body-sm text-body-sm">Retrait</span>
</div>
</td>
<td class="px-sm py-md font-body-sm text-body-sm text-on-surface-variant">Point de vente #42</td>
<td class="px-sm py-md text-right font-body-sm text-body-sm text-secondary">500 Ar</td>
<td class="px-sm py-md text-right font-numeric-data text-body-lg text-error">- 20 000 Ar</td>
</tr>
<!-- Transaction Row 4 -->
<tr class="transaction-row hover:bg-surface-container transition-colors">
<td class="px-sm py-md">
<div class="font-body-sm text-body-sm text-on-surface">05 Oct 2023</div>
<div class="text-[12px] text-on-surface-variant">11:05</div>
</td>
<td class="px-sm py-md">
<div class="flex items-center gap-xs">
<span class="material-symbols-outlined text-primary text-[20px]">send</span>
<span class="font-body-sm text-body-sm">Transfert</span>
</div>
</td>
<td class="px-sm py-md font-numeric-data text-[16px] text-on-surface">032 11 222 33</td>
<td class="px-sm py-md text-right font-body-sm text-body-sm text-secondary">100 Ar</td>
<td class="px-sm py-md text-right font-numeric-data text-body-lg text-error">- 5 000 Ar</td>
</tr>
<!-- Transaction Row 5 -->
<tr class="transaction-row hover:bg-surface-container transition-colors">
<td class="px-sm py-md">
<div class="font-body-sm text-body-sm text-on-surface">01 Oct 2023</div>
<div class="text-[12px] text-on-surface-variant">08:00</div>
</td>
<td class="px-sm py-md">
<div class="flex items-center gap-xs">
<span class="material-symbols-outlined text-primary text-[20px]">payments</span>
<span class="font-body-sm text-body-sm">Dépôt</span>
</div>
</td>
<td class="px-sm py-md font-body-sm text-body-sm text-on-surface-variant">—</td>
<td class="px-sm py-md text-right font-body-sm text-body-sm text-secondary">0 Ar</td>
<td class="px-sm py-md text-right font-numeric-data text-body-lg text-[#2e7d32]">+ 150 000 Ar</td>
</tr>
</tbody>
</table>
</div>
<!-- Pagination-like footer for the table -->
<div class="px-md py-sm bg-surface-container-low flex justify-between items-center">
<span class="font-body-sm text-body-sm text-on-surface-variant">Affichage 1-5 sur 42 opérations</span>
<div class="flex gap-xs">
<button class="p-xs rounded-lg hover:bg-surface-container-high transition-colors">
<span class="material-symbols-outlined text-on-surface-variant">chevron_left</span>
</button>
<button class="p-xs rounded-lg bg-primary-container text-on-primary-container font-medium px-sm text-body-sm">1</button>
<button class="p-xs rounded-lg hover:bg-surface-container-high transition-colors font-medium px-sm text-body-sm">2</button>
<button class="p-xs rounded-lg hover:bg-surface-container-high transition-colors">
<span class="material-symbols-outlined text-on-surface-variant">chevron_right</span>
</button>
</div>
</div>
</div>
<!-- Financial Summary Bento Grid for Context -->
<div class="mt-xl grid grid-cols-1 md:grid-cols-3 gap-md">
<div class="p-md bg-secondary-container rounded-xl flex flex-col gap-xs shadow-sm">
<span class="material-symbols-outlined text-on-secondary-container">trending_up</span>
<h3 class="font-title-md text-title-md text-on-secondary-container">Dépôts ce mois</h3>
<p class="font-numeric-data text-headline-lg-mobile text-on-secondary-container">200 000 Ar</p>
</div>
<div class="p-md bg-surface-container-high rounded-xl flex flex-col gap-xs shadow-sm">
<span class="material-symbols-outlined text-primary">trending_down</span>
<h3 class="font-title-md text-title-md text-on-surface">Dépenses ce mois</h3>
<p class="font-numeric-data text-headline-lg-mobile text-on-surface">40 850 Ar</p>
</div>
<div class="p-md bg-primary-container rounded-xl flex flex-col gap-xs shadow-sm">
<span class="material-symbols-outlined text-on-primary-container">account_balance</span>
<h3 class="font-title-md text-title-md text-on-primary-container">Solde Actuel</h3>
<p class="font-numeric-data text-headline-lg-mobile text-on-primary-container">159 150 Ar</p>
</div>
</div>
</main>
<!-- BottomNavBar (Mobile Only) -->
<nav class="md:hidden fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-xs pb-sm pt-base bg-surface shadow-md rounded-t-xl">
<button class="flex flex-col items-center justify-center text-secondary transition-all active:scale-90">
<span class="material-symbols-outlined">home</span>
<span class="font-label-caps text-label-caps">Accueil</span>
</button>
<button class="flex flex-col items-center justify-center bg-primary-container text-on-primary-container rounded-full px-sm py-base transition-all active:scale-90">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">account_balance_wallet</span>
<span class="font-label-caps text-label-caps">Transactions</span>
</button>
<button class="flex flex-col items-center justify-center text-secondary transition-all active:scale-90">
<span class="material-symbols-outlined">grid_view</span>
<span class="font-label-caps text-label-caps">Tarifs</span>
</button>
<button class="flex flex-col items-center justify-center text-secondary transition-all active:scale-90">
<span class="material-symbols-outlined">person</span>
<span class="font-label-caps text-label-caps">Profil</span>
</button>
</nav>
<!-- Footer -->
<footer class="w-full flex flex-col items-center py-md px-container-margin mb-xl border-t border-outline-variant bg-surface-container-low">
<div class="font-title-md text-primary mb-sm">Aura Finance</div>
<div class="flex gap-md mb-md">
<a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Sécurité</a>
<a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Aide</a>
<a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Conditions</a>
</div>
<div class="font-body-sm text-body-sm text-secondary">© 2024 Aura Finance Madagascar.</div>
</footer>
<script>
        // Simple micro-interaction for rows
        document.querySelectorAll('.transaction-row').forEach(row => {
            row.addEventListener('click', () => {
                row.classList.add('scale-[0.99]');
                setTimeout(() => row.classList.remove('scale-[0.99]'), 100);
            });
        });
    </script>
</body></html>