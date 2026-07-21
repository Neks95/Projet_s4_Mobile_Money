<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Situation des Comptes Clients - Aura Finance</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="<?= base_url('assets/js/tailwind-config.js') ?>"></script>
    <link href="<?= base_url('assets/css/aura-finance.css') ?>" rel="stylesheet" />
</head>

<body class="bg-gray-50 text-gray-800 font-sans min-h-screen">

    <div class="max-w-7xl mx-auto px-4 py-8">

        <!-- En-tête -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 pb-4 border-b border-gray-200">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Situation des Comptes</h1>
                <p class="text-sm text-gray-500 mt-1">Suivi des soldes et des parcs clients par opérateur.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                    Mise à jour en temps réel
                </span>
            </div>
        </div>

        <!-- Cartes Résumé -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-xs border border-gray-200 flex flex-col justify-between">
                <span class="text-sm font-medium text-gray-500 uppercase tracking-wider">Volume total des soldes</span>
                <span class="text-3xl font-bold text-indigo-600 mt-2">
                    <?= number_format($total_soldes, 0, ',', ' ') ?> <span class="text-xl font-semibold">Ar</span>
                </span>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-xs border border-gray-200 flex flex-col justify-between">
                <span class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total clients actifs</span>
                <span class="text-3xl font-bold text-gray-900 mt-2">
                    <?= $total_clients ?> <span class="text-xl font-normal text-gray-500">utilisateurs</span>
                </span>
            </div>
        </div>

        <!-- Tableau des Comptes -->
        <div class="bg-white rounded-2xl shadow-xs border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold uppercase tracking-wider text-gray-600">
                            <th class="px-6 py-4">Client</th>
                            <th class="px-6 py-4">Numéro de Téléphone</th>
                            <th class="px-6 py-4 text-right">Solde Actuel</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        <?php if (!empty($clients)): ?>
                            <?php foreach ($clients as $c): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-gray-950">
                                        <?= esc($c['nom']) ?> <?= esc($c['prenom']) ?>
                                    </td>
                                    <td class="px-6 py-4 font-mono text-gray-600">
                                        <?= esc($client_phone = $c['numero_telephone']) ?>
                                    </td>
                                    <td class="px-6 py-4 text-right font-semibold <?= $c['solde'] < 10000 ? 'text-amber-600' : 'text-gray-900' ?>">
                                        <?= number_format($c['solde'], 2, ',', ' ') ?> Ar
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-400 italic">
                                    Aucun client enregistré pour le moment.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>

</html>