<?php
namespace App\Models;
use CodeIgniter\Model;

class PrefixeModel extends Model
{
    protected $table = 'prefixe';
    protected $primaryKey = 'id';
    protected $allowedFields = ['date_creation', 'id_operateur', 'Valeur'];

    // Jointure pour récupérer le nom de l'opérateur avec le préfixe
    public function getPrefixesWithOperateur()
    {
        return $this->select('prefixe.*, operateur.nom as operateur_nom')
                    ->join('operateur', 'operateur.id = prefixe.id_operateur')
                    ->findAll();
    }
}