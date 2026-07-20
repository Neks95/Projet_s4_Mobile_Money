<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Situation des Gains | Aura Finance</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/css/aura-finance.css') ?>" rel="stylesheet" />
    <script src="<?= base_url('assets/js/tailwind-config.js') ?>"></script>
</head>

<body class="bg-surface font-body-lg text-on-surface min-h-screen p-md">
    <main class="max-w-5xl mx-auto py-xl">

        <a href="<?= base_url('operateur') ?>" class="inline-flex items-center gap-xs text-primary font-bold font-body-sm mb-md">
            <span class="material-symbols-outlined">arrow_back</span>
            Retour à la configuration
        </a>

        <h1 class="text-headline-lg text-primary mb-base">Situation des Gains</h1>
        <p class="text-on-surface-variant font-body-sm mb-xl">Suivi des commissions et frais générés par l'activité.</p>

        <!-- Cartes des scores / KPIs -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-md mb-xl">
            <div class="bg-white p-md rounded-xl border border-outline-variant shadow-sm">
                <span class="text-on-surface-variant font-bold text-sm block mb-xs">Gains sur Transferts</span>
                <span class="text-headline-md font-bold text-primary"><?= number_format($gain_transfert, 0, ',', ' ') ?> Ar</span>
            </div>
            <div class="bg-white p-md rounded-xl border border-outline-variant shadow-sm">
                <span class="text-on-surface-variant font-bold text-sm block mb-xs">Gains sur Retraits</span>
                <span class="text-headline-md font-bold text-secondary text-emerald-600"><?= number_format($gain_retrait, 0, ',', ' ') ?> Ar</span>
            </div>
            <div class="bg-primary text-white p-md rounded-xl shadow-sm bg-blue-600">
                <span class="text-blue-100 font-bold text-sm block mb-xs">Gain Total Obtenu</span>
                <span class="text-headline-md font-bold text-white"><?= number_format($gain_total, 0, ',', ' ') ?> Ar</span>
            </div>
        </div>

        <!-- Tableau des transactions -->
        <section class="bg-white rounded-xl border border-outline-variant overflow-hidden shadow-sm">
            <div class="p-md border-b border-outline-variant">
                <h2 class="text-title-lg font-bold text-primary">Historique des Transactions</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-outline-variant text-on-surface-variant text-sm font-bold">
                            <th class="p-md">Date</th>
                            <th class="p-md">Type d'opération</th>
                            <th class="p-md text-right">Montant</th>
                            <th class="p-md text-right text-primary">Frais / Gain</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        <?php if (empty($transactions)): ?>
                            <tr>
                                <td colspan="5" class="p-xl text-center text-on-surface-variant">Aucune transaction enregistrée pour le moment.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($transactions as $txn): ?>
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="p-md font-body-sm"><?= esc($txn['date_operation']) ?></td>
                                    <td class="p-md">
                                        <span class="px-sm py-xs rounded-full text-xs font-bold <?= $txn['id_type_operation'] == 1 ? 'bg-blue-50 text-blue-700' : 'bg-emerald-50 text-emerald-700' ?>">
                                            <?= esc($txn['libelle_op']) ?>
                                        </span>
                                    </td>
                                    <td class="p-md text-right font-medium"><?= number_format($txn['montant'], 0, ',', ' ') ?> Ar</td>
                                    <td class="p-md text-right font-bold text-primary"><?= number_format($txn['frais_generes'], 0, ',', ' ') ?> Ar</td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>

</html>