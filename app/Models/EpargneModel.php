<?php
namespace App\Models;
use CodeIgniter\Model;

class EpargneModel extends Model
{
    protected $table = 'epargne';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_client', 'valeur', 'solde_epargne'];

  

    public function calculerMontantEpargne($clientId , $montant){
        $client = $this->where('id_client', $clientId)->first();
        $pourcentage = $client['valeur'];
        return $montant*($pourcentage/100);
    }

    public function isEpargned($clientId){
        return $this->where('id_client', $clientId)->countAllResults();
    }

    public function getSolde($clientId){
        $epargne =  $this->where('id_client', $clientId)->first();
        return $epargne['solde_epargne'];
    }

   
}