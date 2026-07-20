<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Aura Finance - Accueil</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="<?= base_url('assets/css/aura-finance.css') ?>" rel="stylesheet"/>
<script src="<?= base_url('assets/js/tailwind-config.js') ?>"></script>
</head>
<body class="bg-background text-on-background font-body-lg overflow-x-hidden min-h-screen">
<!-- Main Navigation Shell (TopAppBar) -->
<header class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-container-margin py-xs shadow-sm bg-surface" id="top-bar">
<div class="font-headline-lg-mobile text-headline-lg-mobile font-bold text-primary">Aura Finance</div>
<div class="flex items-center gap-sm">
<button class="material-symbols-outlined text-secondary hover:bg-surface-container-high transition-colors p-base rounded-full" data-icon="notifications">notifications</button>
<a class="material-symbols-outlined text-secondary hover:bg-surface-container-high transition-colors p-base rounded-full" data-icon="account_circle" href="<?= base_url('connexion') ?>" title="Se déconnecter">account_circle</a>
</div>
</header>
<!-- Content Canvas (Dashboard) -->
<main class="pt-20 pb-28 px-container-margin max-w-[1200px] mx-auto w-full" id="dashboard">
<!-- Welcome Section -->
<div class="mb-lg">
<h2 class="font-headline-lg-mobile text-headline-lg-mobile text-on-surface">Salama, <span class="text-primary" id="user-phone-display"><?= esc($userPhone ?? 'Mpanjifa') ?></span></h2>
<p class="text-on-surface-variant text-body-sm">Voici l'aperçu de votre compte aujourd'hui.</p>
</div>
<!-- Financial Bento Grid -->
<div class="grid grid-cols-1 md:grid-cols-12 gap-md">
<!-- Balance Card -->
<div class="md:col-span-8 bg-inverse-surface rounded-xl p-lg relative overflow-hidden shadow-md flex flex-col justify-between min-h-[220px]">
<div class="relative z-10">
<span class="text-surface-variant/80 font-label-caps text-label-caps uppercase tracking-widest">Solde Actuel</span>
<div class="flex items-baseline gap-xs mt-base">
<span class="text-primary-container font-display-lg text-display-lg">1.450.000</span>
<span class="text-primary-container font-headline-lg text-headline-lg">Ar</span>
</div>
</div>
<div class="relative z-10 flex justify-between items-center mt-xl">
<div class="flex gap-md">
<div>
<p class="text-surface-variant/60 text-xs uppercase">Entrées (Mois)</p>
<p class="text-primary-fixed-dim font-bold">+ 320k Ar</p>
</div>
<div>
<p class="text-surface-variant/60 text-xs uppercase">Sorties (Mois)</p>
<p class="text-error-container/80 font-bold">- 85k Ar</p>
</div>
</div>
<button class="material-symbols-outlined text-white opacity-50" data-icon="visibility">visibility</button>
</div>
<!-- Abstract decoration -->
<div class="absolute -right-10 -bottom-10 w-48 h-48 bg-primary-container/10 rounded-full blur-3xl"></div>
<div class="absolute right-10 top-5 w-24 h-24 bg-primary/20 rounded-full blur-2xl float-animation"></div>
</div>
<!-- Quick Stats -->
<div class="md:col-span-4 bg-surface-container rounded-xl p-md border border-outline-variant/30 flex flex-col gap-sm">
<div class="flex items-center justify-between p-sm bg-surface rounded-lg">
<div class="flex items-center gap-sm">
<div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center">
<span class="material-symbols-outlined text-on-secondary-container" data-icon="savings">savings</span>
</div>
<div>
<p class="text-xs text-outline">Épargne Aura</p>
<p class="font-bold text-on-surface">500.000 Ar</p>
</div>
</div>
<span class="material-symbols-outlined text-primary text-sm" data-icon="arrow_forward_ios">arrow_forward_ios</span>
</div>
<div class="flex items-center justify-between p-sm bg-surface rounded-lg">
<div class="flex items-center gap-sm">
<div class="w-10 h-10 rounded-full bg-tertiary-container flex items-center justify-center">
<span class="material-symbols-outlined text-on-tertiary-container" data-icon="stars">stars</span>
</div>
<div>
<p class="text-xs text-outline">Points Fidélité</p>
<p class="font-bold text-on-surface">1.240 pts</p>
</div>
</div>
<span class="material-symbols-outlined text-primary text-sm" data-icon="arrow_forward_ios">arrow_forward_ios</span>
</div>
</div>
</div>
<!-- Quick Actions Row -->
<div class="mt-lg grid grid-cols-3 gap-sm">
<button class="flex flex-col items-center justify-center gap-base p-md bg-primary-container text-on-primary-container rounded-xl shadow-sm active:scale-95 transition-all" onclick="openModal('dépôt')">
<span class="material-symbols-outlined text-headline-lg-mobile" data-icon="add_circle">add_circle</span>
<span class="font-label-caps text-label-caps">Dépôt</span>
</button>
<button class="flex flex-col items-center justify-center gap-base p-md bg-secondary text-on-secondary rounded-xl shadow-sm active:scale-95 transition-all" onclick="openModal('retrait')">
<span class="material-symbols-outlined text-headline-lg-mobile" data-icon="outbox">outbox</span>
<span class="font-label-caps text-label-caps">Retrait</span>
</button>
<button class="flex flex-col items-center justify-center gap-base p-md bg-surface-container-high text-on-surface rounded-xl shadow-sm active:scale-95 transition-all" onclick="openModal('transfert')">
<span class="material-symbols-outlined text-headline-lg-mobile" data-icon="send">send</span>
<span class="font-label-caps text-label-caps">Transfert</span>
</button>
</div>
<!-- Recent Transactions -->
<div class="mt-xl">
<div class="flex justify-between items-center mb-md">
<h3 class="font-title-md text-title-md">Activités Récentes</h3>
<button class="text-primary font-bold text-sm">Voir tout</button>
</div>
<div class="space-y-sm">
<!-- Transaction Row -->
<div class="flex items-center justify-between p-sm bg-white rounded-lg shadow-sm border border-outline-variant/10">
<div class="flex items-center gap-md">
<div class="w-12 h-12 bg-surface-container rounded-full flex items-center justify-center">
<span class="material-symbols-outlined text-secondary" data-icon="shopping_bag">shopping_bag</span>
</div>
<div>
<p class="font-bold text-on-surface">Jumbo Score</p>
<p class="text-xs text-outline">Aujourd'hui, 14:20</p>
</div>
</div>
<p class="text-secondary font-bold">- 45.000 Ar</p>
</div>
<div class="flex items-center justify-between p-sm bg-white rounded-lg shadow-sm border border-outline-variant/10">
<div class="flex items-center gap-md">
<div class="w-12 h-12 bg-surface-container rounded-full flex items-center justify-center">
<span class="material-symbols-outlined text-primary" data-icon="payments">payments</span>
</div>
<div>
<p class="font-bold text-on-surface">Dépôt Cash</p>
<p class="text-xs text-outline">Hier, 09:15</p>
</div>
</div>
<p class="text-primary font-bold">+ 100.000 Ar</p>
</div>
<div class="flex items-center justify-between p-sm bg-white rounded-lg shadow-sm border border-outline-variant/10">
<div class="flex items-center gap-md">
<div class="w-12 h-12 bg-surface-container rounded-full flex items-center justify-center">
<span class="material-symbols-outlined text-secondary" data-icon="smartphone">smartphone</span>
</div>
<div>
<p class="font-bold text-on-surface">Crédit Telma</p>
<p class="text-xs text-outline">22 Nov, 18:45</p>
</div>
</div>
<p class="text-secondary font-bold">- 5.000 Ar</p>
</div>
</div>
</div>
</main>
<!-- Bottom Navigation Shell -->
<nav class="fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-xs pb-sm pt-base shadow-md bg-surface rounded-t-xl" id="bottom-nav">
<div class="flex flex-col items-center justify-center bg-primary-container text-on-primary-container rounded-full px-sm py-base">
<span class="material-symbols-outlined" data-icon="home" style="font-variation-settings: 'FILL' 1;">home</span>
<span class="font-label-caps text-label-caps">Accueil</span>
</div>
<div class="flex flex-col items-center justify-center text-secondary">
<span class="material-symbols-outlined" data-icon="account_balance_wallet">account_balance_wallet</span>
<span class="font-label-caps text-label-caps">Transactions</span>
</div>
<div class="flex flex-col items-center justify-center text-secondary">
<span class="material-symbols-outlined" data-icon="grid_view">grid_view</span>
<span class="font-label-caps text-label-caps">Tarifs</span>
</div>
<div class="flex flex-col items-center justify-center text-secondary">
<span class="material-symbols-outlined" data-icon="person">person</span>
<span class="font-label-caps text-label-caps">Profil</span>
</div>
</nav>
<!-- Action Modal -->
<div class="fixed inset-0 z-[60] bg-black/40 backdrop-blur-sm flex items-end sm:items-center justify-center transition-opacity opacity-0 pointer-events-none p-container-margin" id="action-modal">
<div class="bg-surface w-full max-w-md rounded-t-2xl sm:rounded-2xl p-lg transform translate-y-full transition-transform">
<div class="flex justify-between items-center mb-lg">
<h3 class="font-title-md text-title-md capitalize" id="modal-title">Action</h3>
<button class="material-symbols-outlined p-base hover:bg-surface-container rounded-full" data-icon="close" onclick="closeModal()">close</button>
</div>
<div class="space-y-lg">
<div>
<label class="block text-xs font-bold text-outline uppercase mb-xs">Montant (Ar)</label>
<input class="w-full text-display-lg font-numeric-data border-none border-b-2 border-outline-variant focus:border-primary focus:ring-0 bg-transparent p-0 pb-xs" placeholder="0" type="number"/>
</div>
<div class="hidden animate-in fade-in duration-300" id="transfer-extra-fields">
<label class="block text-xs font-bold text-outline uppercase mb-xs">Destinataire</label>
<input class="w-full border-b-2 border-outline-variant focus:border-primary focus:ring-0 bg-transparent px-0 py-xs text-title-md font-numeric-data" placeholder="03x xx xxx xx" type="tel"/>
</div>
<div class="bg-surface-container-low p-sm rounded-lg flex items-center justify-between text-body-sm">
<span class="text-on-surface-variant">Frais de transaction</span>
<span class="font-bold text-on-surface">0 Ar</span>
</div>
<button class="w-full py-md bg-primary-container text-on-primary-container rounded-lg font-bold shadow-md active:scale-95 transition-all">
                    Confirmer l'opération
                </button>
