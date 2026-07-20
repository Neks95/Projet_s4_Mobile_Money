<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Aura Finance - Connexion</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="<?= base_url('assets/css/aura-finance.css') ?>" rel="stylesheet"/>
<script src="<?= base_url('assets/js/tailwind-config.js') ?>"></script>
</head>
<body class="bg-background text-on-background font-body-lg overflow-x-hidden min-h-screen">
<!-- Login Screen -->
<div class="min-h-screen bg-surface flex flex-col items-center justify-center px-container-margin" id="login-screen">
<div class="w-full max-w-sm flex flex-col items-center">
<!-- Brand Identity -->
<div class="mb-xl text-center">
<div class="text-primary font-bold font-headline-lg-mobile text-headline-lg-mobile mb-xs">Aura Finance</div>
<div class="text-secondary font-body-sm text-body-sm">Sécurisé • Rapide • Malagasy</div>
</div>
<div class="bg-surface-container rounded-xl p-md shadow-sm w-full border border-outline-variant/30">
<h1 class="font-title-md text-title-md mb-md text-on-surface">Bienvenue</h1>
<form action="<?= base_url('connexion') ?>" class="space-y-md" id="login-form" method="post">
<?php if (function_exists('csrf_field')): ?>
    <?= csrf_field() ?>
<?php endif; ?>
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
<p class="mt-xl text-outline text-center text-body-sm font-body-sm">
    Se connecter en tant qu'<span class="text-primary font-bold cursor-pointer">Opérateur</span>
</p>
</div>
</div>
<script>
        // Validation côté client + redirection vers la page d'accueil.
        // La validation réelle (authentification, session) doit être faite
        // côté serveur (contrôleur CI4) ; ce script ne fait qu'une
        // vérification de forme avant l'envoi du formulaire.
        document.getElementById('login-form').addEventListener('submit', function (e) {
            const phone = document.getElementById('phone').value;
            const validPrefixes = ['32', '33', '34', '38'];
            const prefix = phone.substring(0, 2);
            const error = document.getElementById('phone-error');

            if (phone.length === 9 && validPrefixes.includes(prefix)) {
                error.classList.add('hidden');
                // Le formulaire est soumis normalement (POST) vers le
                // contrôleur de connexion, qui redirigera ensuite vers
                // la page d'accueil (accueil.php) une fois authentifié.
            } else {
                e.preventDefault();
                error.classList.remove('hidden');
                this.classList.add('animate-shake');
                setTimeout(() => this.classList.remove('animate-shake'), 400);
            }
        });
    </script>
</body></html>