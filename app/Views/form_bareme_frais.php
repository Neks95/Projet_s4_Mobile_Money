<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= $bareme ? 'Modifier un barème' : 'Ajouter un barème' ?> | Aura Finance
    </title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">
    <link href="<?= base_url('assets/css/aura-finance.css') ?>" rel="stylesheet" />
    <script src="<?= base_url('assets/js/tailwind-config.js') ?>"></script>
</head>

<body class="bg-surface font-body-lg text-on-surface min-h-screen">
    <main class="max-w-xl mx-auto px-container-margin py-xl">
        <a
            href="<?= base_url('operateur') ?>"
            class="inline-flex items-center gap-xs text-primary font-bold font-body-sm mb-md">
            <span class="material-symbols-outlined">arrow_back</span>
            Retour à la configuration
        </a>

        <section class="bento-card bg-white p-md border border-outline-variant">
            <h1 class="text-headline-lg text-primary mb-base">
                <?= $bareme ? 'Modifier le barème' : 'Nouvelle tranche tarifaire' ?>
            </h1>

            <p class="text-on-surface-variant font-body-sm mb-md">
                Définissez la tranche de montant et les frais applicables.
            </p>

            <?php if ($message = session()->getFlashdata('error')): ?>
                <div class="mb-md rounded-lg bg-error-container px-sm py-xs text-on-error-container font-body-sm">
                    <?= esc($message) ?>
                </div>
            <?php endif; ?>

           <form
                method="POST"
                action="<?= $bareme
                            ? base_url('operateur/baremes/' . $bareme['id'] . '/modifier')
                            : base_url('operateur/baremes') ?>"
                class="space-y-sm">
                <?= csrf_field() ?>

                <div>
                    <label for="id_type_operation" class="block mb-base font-bold">
                        Type d’opération
                    </label>

                    <select
                        id="id_type_operation"
                        name="id_type_operation"
                        required
                        class="w-full rounded-lg border-outline-variant focus:ring-primary">
                        <?php foreach ($types_operation as $type): ?>
                            <?php
                            $typeSelectionne = old(
                                'id_type_operation',
                                ($bareme !== null ? $bareme['id_type_operation'] : null) ?? $type_op_selectionne
                            );
                            ?>
                            <option
                                value="<?= $type['id'] ?>"
                                <?= (string) $type['id'] === (string) $typeSelectionne ? 'selected' : '' ?>>
                                <?= esc($type['libelle']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-sm">
                    <div>
                        <label for="montant_min" class="block mb-base font-bold">
                            Montant minimum (Ar)
                        </label>

                        <input
                            id="montant_min"
                            name="montant_min"
                            type="number"
                            min="0"
                            step="1"
                            required
                            value="<?= esc(old('montant_min', $bareme['montant_min'] ?? '')) ?>"
                            class="w-full rounded-lg border-outline-variant focus:ring-primary">
                    </div>

                    <div>
                        <label for="montant_max" class="block mb-base font-bold">
                            Montant maximum (Ar)
                        </label>

                        <input
                            id="montant_max"
                            name="montant_max"
                            type="number"
                            min="0"
                            step="1"
                            required
                            value="<?= esc(old('montant_max', $bareme['montant_max'] ?? '')) ?>"
                            class="w-full rounded-lg border-outline-variant focus:ring-primary">
                    </div>
                </div>

                <div>
                    <label for="frais" class="block mb-base font-bold">
                        Frais appliqués (Ar)
                    </label>

                    <input
                        id="frais"
                        name="frais"
                        type="number"
                        min="0"
                        step="1"
                        required
                        value="<?= esc(old('frais', $bareme['frais'] ?? '')) ?>"
                        class="w-full rounded-lg border-outline-variant focus:ring-primary">
                </div>

                <div class="flex gap-sm pt-sm">
                    <button
                        type="submit"
                        class="bg-primary text-on-primary px-md py-xs rounded-lg font-bold hover:opacity-90 transition-all">
                        <?= $bareme ? 'Enregistrer' : 'Créer le barème' ?>
                    </button>

                    <a
                        href="<?= base_url('operateur') ?>"
                        class="px-md py-xs rounded-lg font-bold text-on-surface-variant hover:bg-surface-container transition-all">
                        Annuler
                    </a>
                </div>
            </form>
        </section>
    </main>
</body>

</html>