</div>
</div>
</div>
<!-- Footer -->
<footer class="w-full flex flex-col items-center py-md px-container-margin mb-xl border-t border-outline-variant bg-surface-container-low" id="footer">
<div class="font-title-md text-primary mb-sm">Aura Finance</div>
<div class="flex gap-md mb-sm">
<a class="text-on-surface-variant text-body-sm hover:text-primary transition-colors" href="#">Sécurité</a>
<a class="text-on-surface-variant text-body-sm hover:text-primary transition-colors" href="#">Aide</a>
<a class="text-on-surface-variant text-body-sm hover:text-primary transition-colors" href="#">Conditions</a>
</div>
<p class="text-secondary text-body-sm opacity-80">© 2024 Aura Finance Madagascar.</p>
</footer>
<script>
        // Modal Logic
        function openModal(type) {
            const modal = document.getElementById('action-modal');
            const modalInner = modal.querySelector('div');
            const title = document.getElementById('modal-title');
            const extraFields = document.getElementById('transfer-extra-fields');

            title.innerText = type;
            if (type === 'transfert') {
                extraFields.classList.remove('hidden');
            } else {
                extraFields.classList.add('hidden');
            }

            modal.classList.remove('opacity-0', 'pointer-events-none');
            modalInner.classList.remove('translate-y-full');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('action-modal');
            const modalInner = modal.querySelector('div');

            modal.classList.add('opacity-0', 'pointer-events-none');
            modalInner.classList.add('translate-y-full');
            document.body.style.overflow = '';
        }

        // Close modal on backdrop click
        document.getElementById('action-modal').addEventListener('click', function (e) {
            if (e.target === this) closeModal();
        });
    </script>
</body></html>