<?php

namespace App\Controllers;

use App\Models\PrefixeModel;
use App\Models\TypeOperationModel;
use App\Models\BaremeFraisModel;
use App\Models\OperateurModel;

class OperateurController extends BaseController
{
    public function login()
    {
        $operateur = (new OperateurModel())->first();

        if ($operateur === null) {
            return redirect()->to('/login')->with('error', 'Aucun opérateur configuré.');
        }

        session()->set([
            'role'          => 'operateur',
            'operateur_id'  => $operateur['id'],
        ]);

        return redirect()->to('/operateur');
    }

    public function index(): string
    {
        $prefixeModel = new PrefixeModel();
        $typeOpModel  = new TypeOperationModel();
        $baremeModel  = new BaremeFraisModel();

        $data['prefixes'] = $prefixeModel->getPrefixesWithOperateur();
        $data['types_operation'] = $typeOpModel->findAll();

        $idTypeOpSelectionne = $this->request->getGet('type_op');
        if (!$idTypeOpSelectionne && !empty($data['types_operation'])) {
            $idTypeOpSelectionne = $data['types_operation'][0]['id'];
        }
        $data['id_type_op_selectionne'] = $idTypeOpSelectionne;

        $data['libelle_operation_selectionne'] = 'Inconnu';
        foreach ($data['types_operation'] as $type) {
            if ($type['id'] == $idTypeOpSelectionne) {
                $data['libelle_operation_selectionne'] = $type['libelle'];
                break;
            }
        }

        $data['baremes'] = $idTypeOpSelectionne
            ? $baremeModel->where('id_type_operation', $idTypeOpSelectionne)->findAll()
            : [];

        return view('config_operateur', $data);
    }

    public function createPrefixe()
{
    $valeur = trim((string) $this->request->getPost('valeur'));

    if (! preg_match('/^\d{3}$/', $valeur)) {
        return redirect()->to('/operateur')->with('error', 'Le préfixe doit contenir 3 chiffres.');
    }

    $model = new PrefixeModel();
    $operateurId = session('operateur_id');

    if ($model->where([
        'Valeur'       => $valeur,
        'id_operateur' => $operateurId,
    ])->first()) {
        return redirect()->to('/operateur')->with('error', 'Ce préfixe existe déjà.');
    }

    $model->insert([
        'Valeur'       => $valeur,
        'id_operateur' => $operateurId,
        'date_creation'=> date('Y-m-d'),
    ]);

    return redirect()->to('/operateur')->with('success', 'Préfixe ajouté.');
}

}
