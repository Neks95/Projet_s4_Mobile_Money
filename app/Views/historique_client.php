<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Aura Finance - Historique</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
        <script src="<?= base_url('assets/js/tailwind-config.js') ?>"></script>
    <link href="<?= base_url('assets/css/aura-finance.css') ?>" rel="stylesheet" />
</head>
<body class="bg-surface text-on-surface">

<header class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-container-margin py-xs shadow-sm bg-surface">
    <a class="font-bold text-primary text-xl" href="<?= base_url('client/home') ?>">Aura Finance</a>
</header>

<main class="pt-24 pb-32 px-container-margin max-w-5xl mx-auto">
    <div class="mb-lg">
        <h1 class="font-headline-lg text-headline-lg text-on-surface">Historique</h1>
        <p class="text-on-surface-variant">Suivez toutes vos opérations.</p>
    </div>

    <!-- Tableau Dynamique -->
    <div class="bg-surface rounded-xl shadow-sm border border-outline-variant overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-primary text-on-primary">
                        <th class="px-sm py-md font-label-caps uppercase">Date</th>
                        <th class="px-sm py-md font-label-caps uppercase">Type</th>
                        <th class="px-sm py-md font-label-caps uppercase text-right">Montant</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    <?php if (!empty($transactions)): ?>
                        <?php foreach ($transactions as $op): ?>
                        <tr class="hover:bg-surface-container transition-colors">
                            <td class="px-sm py-md">
                                <div class="font-body-sm"><?= date('d/m/Y', strtotime($op['date_operation'])) ?></div>
                                <div class="text-[12px] text-on-surface-variant"><?= date('H:i', strtotime($op['date_operation'])) ?></div>
                            </td>
                            <td class="px-sm py-md">
                                <div class="flex items-center gap-xs">
                                    <span class="material-symbols-outlined text-primary">
                                        <?= $op['libelle'] == 'dépôt' ? 'payments' : ($op['libelle'] == 'retrait' ? 'account_balance_wallet' : 'send') ?>
                                    </span>
                                    <span class="font-body-sm capitalize"><?= esc($op['libelle']) ?></span>
                                </div>
                            </td>
                            <td class="px-sm py-md text-right font-bold <?= ($op['libelle'] == 'dépôt') ? 'text-[#2e7d32]' : 'text-error' ?>">
                                <?= ($op['libelle'] == 'dépôt') ? '+' : '-' ?> <?= number_format($op['montant'], 0, ',', '.') ?> Ar
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="px-sm py-xl text-center text-on-surface-variant">Aucune transaction trouvée.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<nav class="md:hidden fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-xs pb-sm pt-base bg-surface shadow-md">
    <a href="<?= base_url('client/home') ?>" class="flex flex-col items-center text-secondary">
        <span class="material-symbols-outlined">home</span>
        <span class="text-[10px]">Accueil</span>
    </a>
    <a href="<?= base_url('client/historique') ?>" class="flex flex-col items-center text-primary">
        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">account_balance_wallet</span>
        <span class="text-[10px]">Historique</span>
    </a>
</nav>

</body>
</html>