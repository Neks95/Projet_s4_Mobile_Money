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
        ];

        $prefixeIds = [];
        foreach ($prefixes as $prefixe) {
            $this->db->table('prefixe')->insert([
                'date_creation' => $prefixe['date_creation'],
                'id_operateur'  => $operateurIds[$prefixe['operateur']],
                'Valeur'        => $prefixe['Valeur'],
            ]);
            $prefixeIds[$prefixe['Valeur']] = $this->db->insertID();
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
                'numero_telephone' => '0341122233',
                'prefixe'          => '033',
                'solde'            => 150000.0,
            ],
            [
                'nom'              => 'Rakoto',
                'prenom'           => 'Dylan',
                'numero_telephone' => '0324455566',
                'prefixe'          => '038',
                'solde'            => 25000.0,
            ],
            [
                'nom'              => 'Andria',
                'prenom'           => 'Owan',
                'numero_telephone' => '0337788899',
                'prefixe'          => '033',
                'solde'            => 5000.0,
            ],
        ];

        foreach ($clients as $client) {
            $this->db->table('client')->insert([
                'nom'              => $client['nom'],
                'prenom'           => $client['prenom'],
                'numero_telephone' => $client['numero_telephone'],
                'id_prefixe'       => $prefixeIds[$client['prefixe']],
                'solde'            => $client['solde'],
            ]);
        }

        // --- 5. BAREMES DE FRAIS (pour Retrait Cash) ---
        $baremes = [
            ['montant_min' => 0,     'montant_max' => 5000,   'frais' => 150],
            ['montant_min' => 5001,  'montant_max' => 10000,  'frais' => 300],
            ['montant_min' => 10001, 'montant_max' => 50000,  'frais' => 1200],
            ['montant_min' => 50001, 'montant_max' => 100000, 'frais' => 2500],
        ];

        foreach ($baremes as $bareme) {
            $this->db->table('bareme_frais')->insert([
                'montant_min'       => $bareme['montant_min'],
                'montant_max'       => $bareme['montant_max'],
                'frais'             => $bareme['frais'],
                'id_type_operation' => $typeOperationIds['retrait'],
            ]);
        }

        $baremesTransfert = [
            ['montant_min' => 0,     'montant_max' => 5000,   'frais' => 100],
            ['montant_min' => 5001,  'montant_max' => 200000,  'frais' => 500],
            ['montant_min' => 20001, 'montant_max' => 1000000, 'frais' => 2000],
        ];

        foreach ($baremesTransfert as $bareme) {
            $this->db->table('bareme_frais')->insert([
                'montant_min'       => $bareme['montant_min'],
                'montant_max'       => $bareme['montant_max'],
                'frais'             => $bareme['frais'],
                'id_type_operation' => $typeOperationIds['transfert'],
            ]);
        }
    }
}