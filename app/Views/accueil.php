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
                        <input name="montant" class="w-full text-display-lg border-none border-b-2 border-outline-variant focus:border-primary bg-transparent p-0" placeholder="0" type="number" required />
                    </div>

                    <!-- Nouveau champ Description -->
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase mb-xs">Description</label>
                        <input name="description" id="description-input" class="w-full text-headline-sm border-none border-b-2 border-outline-variant focus:border-primary bg-transparent p-0" placeholder="Motif de l'opération..." type="text" />
                    </div>

                    <div id="destinataire-group" class="hidden">
                        <label class="block text-xs font-bold text-outline uppercase mb-xs">Numéro Destinataire</label>
                        <input name="destinataire" id="destinataire-input" class="w-full text-headline-sm border-none border-b-2 border-outline-variant focus:border-primary bg-transparent p-0" placeholder="03X XX XXX XX" type="text" />
                    </div>
                    <button type="submit" class="w-full py-md bg-primary-container text-on-primary-container rounded-lg font-bold shadow-md active:scale-95 transition-all">Confirmer</button>
                </div>
            </form>
        </div>
    </div>


   <script>
    function openModal(type) {
        document.getElementById('modal-title').innerText = type;
        document.getElementById('type_op_input').value = type;

        const destGroup = document.getElementById('destinataire-group');
        const destInput = document.getElementById('destinataire-input');

        if (type === 'transfert') {
            destGroup.classList.remove('hidden');
            destInput.setAttribute('required', 'required');
        } else {
            destGroup.classList.add('hidden');
            destInput.removeAttribute('required');
        }

        const form = document.getElementById('action-form');
        if (type === 'dépôt') {
            form.action = "<?= base_url('client/depot') ?>";
        } else if (type === 'retrait') {
            form.action = "<?= base_url('client/retrait') ?>";
        } else if (type === 'transfert') {
            form.action = "<?= base_url('client/transfert') ?>";
        }

        document.getElementById('action-modal').classList.remove('opacity-0', 'pointer-events-none');
        document.getElementById('action-modal').querySelector('div').classList.remove('translate-y-full');
    }

    function closeModal() {
        document.getElementById('action-modal').classList.add('opacity-0', 'pointer-events-none');
        document.getElementById('action-modal').querySelector('div').classList.add('translate-y-full');
    }
</script>

            

        
</body>

</html>