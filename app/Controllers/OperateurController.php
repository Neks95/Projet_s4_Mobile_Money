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
            'date_creation' => date('Y-m-d'),
        ]);

        return redirect()->to('/operateur')->with('success', 'Préfixe ajouté.');
    }

    public function newBareme()
    {
        return view('form_bareme_frais', [
            'bareme' => null,
            'types_operation'  => (new TypeOperationModel())->findAll(),
            'type_op_selectionne' => $this->request->getGet('type_op_selectionne'),
        ]);
    }

    public function createBareme()
    {
        return $this->saveBareme();
    }

    public function editBareme(int $id)
    {
        $bareme = (new BaremeFraisModel())->find($id);

        if ($bareme === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

       return view('form_bareme_frais', [
            'bareme' => $bareme,
            'types_operation'  => (new TypeOperationModel())->findAll(),
            'type_op_selectionne' => $this->request->getGet('type_op_selectionne'),
        ]);
    }

    public function updateBareme(int $id)
    {
        return $this->saveBareme($id);
    }

    public function deleteBareme(int $id)
    {
        $bareme = (new BaremeFraisModel())->find($id);

        if ($bareme !== null) {
            (new BaremeFraisModel())->delete($id);
        }

        return redirect()->to('/operateur?type_op=' . ($bareme['id_type_operation'] ?? ''))
            ->with('success', 'Barème supprimé.');
    }

    private function saveBareme(?int $id = null)
    {
        $model = new BaremeFraisModel();

        $min = (float) $this->request->getPost('montant_min');
        $max = (float) $this->request->getPost('montant_max');
        $frais = (float) $this->request->getPost('frais');
        $typeId = (int) $this->request->getPost('id_type_operation');

        if ($min < 0 || $max < $min || $frais < 0 || $typeId <= 0) {
            return redirect()->back()->withInput()
                ->with('error', 'Les montants saisis sont invalides.');
        }

        $overlap = $model
            ->where('id_type_operation', $typeId)
            ->where('montant_min <=', $max)
            ->where('montant_max >=', $min);

        if ($id !== null) {
            $overlap->where('id !=', $id);
        }

        if ($overlap->first() !== null) {
            return redirect()->back()->withInput()
                ->with('error', 'Cette tranche chevauche un barème existant.');
        }

        $data = [
            'montant_min'       => $min,
            'montant_max'       => $max,
            'frais'             => $frais,
            'id_type_operation' => $typeId,
        ];

        $id === null ? $model->insert($data) : $model->update($id, $data);

        return redirect()->to('/operateur?type_op=' . $typeId)
            ->with('success', $id === null ? 'Barème créé.' : 'Barème modifié.');
    }

    public function gain()
    {
        // 1. Initialisation des modèles
        $db = \Config\Database::connect();
        $baremeModel = new \App\Models\BaremeFraisModel();

        // 2. Récupération des vraies transactions réussies depuis la base
        // (Ajustez les noms de la table 'transactions' et du champ 'statut' selon votre structure)
        $builder = $db->table('operation');
        $builder->select('operation.*, type_operation.libelle as libelle_op');
        $builder->join('type_operation', 'type_operation.id = operation.id_type_operation');
        $builder->orderBy('operation.date_operation', 'DESC');
        $transactions = $builder->get()->getResultArray();

        // 3. Récupération de tous les barèmes de frais
        $tousLesBaremes = $baremeModel->findAll();

        $transactionsCalculées = [];
        $totalGainsTransfert = 0;
        $totalGainsRetrait = 0;

        // 4. Calcul dynamique des gains pour chaque transaction
        foreach ($transactions as $txn) {
            $fraisApplique = 0;
            $montantTxn = (float) $txn['montant'];
            $idTypeOp = (int) $txn['id_type_operation'];

            // Trouver le barème dans lequel se situe le montant
            foreach ($tousLesBaremes as $bareme) {
                if (
                    (int)$bareme['id_type_operation'] === $idTypeOp &&
                    $montantTxn >= (float)$bareme['montant_min'] &&
                    $montantTxn <= (float)$bareme['montant_max']
                ) {
                    $fraisApplique = (float) $bareme['frais'];
                    break; // On a trouvé le bon barème, on sort de la boucle interne
                }
            }

            // Cumul des gains (on suppose ici que ID 1 = Transfert, ID 2 = Retrait)
            // Si vos IDs sont différents, ajustez les chiffres ou testez sur $txn['libelle_op']
            if ($idTypeOp === 1 || stripos($txn['libelle_op'], 'transfert') !== false) {
                $totalGainsTransfert += $fraisApplique;
            } else {
                $totalGainsRetrait += $fraisApplique;
            }

            // On ajoute le gain calculé à la transaction pour l'affichage
            $txn['frais_generes'] = $fraisApplique;
            $transactionsCalculées[] = $txn;
        }

        // 5. Envoi des données à la vue
        $data = [
            'transactions'   => $transactionsCalculées,
            'gain_transfert' => $totalGainsTransfert,
            'gain_retrait'   => $totalGainsRetrait,
            'gain_total'     => $totalGainsTransfert + $totalGainsRetrait
        ];

        return view('situation_gains', $data);
    }   
}
