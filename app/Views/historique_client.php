<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Aura Finance - Historique</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script src="<?= base_url('assets/js/tailwind-config.js') ?>"></script>
    <link href="<?= base_url('assets/css/aura-finance.css') ?>" rel="stylesheet" />
    <style>
        .transaction-enter {
            animation: slideUp 0.3s ease-out forwards;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .transaction-enter:nth-child(1) { animation-delay: 0.05s; }
        .transaction-enter:nth-child(2) { animation-delay: 0.10s; }
        .transaction-enter:nth-child(3) { animation-delay: 0.15s; }
        .transaction-enter:nth-child(4) { animation-delay: 0.20s; }
        .transaction-enter:nth-child(5) { animation-delay: 0.25s; }
        .transaction-enter:nth-child(6) { animation-delay: 0.30s; }
        .transaction-enter:nth-child(7) { animation-delay: 0.35s; }
        .transaction-enter:nth-child(8) { animation-delay: 0.40s; }
        .transaction-enter:nth-child(9) { animation-delay: 0.45s; }
        .transaction-enter:nth-child(10) { animation-delay: 0.50s; }
        
        .frais-badge {
            font-size: 0.65rem;
            padding: 0.15rem 0.5rem;
            border-radius: 9999px;
            display: inline-block;
            font-weight: 600;
        }
    </style>
</head>

<body class="bg-surface text-on-surface min-h-screen">

    <header class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-container-margin py-xs shadow-sm bg-surface">
        <a class="font-bold text-primary text-xl flex items-center gap-xs" href="<?= base_url('client/home') ?>">
            <span class="material-symbols-outlined">account_balance</span>
            Aura Finance
        </a>
        <a class="material-symbols-outlined text-secondary hover:bg-surface-container-high transition-colors p-base rounded-full" href="<?= base_url('logout') ?>">logout</a>
    </header>

    <main class="pt-24 pb-32 px-container-margin max-w-6xl mx-auto">
        <div class="mb-lg">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-sm">
                <div>
                    <h1 class="font-headline-lg text-headline-lg text-on-surface">Historique</h1>
                    <p class="text-on-surface-variant">Suivez toutes vos opérations en temps réel.</p>
                </div>
                <div class="flex gap-sm">
                    <button onclick="window.location.reload()" class="flex items-center gap-xs px-md py-sm bg-surface-container-high rounded-lg hover:bg-surface-container transition-colors">
                        <span class="material-symbols-outlined text-sm">refresh</span>
                        <span class="text-sm font-medium hidden sm:inline">Actualiser</span>
                    </button>
                    <a href="<?= base_url('client/home') ?>" class="flex items-center gap-xs px-md py-sm bg-primary-container text-on-primary-container rounded-lg hover:opacity-90 transition-opacity">
                        <span class="material-symbols-outlined text-sm">arrow_back</span>
                        <span class="text-sm font-medium hidden sm:inline">Retour</span>
                    </a>
                </div>
            </div>
            
            <?php if (!empty($transactions)): 
                $totalDepots = 0;
                $totalRetraits = 0;
                $totalTransferts = 0;
                $totalFrais = 0;
                foreach ($transactions as $op) {
                    if ($op['libelle'] == 'depot') {
                        $totalDepots += $op['montant'];
                    } elseif ($op['libelle'] == 'retrait') {
                        $totalRetraits += $op['montant'];
                    } elseif ($op['libelle'] == 'transfert') {
                        $totalTransferts += $op['montant'];
                    }
                    $totalFrais += $op['frais_applique'] ?? 0;
                }
            ?>
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-sm mt-md">
                <div class="bg-green-50 p-sm rounded-lg text-center">
                    <div class="text-xs text-green-700 font-medium uppercase">Total Dépôts</div>
                    <div class="text-lg font-bold text-green-800"><?= number_format($totalDepots, 0, ',', '.') ?> Ar</div>
                </div>
                <div class="bg-red-50 p-sm rounded-lg text-center">
                    <div class="text-xs text-red-700 font-medium uppercase">Total Retraits</div>
                    <div class="text-lg font-bold text-red-800"><?= number_format($totalRetraits, 0, ',', '.') ?> Ar</div>
                </div>
                <div class="bg-blue-50 p-sm rounded-lg text-center">
                    <div class="text-xs text-blue-700 font-medium uppercase">Total Transferts</div>
                    <div class="text-lg font-bold text-blue-800"><?= number_format($totalTransferts, 0, ',', '.') ?> Ar</div>
                </div>
                <div class="bg-orange-50 p-sm rounded-lg text-center">
                    <div class="text-xs text-orange-700 font-medium uppercase">Total Frais</div>
                    <div class="text-lg font-bold text-orange-800"><?= number_format($totalFrais, 0, ',', '.') ?> Ar</div>
                </div>
                <div class="bg-purple-50 p-sm rounded-lg text-center">
                    <div class="text-xs text-purple-700 font-medium uppercase">Total Opérations</div>
                    <div class="text-lg font-bold text-purple-800"><?= count($transactions) ?></div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Filtres -->
        <div class="flex flex-wrap gap-sm mb-md">
            <button onclick="filterTable('all')" class="filter-btn px-md py-sm rounded-full bg-primary text-on-primary text-sm font-medium transition-all" data-filter="all">
                Tous
            </button>
            <button onclick="filterTable('depot')" class="filter-btn px-md py-sm rounded-full bg-surface-container-high text-on-surface text-sm font-medium transition-all hover:bg-primary-container" data-filter="depot">
                <span class="material-symbols-outlined text-sm align-middle">payments</span> Dépôts
            </button>
            <button onclick="filterTable('retrait')" class="filter-btn px-md py-sm rounded-full bg-surface-container-high text-on-surface text-sm font-medium transition-all hover:bg-primary-container" data-filter="retrait">
                <span class="material-symbols-outlined text-sm align-middle">account_balance_wallet</span> Retraits
            </button>
            <button onclick="filterTable('transfert')" class="filter-btn px-md py-sm rounded-full bg-surface-container-high text-on-surface text-sm font-medium transition-all hover:bg-primary-container" data-filter="transfert">
                <span class="material-symbols-outlined text-sm align-middle">send</span> Transferts
            </button>
        </div>

        <!-- Tableau Dynamique -->
        <div class="bg-surface rounded-xl shadow-sm border border-outline-variant overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse" id="history-table">
                    <thead>
                        <tr class="bg-primary text-on-primary">
                            <th class="px-sm py-md font-label-caps uppercase text-xs tracking-wider">Date & Heure</th>
                            <th class="px-sm py-md font-label-caps uppercase text-xs tracking-wider">Type</th>
                            <th class="px-sm py-md font-label-caps uppercase text-xs tracking-wider text-right">Montant</th>
                            <th class="px-sm py-md font-label-caps uppercase text-xs tracking-wider text-right hidden sm:table-cell">Frais</th>
                            <th class="px-sm py-md font-label-caps uppercase text-xs tracking-wider text-right hidden md:table-cell">Total</th>
                            <th class="px-sm py-md font-label-caps uppercase text-xs tracking-wider text-right hidden lg:table-cell">Description</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant" id="table-body">
                        <?php if (!empty($transactions)): ?>
                            <?php 
                            foreach ($transactions as $op): 
                                $isDepot = ($op['libelle'] == 'depot');
                                $isRetrait = ($op['libelle'] == 'retrait');
                                $isTransfert = ($op['libelle'] == 'transfert');
                                $rowClass = $isDepot ? 'bg-green-50/30' : ($isRetrait ? 'bg-red-50/30' : 'bg-blue-50/30');
                                $frais = $op['frais_applique'] ?? 0;
                                $totalOperation = $isDepot ? $op['montant'] : ($op['montant'] + $frais);
                            ?>
                                <tr class="transaction-enter hover:bg-surface-container transition-colors <?= $rowClass ?>" data-type="<?= esc($op['libelle']) ?>">
                                    <td class="px-sm py-md">
                                        <div class="font-body-sm font-medium"><?= date('d/m/Y', strtotime($op['date_operation'])) ?></div>
                                        <div class="text-[11px] text-on-surface-variant"><?= date('H:i', strtotime($op['date_operation'])) ?></div>
                                    </td>
                                    <td class="px-sm py-md">
                                        <div class="flex items-center gap-xs">
                                            <span class="material-symbols-outlined text-sm <?= $isDepot ? 'text-green-700' : ($isRetrait ? 'text-red-600' : 'text-blue-600') ?>">
                                                <?= $isDepot ? 'payments' : ($isRetrait ? 'account_balance_wallet' : 'send') ?>
                                            </span>
                                            <span class="font-body-sm capitalize font-medium <?= $isDepot ? 'text-green-800' : ($isRetrait ? 'text-red-800' : 'text-blue-800') ?>">
                                                <?= esc($op['libelle']) ?>
                                            </span>
                                            <!-- Badge de frais : affiché uniquement pour les transferts et si frais > 0 -->
                                            <?php if ($frais > 0 && $isTransfert): ?>
                                                <span class="frais-badge bg-orange-100 text-orange-800 ml-xs">
                                                    +<?= number_format($frais, 0, ',', '.') ?> Ar
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="px-sm py-md text-right font-bold <?= $isDepot ? 'text-green-700' : 'text-red-600' ?>">
                                        <?= $isDepot ? '+' : '-' ?>
                                        <?= number_format($op['montant'], 0, ',', '.') ?> Ar
                                    </td>
                                    <td class="px-sm py-md text-right text-sm text-orange-600 font-medium hidden sm:table-cell">
                                        <?php if ($frais > 0): ?>
                                            <?= number_format($frais, 0, ',', '.') ?> Ar
                                        <?php else: ?>
                                            <span class="text-on-surface-variant/50">—</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-sm py-md text-right font-bold hidden md:table-cell <?= $isDepot ? 'text-green-700' : 'text-red-600' ?>">
                                        <?= $isDepot ? '+' : '-' ?>
                                        <?= number_format($totalOperation, 0, ',', '.') ?> Ar
                                    </td>
                                    <td class="px-sm py-md text-right text-sm text-on-surface-variant hidden lg:table-cell max-w-[150px] truncate">
                                        <?= !empty($op['description']) ? esc($op['description']) : '—' ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="px-sm py-xl text-center text-on-surface-variant">
                                    <span class="material-symbols-outlined text-4xl block mb-sm opacity-50">history</span>
                                    Aucune transaction trouvée.
                                    <div class="text-sm mt-xs">Effectuez votre première opération dès maintenant.</div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <?php if (!empty($transactions)): ?>
            <div class="px-sm py-md border-t border-outline-variant flex justify-between items-center text-xs text-on-surface-variant">
                <span>Affichage de <strong><?= count($transactions) ?></strong> transaction<?= count($transactions) > 1 ? 's' : '' ?></span>
               
            </div>
            <?php endif; ?>
        </div>
    </main>

    <nav class="md:hidden fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-xs pb-sm pt-base bg-surface shadow-md border-t border-outline-variant">
        <a href="<?= base_url('client/home') ?>" class="flex flex-col items-center text-secondary hover:text-primary transition-colors">
            <span class="material-symbols-outlined">home</span>
            <span class="text-[10px]">Accueil</span>
        </a>
        <a href="<?= base_url('client/historique') ?>" class="flex flex-col items-center text-primary">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">account_balance_wallet</span>
            <span class="text-[10px] font-bold">Historique</span>
        </a>
    </nav>

    <script>
        function filterTable(type) {
            const rows = document.querySelectorAll('#table-body tr');
            const buttons = document.querySelectorAll('.filter-btn');
            
            buttons.forEach(btn => {
                btn.classList.remove('bg-primary', 'text-on-primary');
                btn.classList.add('bg-surface-container-high', 'text-on-surface');
                if (btn.dataset.filter === type) {
                    btn.classList.remove('bg-surface-container-high', 'text-on-surface');
                    btn.classList.add('bg-primary', 'text-on-primary');
                }
            });
            
            if (type === 'all') {
                rows.forEach(row => {
                    row.style.display = '';
                });
                return;
            }
            
            rows.forEach(row => {
                if (row.dataset.type === type) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('.transaction-enter');
            rows.forEach((row, index) => {
                row.style.animationDelay = `${(index * 0.05)}s`;
            });
        });
    </script>

</body>

</html>