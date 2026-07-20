<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InitDatabase extends Migration
{
    public function up()
    {
        $filePath = APPPATH . 'Database/Sql/schema.sql';

        if (file_exists($filePath)) {
            $sql = file_get_contents($filePath);

            $this->db->connID->exec($sql);
        } else {
            throw new \RuntimeException("Le fichier SQL est introuvable à l'adresse : $filePath");
        }
    }

    public function down()
    {
        $this->forge->dropTable('operation', true);
        $this->forge->dropTable('bareme_frais', true);
        $this->forge->dropTable('type_operation', true);
        $this->forge->dropTable('client', true);
        $this->forge->dropTable('prefixe', true);
        $this->forge->dropTable('operateur', true);
    }
}
