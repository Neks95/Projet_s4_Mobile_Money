<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Configuration Opérateur | Aura Finance</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="<?= base_url('assets/css/aura-finance.css') ?>" rel="stylesheet" />
    <script src="<?= base_url('assets/js/tailwind-config.js') ?>"></script>
</head>

<body class="bg-surface font-body-lg text-on-surface min-h-screen pb-24 md:pb-0">
    <!-- Top Navigation Bar -->
    <header class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-container-margin py-xs shadow-sm bg-surface">
        <div class="flex items-center gap-sm">
            <span class="font-headline-lg-mobile text-headline-lg-mobile font-bold text-primary">Aura Finance</span>
            <div class="hidden md:flex gap-md ml-xl">
                <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="#">Accueil</a>
                <a class="text-primary font-bold border-b-2 border-primary" href="#">Configuration</a>
                <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="#">Transactions</a>
                <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="#">Rapports</a>
            </div>
        </div>
    </header>

    <main class="pt-24 px-container-margin max-w-[1200px] mx-auto pb-12">
        <div class="mb-lg">
            <h1 class="font-headline-lg text-headline-lg text-primary mb-base">Configuration de l'Opérateur</h1>
            <p class="text-on-surface-variant font-body-sm">Paramétrez les préfixes mobiles, types d'opérations et barèmes de frais pour Madagascar.</p>
        </div>

        <div class="bento-grid grid grid-cols-12 gap-6">

            <!-- SECTION 1 : Préfixes Valides -->
            <section class="col-span-12 lg:col-span-4 bento-card p-md flex flex-col gap-md bg-white rounded-2xl shadow-sm border border-outline-variant">
                <div class="flex items-center justify-between">
                    <h2 class="font-title-md text-title-md flex items-center gap-xs font-semibold">
                        <span class="material-symbols-outlined text-primary" data-icon="cell_tower">cell_tower</span>
                        Préfixes Valides
                    </h2>
                    <span class="px-xs py-base bg-primary-container text-on-primary-container text-[10px] font-bold rounded-full uppercase tracking-wider">Mobile</span>
                </div>

                <form action="<?= base_url('operateur/addPrefixe') ?>" method="POST" class="flex gap-xs">
                    <input name="valeur" class="flex-1 bg-surface-container border-none focus:ring-2 focus:ring-primary rounded-lg font-body-sm px-sm py-xs" placeholder="Ex: 033" type="text" required />
                    <button type="submit" class="bg-primary text-on-primary px-sm py-xs rounded-lg font-bold hover:opacity-90 active:scale-95 transition-all">Ajouter</button>
                </form>

                <div class="flex flex-wrap gap-xs overflow-y-auto max-h-48 custom-scrollbar">
                    <?php if (!empty($prefixes)): ?>
                        <?php foreach ($prefixes as $prefixe): ?>
                            <div class="flex items-center gap-xs bg-surface-container-high px-sm py-xs rounded-full group cursor-default">
                                <span class="font-bold text-primary"><?= esc($prefixe['valeur']) ?></span>
                                <span class="text-on-surface-variant text-[10px]"><?= esc($prefixe['operateur_nom']) ?></span>
                                <a href="<?= base_url('operateur/deletePrefixe/' . $prefixe['id']) ?>" class="material-symbols-outlined text-sm text-error opacity-0 group-hover:opacity-100 cursor-pointer transition-opacity" data-icon="close">close</a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-on-surface-variant text-body-sm italic">Aucun préfixe configuré.</p>
                    <?php endif; ?>
                </div>
            </section>

            <!-- SECTION 2 : Types d'Opérations -->
            <section class="col-span-12 lg:col-span-8 bento-card p-md bg-white rounded-2xl shadow-sm border border-outline-variant">
                <div class="flex items-center justify-between mb-md">
                    <h2 class="font-title-md text-title-md flex items-center gap-xs font-semibold">
                        <span class="material-symbols-outlined text-primary" data-icon="settings_suggest">settings_suggest</span>
                        Types d'Opérations
                    </h2>
                    <button class="text-primary font-bold text-body-sm flex items-center gap-base">
                        <span class="material-symbols-outlined text-lg" data-icon="add_circle">add_circle</span>
                        Nouveau Type
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-sm">
                    <?php if (!empty($types_operation)): ?>
                        <?php foreach ($types_operation as $type): ?>
                            <div class="p-sm bg-surface-container rounded-xl flex items-center justify-between border-l-4 border-primary">
                                <div>
                                    <p class="font-bold text-primary"><?= esc($type['libelle']) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-on-surface-variant text-body-sm italic">Aucun type d'opération.</p>
                    <?php endif; ?>
                </div>
            </section>

            <!-- SECTION 3 : Tableau des Barèmes de Frais Dynamique -->
            <section class="col-span-12 bento-card overflow-hidden bg-white rounded-2xl shadow-sm border border-outline-variant mt-6">
                <div class="p-md flex flex-col md:flex-row md:items-center justify-between gap-md border-b border-outline-variant">
                    <div>
                        <h2 class="font-title-md text-title-md flex items-center gap-xs font-semibold">
                            <span class="material-symbols-outlined text-primary" data-icon="table_chart">table_chart</span>
                            Barèmes de Frais : <?= esc($libelle_operation_selectionne) ?>
                        </h2>
                        <p class="text-on-surface-variant font-body-sm">Modification des tranches tarifaires en temps réel.</p>
                    </div>

                    <!-- Filtre de sélection dynamique de l'opération -->
                    <div class="flex flex-wrap gap-sm items-center">
                        <form method="GET" action="" class="flex items-center gap-xs">
                            <label for="type_op" class="text-body-sm font-medium text-on-surface-variant whitespace-nowrap">Filtrer par :</label>
                            <select name="type_op" id="type_op" onchange="this.form.submit()" class="bg-surface-container border-none focus:ring-2 focus:ring-primary rounded-full text-body-sm py-xs pl-sm pr-xl cursor-pointer">
                                <?php foreach ($types_operation as $type): ?>
                                    <option value="<?= $type['id'] ?>" <?= $type['id'] == $id_type_op_selectionne ? 'selected' : '' ?>>
                                        <?= esc($type['libelle']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </form>

                        <a href="/operateur/addBareme" class="bg-primary-container text-on-primary-container px-md py-xs rounded-full font-bold flex items-center gap-xs hover:bg-primary hover:text-on-primary transition-all active:scale-95 shadow-sm">
                            <span class="material-symbols-outlined text-lg" data-icon="add">add</span>
                            Tranche
                        </a>
                    </div>
                </div>

                <?php if (!empty($baremes)): ?>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-secondary text-on-secondary uppercase text-[11px] tracking-[0.1em] font-bold">
                                    <th class="px-md py-sm">ID</th>
                                    <th class="px-md py-sm">Min (Ar)</th>
                                    <th class="px-md py-sm">Max (Ar)</th>
                                    <th class="px-md py-sm">Frais</th>
                                    <th class="px-md py-sm text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-body-sm font-medium divide-y divide-outline-variant">
                                <?php foreach ($baremes as $bareme): ?>
                                    <tr class="hover:bg-primary-container/5 transition-colors">
                                        <td class="px-md py-md text-on-surface-variant">#<?= sprintf('%03d', $bareme['id']) ?></td>
                                        <td class="px-md py-md font-numeric-data text-[16px]"><?= number_format($bareme['montant_min'], 0, ',', ' ') ?></td>
                                        <td class="px-md py-md font-numeric-data text-[16px]"><?= number_format($bareme['montant_max'], 0, ',', ' ') ?></td>
                                        <td class="px-md py-md font-bold text-primary"><?= number_format($bareme['frais'], 0, ',', ' ') ?> Ar</td>
                                        <td class="px-md py-md text-right">
                                            <div class="flex justify-end gap-xs">
                                                <button class="p-xs hover:bg-surface-container-high rounded-lg transition-colors text-primary"
                                                    onclick="location.href='/operateur/baremes/<?= $bareme['id'] ?>/modifier?type_op_selectionne=<?= $bareme['id_type_operation'] ?>'">
                                                    <span class="material-symbols-outlined" data-icon="edit">edit</span>
                                                </button>
                                                <form action="/operateur/baremes/<?= $bareme['id'] ?>/supprimer" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce barème ?');">
                                                    <?= csrf_field() /* Sécurité anti-CSRF recommandée par CodeIgniter */ ?>
                                                    <button type="submit" class="p-xs hover:bg-error-container/20 rounded-lg transition-colors text-error">
                                                        <span class="material-symbols-outlined" data-icon="delete">delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <!-- Message vide adaptatif avec bouton d'ajout si aucune configuration n'existe -->
                    <div class="p-xl text-center flex flex-col items-center justify-center gap-sm">
                        <span class="material-symbols-outlined text-4xl text-on-surface-variant" data-icon="grid_off">grid_off</span>
                        <p class="text-on-surface-variant text-body-lg italic">Aucun barème de frais configuré pour cette opération.</p>
                        <a href="/operateur/addBareme" class="mt-base bg-primary text-on-primary px-md py-sm rounded-lg font-bold hover:opacity-90 active:scale-95 transition-all shadow-sm flex items-center gap-xs">
                            <span class="material-symbols-outlined" data-icon="add">add</span>
                            Créer la première configuration
                        </a>
                    </div>
                <?php endif; ?>
            </section>
        </div>
    </main>
</body>

</html>