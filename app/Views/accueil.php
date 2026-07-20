<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Aura Finance - Accueil</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script src="<?= base_url('assets/js/tailwind-config.js') ?>"></script>
    <link href="<?= base_url('assets/css/aura-finance.css') ?>" rel="stylesheet" />
    <style>
        .frais-group {
            transition: all 0.3s ease;
        }

        .frais-group.show {
            opacity: 1;
            max-height: 200px;
        }

        .frais-group.hidden-custom {
            opacity: 0;
            max-height: 0;
            overflow: hidden;
            padding: 0 !important;
            margin: 0 !important;
            border: none !important;
        }
    </style>
</head>

<body class="bg-background text-on-background font-body-lg overflow-x-hidden min-h-screen">

    <!-- Top Navigation -->
    <header class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-container-margin py-xs shadow-sm bg-surface">
        <div class="font-headline-lg-mobile text-headline-lg-mobile font-bold text-primary">Aura Finance</div>
        <div class="flex items-center gap-sm">
            <a class="material-symbols-outlined text-secondary hover:bg-surface-container-high transition-colors p-base rounded-full" href="<?= base_url('logout') ?>">logout</a>
        </div>
    </header>

    <main class="pt-20 pb-28 px-container-margin max-w-[1200px] mx-auto w-full">
        <?php if (session()->has('error')): ?>
            <div class="mb-lg p-md bg-red-100 border border-red-400 text-red-700 rounded-lg text-center font-bold">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->has('success')): ?>
            <div class="mb-lg p-md bg-green-100 border border-green-400 text-green-700 rounded-lg text-center font-bold">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <!-- Welcome -->
        <div class="mb-lg">
            <h2 class="font-headline-lg-mobile text-headline-lg-mobile text-on-surface">
                Salama, <span class="text-primary"><?= esc($client['prenom']) ?></span>
            </h2>
            <p class="text-on-surface-variant text-body-sm">Voici l'aperçu de votre compte.</p>
        </div>

        <!-- Balance Card -->
        <div class="bg-inverse-surface rounded-xl p-lg relative overflow-hidden shadow-md flex flex-col justify-between min-h-[220px] mb-md">
            <div class="relative z-10">
                <span class="text-surface-variant/80 font-label-caps text-label-caps uppercase tracking-widest">Solde Actuel</span>
                <div class="flex items-baseline gap-xs mt-base">
                    <span class="text-primary-container font-display-lg text-display-lg"><?= number_format($client['solde'], 0, ',', '.') ?></span>
                    <span class="text-primary-container font-headline-lg text-headline-lg">Ar</span>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="grid grid-cols-3 gap-sm">
            <button class="flex flex-col items-center justify-center gap-base p-md bg-primary-container text-on-primary-container rounded-xl shadow-sm active:scale-95 transition-all" onclick="openModal('dépôt')">
                <span class="material-symbols-outlined" data-icon="add_circle">add_circle</span>
                <span class="font-label-caps text-label-caps">Dépôt</span>
            </button>
            <button class="flex flex-col items-center justify-center gap-base p-md bg-secondary text-on-secondary rounded-xl shadow-sm active:scale-95 transition-all" onclick="openModal('retrait')">
                <span class="material-symbols-outlined" data-icon="outbox">outbox</span>
                <span class="font-label-caps text-label-caps">Retrait</span>
            </button>
            <button class="flex flex-col items-center justify-center gap-base p-md bg-surface-container-high text-on-surface rounded-xl shadow-sm active:scale-95 transition-all" onclick="openModal('transfert')">
                <span class="material-symbols-outlined" data-icon="send">send</span>
                <span class="font-label-caps text-label-caps">Transfert</span>
            </button>
        </div>
        <div class="mt-xl">
            <h3 class="font-title-md text-title-md mb-md">Activités Récentes</h3>
            <a href="<?= base_url('client/historique') ?>" class="text-primary font-medium text-sm hover:underline">
                Voir tout
            </a>
            <div class="space-y-sm">
                <?php foreach ($activites as $op): ?>
                    <div class="flex items-center justify-between p-sm bg-white rounded-lg shadow-sm border border-outline-variant/10">
                        <div class="flex items-center gap-md">
                            <div class="w-12 h-12 bg-surface-container rounded-full flex items-center justify-center">
                                <span class="material-symbols-outlined text-primary">
                                    <?= $op['libelle'] == 'dépôt' ? 'add_circle' : ($op['libelle'] == 'retrait' ? 'outbox' : 'send') ?>
                                </span>
                            </div>
                            <div>
                                <p class="font-bold text-on-surface capitalize"><?= esc($op['libelle']) ?></p>
                                <p class="text-xs text-outline"><?= $op['date_operation'] ?></p>
                            </div>
                        </div>
                        <p class="text-primary font-bold">
                            <?= ($op['libelle'] == 'depot') ? '+' : '-' ?>
                            <?= number_format($op['montant'], 0, ',', '.') ?> Ar
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <!-- Action Modal -->
    <div class="fixed inset-0 z-[60] bg-black/40 backdrop-blur-sm flex items-end sm:items-center justify-center transition-opacity opacity-0 pointer-events-none p-container-margin" id="action-modal">
        <div class="bg-surface w-full max-w-md rounded-t-2xl sm:rounded-2xl p-lg transform translate-y-full transition-transform">
            <form action="" method="post" id="action-form">
                <?= csrf_field() ?>
                <input type="hidden" name="type_operation" id="type_op_input">
                <div class="flex justify-between items-center mb-lg">
                    <h3 class="font-title-md text-title-md capitalize" id="modal-title">Action</h3>
                    <button type="button" class="material-symbols-outlined p-base hover:bg-surface-container rounded-full" onclick="closeModal()">close</button>
                </div>

                <div class="space-y-lg">
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase mb-xs">Montant (Ar)</label>
                        <input name="montant" id="montant-input" class="w-full text-display-lg border-none border-b-2 border-outline-variant focus:border-primary bg-transparent p-0" placeholder="0" type="number" required />
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase mb-xs">Description</label>
                        <input name="description" id="description-input" class="w-full text-headline-sm border-none border-b-2 border-outline-variant focus:border-primary bg-transparent p-0" placeholder="Motif de l'opération..." type="text" />
                    </div>
                    <!-- Dans ton modal -->
                    <div id="destinataire-group" class="hidden">
                        <label class="block text-xs font-bold text-outline uppercase mb-xs">
                            Numéros Destinataires
                        </label>
                        <!-- Utilisation de textarea pour permettre la liste séparée par des virgules -->
                        <textarea name="destinataire" id="destinataire-input"
                            class="w-full text-headline-sm border-none border-b-2 border-outline-variant focus:border-primary bg-transparent p-0"
                            placeholder="033 XX XXX XX, 034 XX XXX XX"
                            required></textarea>
                        <span class="text-xs text-on-surface-variant/50 mt-xs block">
                            Séparez les numéros par une virgule (ex: 0331234567, 0337654321)
                        </span>
                    </div>



                    <!-- Frais de transfert - Visible UNIQUEMENT si le destinataire est un client Aura -->
                    <div id="frais-transfert-group" class="hidden p-sm rounded-lg" style="background: #fff8e1; border-left: 3px solid #ff9800;">
                        <div class="flex items-center gap-sm">
                            <input type="checkbox" name="inclure_frais_transfert" id="inclure_frais_input" class="rounded text-primary w-4 h-4" value="1">
                            <label for="inclure_frais_input" class="text-sm font-medium text-on-surface">
                                Les frais sont à ma charge
                            </label>
                        </div>
                        <p class="text-xs text-on-surface-variant/70 mt-xs ml-6">
                            <span class="material-symbols-outlined text-xs align-middle">info</span>
                            Si décoché, le destinataire paiera les frais.
                        </p>
                    </div>

                    <button type="submit" class="w-full py-md bg-primary-container text-on-primary-container rounded-lg font-bold shadow-md active:scale-95 transition-all">Confirmer</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('destinataire-input').addEventListener('input', function() {
    const val = this.value.replace(/\s/g, ''); // Enlève les espaces
    if (!val) return;

    const numeros = val.split(',').filter(n => n.length > 0);
    const fraisGroup = document.getElementById('frais-transfert-group');
    const checkbox = document.getElementById('inclure_frais_input');

    // Vérifie que TOUS les numéros de la liste commencent par un préfixe autorisé
    const tousInternes = numeros.every(num => 
        prefixesAura.some(pref => num.startsWith(pref))
    );

    // Mise à jour de l'affichage des frais
    if (tousInternes) {
        fraisGroup.classList.remove('hidden');
        checkbox.disabled = false;
    } else {
        fraisGroup.classList.add('hidden');
        checkbox.checked = false; // Réinitialise si on sort du mode interne
        checkbox.disabled = true;
    }
});
            // Récupération des préfixes depuis la session PHP
            const prefixesAura = <?= json_encode(session()->get('prefixes')) ?>;

            // Références aux éléments
            const destInput = document.getElementById('destinataire-input');
            const fraisGroup = document.getElementById('frais-transfert-group');
            const checkbox = document.getElementById('inclure_frais_input');
            const modalContent = document.getElementById('action-modal').querySelector('div');

            // Fonction pour vérifier si le numéro appartient à un client Aura
            function estClientAura(numero) {
                if (!numero || numero.length < 3) return false;
                // Supprimer les espaces et caractères non numériques
                const cleanNumero = numero.replace(/\s/g, '');
                // Vérifier si le numéro commence par un des préfixes
                return prefixesAura.some(pref => cleanNumero.startsWith(pref));
            }

            // Fonction pour mettre à jour l'affichage du checkbox
            function mettreAJourAffichage() {
                if (!destInput) return;

                const numero = destInput.value;
                const estValide = estClientAura(numero);

                if (estValide) {
                    // Client Aura : afficher le checkbox et l'activer
                    destInput.style.borderColor = '#4caf50';
                    fraisGroup.classList.remove('hidden');
                    checkbox.disabled = false;
                    checkbox.checked = true;
                } else if (numero.length === 0) {
                    // Champ vide : cacher le checkbox
                    destInput.style.borderColor = '';
                    fraisGroup.classList.add('hidden');
                    checkbox.checked = false;
                    checkbox.disabled = true;
                } else {
                    // Numéro invalide : cacher le checkbox
                    destInput.style.borderColor = '#f44336';
                    fraisGroup.classList.add('hidden');
                    checkbox.checked = false;
                    checkbox.disabled = true;
                }
            }

            // Attacher l'événement input
            if (destInput) {
                destInput.addEventListener('input', mettreAJourAffichage);
                // Appel initial pour vérifier si un numéro est déjà présent
                mettreAJourAffichage();
            }

            // Fonction pour ouvrir le modal
            window.openModal = function(type) {
                const title = document.getElementById('modal-title');
                const typeInput = document.getElementById('type_op_input');
                const destGroup = document.getElementById('destinataire-group');
                const destInputEl = document.getElementById('destinataire-input');
                const form = document.getElementById('action-form');

                // Mise à jour du titre
                title.innerText = type;
                typeInput.value = type;

                // Gestion de l'affichage du champ destinataire
                if (type === 'transfert') {
                    destGroup.classList.remove('hidden');
                    destInputEl.setAttribute('required', 'required');
                    destInputEl.value = '';
                    destInputEl.style.borderColor = '';

                    // Réinitialiser le checkbox (désactivé par défaut)
                    const fraisCheckbox = document.getElementById('inclure_frais_input');
                    const fraisGroupEl = document.getElementById('frais-transfert-group');
                    fraisGroupEl.classList.add('hidden');
                    fraisCheckbox.checked = false;
                    fraisCheckbox.disabled = true;

                } else {
                    destGroup.classList.add('hidden');
                    destInputEl.removeAttribute('required');
                    destInputEl.value = '';
                    destInputEl.style.borderColor = '';

                    // Cacher le checkbox pour les autres types
                    const fraisGroupEl = document.getElementById('frais-transfert-group');
                    const fraisCheckbox = document.getElementById('inclure_frais_input');
                    fraisGroupEl.classList.add('hidden');
                    fraisCheckbox.checked = false;
                    fraisCheckbox.disabled = true;
                }

                // Mise à jour de l'action du formulaire
                const actions = {
                    'dépôt': "<?= base_url('client/depot') ?>",
                    'retrait': "<?= base_url('client/retrait') ?>",
                    'transfert': "<?= base_url('client/transfert') ?>"
                };
                form.action = actions[type] || '';

                // Ouvrir le modal avec animation
                const modal = document.getElementById('action-modal');
                modal.classList.remove('opacity-0', 'pointer-events-none');
                setTimeout(() => {
                    modalContent.classList.remove('translate-y-full');
                }, 10);
            };

            // Fonction pour fermer le modal
            window.closeModal = function() {
                const modal = document.getElementById('action-modal');
                modalContent.classList.add('translate-y-full');
                setTimeout(() => {
                    modal.classList.add('opacity-0', 'pointer-events-none');
                }, 300);
            };

            // Fermeture avec Échap
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    window.closeModal();
                }
            });

            document.getElementById('action-modal').addEventListener('click', function(e) {
                if (e.target === this) {
                    window.closeModal();
                }
            });
        });
    </script>

</body>

</html>