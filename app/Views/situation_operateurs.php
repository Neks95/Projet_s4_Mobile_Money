<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Situation des Opérateurs | Aura Finance</title>
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

        <h1 class="text-headline-lg text-primary mb-base">Commissions Dues aux Opérateurs</h1>
        <p class="text-on-surface-variant font-body-sm mb-xl">Le principal transféré n'est ni ton argent ni celui de l'opérateur externe : seule la commission d'interconnexion lui est réellement due.</p>

        <?php
            $totalFonds = 0.0;
            $totalCommission = 0.0;
            foreach ($coefficients as $c) {
                $totalFonds += $c['fonds'];
                $totalCommission += $c['commission'];
            }
        ?>

        <!-- Cartes des scores / KPIs -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-md mb-xl">
            <div class="bg-blue-600 text-white p-md rounded-xl shadow-sm">
                <span class="text-blue-100 font-bold text-sm block mb-xs">Total Commission Due</span>
                <span class="text-headline-md font-bold text-white"><?= number_format($totalCommission, 0, ',', ' ') ?> Ar</span>
            </div>
            <div class="bg-white p-md rounded-xl border border-outline-variant shadow-sm">
                <span class="text-on-surface-variant font-bold text-sm block mb-xs">Volume Transféré (info)</span>
                <span class="text-headline-md font-bold text-on-surface-variant"><?= number_format($totalFonds, 0, ',', ' ') ?> Ar</span>
            </div>
            <div class="bg-white p-md rounded-xl border border-outline-variant shadow-sm">
                <span class="text-on-surface-variant font-bold text-sm block mb-xs">Nombre d'Opérateurs</span>
                <span class="text-headline-md font-bold text-primary"><?= count($coefficients) ?></span>
            </div>
        </div>

        <!-- Tableau par opérateur -->
        <section class="bg-white rounded-xl border border-outline-variant overflow-hidden shadow-sm">
            <div class="p-md border-b border-outline-variant">
                <h2 class="text-title-lg font-bold text-primary">Détail par Opérateur</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-outline-variant text-on-surface-variant text-sm font-bold">
                            <th class="p-md">Opérateur</th>
                            <th class="p-md text-right text-on-surface-variant">Volume Transféré (info)</th>
                            <th class="p-md text-right text-primary">Commission Due</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        <?php if (empty($coefficients)): ?>
                            <tr>
                                <td colspan="3" class="p-xl text-center text-on-surface-variant">Aucun transfert externe enregistré pour le moment.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($coefficients as $c): ?>
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="p-md font-medium"><?= esc($c['nom']) ?></td>
                                    <td class="p-md text-right text-on-surface-variant"><?= number_format($c['fonds'], 0, ',', ' ') ?> Ar</td>
                                    <td class="p-md text-right font-bold text-primary"><?= number_format($c['commission'], 0, ',', ' ') ?> Ar</td>
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