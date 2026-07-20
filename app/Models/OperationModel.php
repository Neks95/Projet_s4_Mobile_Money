<?php
namespace App\Models;
use CodeIgniter\Model;

class OperationModel extends Model {
    protected $table = 'operation';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_client1', 
        'id_client2', 
        'id_type_operation', 
        'date_operation', 
        'montant',
        'description' ,
        'frais_applique'
    ];

    public function getRecentes($idClient, $limit = 5) {
    return $this->select('operation.*, type_operation.libelle')
                ->join('type_operation', 'type_operation.id = operation.id_type_operation')
                ->groupStart()
                    ->where('id_client1', $idClient)
                    ->orWhere('id_client2', $idClient)
                ->groupEnd()
                ->orderBy('date_operation', 'DESC')
                ->limit($limit)
                ->findAll();
}
    
  
}

?>