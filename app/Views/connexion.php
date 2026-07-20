<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Aura Finance - Portail Client</title>
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
                },
            },
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .hide-scroll::-webkit-scrollbar { display: none; }
        .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .float-animation { animation: float 4s ease-in-out infinite; }
        
        #dashboard { display: none; }
        #login-screen { display: flex; }
    </style>
</head>
<body class="bg-background text-on-background font-body-lg overflow-x-hidden min-h-screen">
<!-- Login Screen -->
<div class="fixed inset-0 z-[100] bg-surface flex flex-col items-center justify-center px-container-margin" id="login-screen">
<div class="w-full max-w-sm flex flex-col items-center">
<!-- Brand Identity -->
<div class="mb-xl text-center">
<div class="text-primary font-bold font-headline-lg-mobile text-headline-lg-mobile mb-xs">Aura Finance</div>
<div class="text-secondary font-body-sm text-body-sm">Sécurisé • Rapide • Malagasy</div>
</div>
<div class="bg-surface-container rounded-xl p-md shadow-sm w-full border border-outline-variant/30">
<h1 class="font-title-md text-title-md mb-md text-on-surface">Bienvenue</h1>
<form class="space-y-md" id="login-form">
<div class="relative">
<label class="block text-xs font-bold text-outline mb-base uppercase tracking-wider" for="phone">Numéro de téléphone</label>
<div class="flex items-center border-b-2 border-outline-variant focus-within:border-primary transition-all pb-base">
<span class="text-on-surface-variant font-numeric-data text-numeric-data pr-xs">+261</span>
<input class="bg-transparent border-none focus:ring-0 w-full font-numeric-data text-numeric-data p-0 placeholder:text-outline-variant/50" id="phone" maxlength="9" name="phone" placeholder="3x xx xxx xx" required="" type="tel"/>
</div>
<p class="text-error text-xs mt-base hidden" id="phone-error">Veuillez saisir un numéro valide (Telma, Orange, Airtel).</p>
</div>
<button class="w-full py-md bg-primary-container text-on-primary-container rounded-lg font-bold shadow-md hover:brightness-110 active:scale-95 transition-all" type="submit">
                        Se connecter
                    </button>
</form>
</div>
<p class="mt-xl text-outline text-center text-body-sm font-body-sm">
                En vous connectant, vous acceptez nos <br/> <span class="text-primary font-bold cursor-pointer">Conditions d'utilisation</span>
</p>
</div>
</div>
<!-- Main Navigation Shell (TopAppBar) -->
<header class="hidden fixed top-0 left-0 w-full z-50 flex justify-between items-center px-container-margin py-xs shadow-sm bg-surface" id="top-bar">
<div class="font-headline-lg-mobile text-headline-lg-mobile font-bold text-primary">Aura Finance</div>
<div class="flex items-center gap-sm">
<button class="material-symbols-outlined text-secondary hover:bg-surface-container-high transition-colors p-base rounded-full" data-icon="notifications">notifications</button>
<button class="material-symbols-outlined text-secondary hover:bg-surface-container-high transition-colors p-base rounded-full" data-icon="account_circle" onclick="toggleScreen('login-screen')">account_circle</button>
</div>
</header>
<!-- Content Canvas (Dashboard) -->
<main class="pt-20 pb-28 px-container-margin max-w-[1200px] mx-auto w-full" id="dashboard">
<!-- Welcome Section -->
<div class="mb-lg">
<h2 class="font-headline-lg-mobile text-headline-lg-mobile text-on-surface">Salama, <span class="text-primary" id="user-phone-display">Mpanjifa</span></h2>
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
<nav class="hidden fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-xs pb-sm pt-base shadow-md bg-surface rounded-t-xl" id="bottom-nav">
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
<footer class="hidden w-full flex flex-col items-center py-md px-container-margin mb-xl border-t border-outline-variant bg-surface-container-low" id="footer">
<div class="font-title-md text-primary mb-sm">Aura Finance</div>
<div class="flex gap-md mb-sm">
<a class="text-on-surface-variant text-body-sm hover:text-primary transition-colors" href="#">Sécurité</a>
<a class="text-on-surface-variant text-body-sm hover:text-primary transition-colors" href="#">Aide</a>
<a class="text-on-surface-variant text-body-sm hover:text-primary transition-colors" href="#">Conditions</a>
</div>
<p class="text-secondary text-body-sm opacity-80">© 2024 Aura Finance Madagascar.</p>
</footer>
<script>
        // Toggle Screens
        function toggleScreen(screenId) {
            const login = document.getElementById('login-screen');
            const dashboard = document.getElementById('dashboard');
            const nav = document.getElementById('bottom-nav');
            const topBar = document.getElementById('top-bar');
            const footer = document.getElementById('footer');

            if (screenId === 'dashboard') {
                login.classList.add('hidden');
                login.style.display = 'none';
                dashboard.style.display = 'block';
                nav.classList.remove('hidden');
                topBar.classList.remove('hidden');
                footer.classList.remove('hidden');
                window.scrollTo(0, 0);
            } else {
                login.classList.remove('hidden');
                login.style.display = 'flex';
                dashboard.style.display = 'none';
                nav.classList.add('hidden');
                topBar.classList.add('hidden');
                footer.classList.add('hidden');
            }
        }

        // Login Logic
        document.getElementById('login-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const phone = document.getElementById('phone').value;
            const validPrefixes = ['32', '33', '34', '38'];
            const prefix = phone.substring(0, 2);
            const error = document.getElementById('phone-error');

            if (phone.length === 9 && validPrefixes.includes(prefix)) {
                error.classList.add('hidden');
                document.getElementById('user-phone-display').innerText = '0' + phone;
                toggleScreen('dashboard');
            } else {
                error.classList.remove('hidden');
                this.classList.add('animate-shake');
                setTimeout(() => this.classList.remove('animate-shake'), 400);
            }
        });

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
        document.getElementById('action-modal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
    </script>
</body></html>