<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AppSeeder extends Seeder
{
    public function run()
    {
        // --- 1. OPERATEURS ---
        $operateurs = [
            ['nom' => 'Yas'],
            ['nom' => 'Orange']
        ];

        $operateurIds = [];
        foreach ($operateurs as $operateur) {
            $this->db->table('operateur')->insert($operateur);
            $operateurIds[$operateur['nom']] = $this->db->insertID();
        }

        // --- 2. PREFIXES ---
        $prefixes = [
            ['date_creation' => '2026-01-01', 'operateur' => 'Yas', 'Valeur' => '033'],
            ['date_creation' => '2026-01-01', 'operateur' => 'Yas', 'Valeur' => '038'],
            ['date_creation' => '2026-01-01', 'operateur' => 'Orange', 'Valeur' => '037'],
            ['date_creation' => '2026-01-01', 'operateur' => 'Orange', 'Valeur' => '032'],
        ];

        foreach ($prefixes as $prefixe) {
            $this->db->table('prefixe')->insert([
                'date_creation' => $prefixe['date_creation'],
                'id_operateur'  => $operateurIds[$prefixe['operateur']],
                'Valeur'        => $prefixe['Valeur'],
            ]);
        }

        // --- 3. TYPES D'OPERATION ---
        $typesOperation = [
            ['libelle' => 'depot'],
            ['libelle' => 'retrait'],
            ['libelle' => 'transfert'],
        ];

        $typeOperationIds = [];
        foreach ($typesOperation as $type) {
            $this->db->table('type_operation')->insert($type);
            $typeOperationIds[$type['libelle']] = $this->db->insertID();
        }

        // --- 4. CLIENTS DE TEST ---
        $clients = [
            [
                'nom'              => 'Ranaivo',
                'prenom'           => 'Tsiky',
                'numero_telephone' => '0331122233', // Commence par 033
                'solde'            => 150000.0,
            ],
            [
                'nom'              => 'Rakoto',
                'prenom'           => 'Dylan',
                'numero_telephone' => '0384455566', // Commence par 038
                'solde'            => 25000.0,
            ],
            [
                'nom'              => 'Andria',
                'prenom'           => 'Owan',
                'numero_telephone' => '0337788899', // Commence par 033
                'solde'            => 5000.0,
            ],
        ];

        foreach ($clients as $client) {
            // Extraction des 3 premiers chiffres (ex: '033')
            $extractionPrefixe = substr($client['numero_telephone'], 0, 3);

            // Recherche dynamique de l'ID du préfixe en base de données
            $prefixeTrouve = $this->db->table('prefixe')
                ->where('Valeur', $extractionPrefixe)
                ->get()
                ->getRowArray();

            // Si le préfixe n'existe pas en base, on peut mettre null ou lever une exception
            $idPrefixe = $prefixeTrouve ? $prefixeTrouve['id'] : null;

            $this->db->table('client')->insert([
                'nom'              => $client['nom'],
                'prenom'           => $client['prenom'],
                'numero_telephone' => $client['numero_telephone'],
                'id_prefixe'       => $idPrefixe, // Affectation de l'ID trouvé dynamiquement
                'solde'            => $client['solde'],
            ]);
        }

        // --- 5. BAREMES DE FRAIS (Retrait Cash) ---
        // --- 5. BAREMES DE FRAIS ---
        $baremes = [
            // Barèmes pour RETRAIT (id_type_operation = 2)
            ['montant_min' => 0,     'montant_max' => 5000,   'frais' => 150,  'type' => 'retrait'],
            ['montant_min' => 5001,  'montant_max' => 10000,  'frais' => 300,  'type' => 'retrait'],
            ['montant_min' => 10001, 'montant_max' => 50000,  'frais' => 1200, 'type' => 'retrait'],
            ['montant_min' => 50001, 'montant_max' => 100000, 'frais' => 2500, 'type' => 'retrait'],

            // Barèmes pour TRANSFERT (id_type_operation = 3)
            ['montant_min' => 0,     'montant_max' => 10000,  'frais' => 100,  'type' => 'transfert'],
            ['montant_min' => 10001, 'montant_max' => 50000,  'frais' => 200,  'type' => 'transfert'],
            ['montant_min' => 50001, 'montant_max' => 100000, 'frais' => 500,  'type' => 'transfert'],
            ['montant_min' => 100001, 'montant_max' => 500000, 'frais' => 1000, 'type' => 'transfert'],
        ];



        foreach ($baremes as $bareme) {
            $this->db->table('bareme_frais')->insert([
                'montant_min'       => $bareme['montant_min'],
                'montant_max'       => $bareme['montant_max'],
                'frais'             => $bareme['frais'],
                'id_type_operation' => $typeOperationIds[$bareme['type']],
            ]);
        }

        // --- 6. OPERATIONS DE TEST ---
        // Utilisation directe des IDs fixes 1, 2, 3 générés séquentiellement pour les clients
        $operationsInitiales = [
            ['c1' => 1, 'c2' => null, 'type' => $typeOperationIds['depot'], 'montant' => 100000],
            ['c1' => 2, 'c2' => null, 'type' => $typeOperationIds['retrait'], 'montant' => 20000],
            ['c1' => 1, 'c2' => 3,    'type' => $typeOperationIds['transfert'], 'montant' => 50000],
        ];

        foreach ($operationsInitiales as $o) {
            $fraisApplique = 0.0;

            // Recherche dynamique du frais dans la table 'bareme_frais'
            $baremeTrouve = $this->db->table('bareme_frais')
                ->where('id_type_operation', $o['type'])
                ->where('montant_min <=', $o['montant'])
                ->where('montant_max >=', $o['montant'])
                ->get()
                ->getRowArray();

            if ($baremeTrouve) {
                $fraisApplique = (float)$baremeTrouve['frais'];
            }

            $this->db->table('operation')->insert([
                'id_client1'        => $o['c1'],
                'id_client2'        => $o['c2'],
                'id_type_operation' => $o['type'],
                'date_operation'    => date('Y-m-d H:i:s'),
                'montant'           => $o['montant'],
                'frais_applique'    => $fraisApplique
            ]);
        }
    }
}
