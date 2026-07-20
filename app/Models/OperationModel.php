<?php
namespace App\Models;
use CodeIgniter\Model;

class OperationModel extends Model {
    protected $table = 'operation';
    
    public function getRecentes($idClient, $limit = 5) {
        return $this->where('id_client1', $idClient)
                    ->orWhere('id_client2', $idClient)
                    ->orderBy('date_operation', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }
}

?>