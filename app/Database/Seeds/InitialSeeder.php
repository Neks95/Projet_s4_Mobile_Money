<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialSeeder extends Seeder
{
    public function run()
    {
        // 1. Opérateur
        $this->db->table('operateur')->insert(['nom' => 'Yas']);
        $opId = $this->db->insertID();

        // 2. Types d'opérations
        $types = ['depot', 'retrait', 'transfert'];
        foreach ($types as $t) {
            $this->db->table('type_operation')->insert(['libelle' => $t]);
        }

        // 3. Préfixes avec la colonne 'valeur'
        $prefixes = ['033', '038'];
        foreach ($prefixes as $p) {
            $this->db->table('prefixe')->insert([
                'valeur'        => $p, // Utilisation de la nouvelle colonne
                'date_creation' => date('Y-m-d'),
                'id_operateur'  => $opId
            ]);
        }

        // 4. Clients
        $clients = [
            ['nom' => 'Rakoto', 'prenom' => 'Jean', 'numero' => '0330000011', 'solde' => 1500000, 'prefixe' => 1],
            ['nom' => 'Rasoa',  'prenom' => 'Marie', 'numero' => '0380000022', 'solde' => 850000,  'prefixe' => 2],
            ['nom' => 'Andry',  'prenom' => 'Luc',   'numero' => '0330000033', 'solde' => 200000,  'prefixe' => 1],
        ];

        foreach ($clients as $c) {
            $this->db->table('client')->insert([
                'nom'              => $c['nom'],
                'prenom'           => $c['prenom'],
                'numero_telephone' => $c['numero'],
                'solde'            => $c['solde'],
                'id_prefixe'       => $c['prefixe']
            ]);
        }

        // 5. Opérations
        $operations = [
            ['c1' => 1, 'c2' => null, 'type' => 1, 'montant' => 100000, 'frais' => 0],
            ['c1' => 2, 'c2' => null, 'type' => 2, 'montant' => 20000,  'frais' => 500],
            ['c1' => 1, 'c2' => 3,    'type' => 3, 'montant' => 50000,  'frais' => 1000],
        ];

        foreach ($operations as $o) {
            $this->db->table('operation')->insert([
                'id_client1'       => $o['c1'],
                'id_client2'       => $o['c2'],
                'id_type_operation' => $o['type'],
                'date_operation'   => date('Y-m-d H:i:s'),
                'montant'          => $o['montant'],
                'frais_applique'   => $o['frais']
            ]);
        }
    }
}
