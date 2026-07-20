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
            return redirect()->to('/login')->with('error', 'Aucun operateur configure.');
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
            return redirect()->to('/operateur')->with('error', 'Le prefixe doit contenir 3 chiffres.');
        }

        $model = new PrefixeModel();
        $operateurId = session('operateur_id');

        if ($model->where([
            'Valeur'       => $valeur,
            'id_operateur' => $operateurId,
        ])->first()) {
            return redirect()->to('/operateur')->with('error', 'Ce prefixe existe deja.');
        }

        $model->insert([
            'Valeur'        => $valeur,
            'id_operateur'  => $operateurId,
            'date_creation' => date('Y-m-d'),
        ]);

        return redirect()->to('/operateur')->with('success', 'Prefixe ajoute.');
    }

    public function newBareme()
    {
        return view('form_bareme_frais', [
            'bareme'              => null,
            'types_operation'     => (new TypeOperationModel())->findAll(),
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
            'bareme'              => $bareme,
            'types_operation'     => (new TypeOperationModel())->findAll(),
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
            ->with('success', 'Bareme supprime.');
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
                ->with('error', 'Cette tranche chevauche un bareme existant.');
        }

        $data = [
            'montant_min'       => $min,
            'montant_max'       => $max,
            'frais'             => $frais,
            'id_type_operation' => $typeId,
        ];

        $id === null ? $model->insert($data) : $model->update($id, $data);

        return redirect()->to('/operateur?type_op=' . $typeId)
            ->with('success', $id === null ? 'Bareme cree.' : 'Bareme modifie.');
    }

    public function situationGains()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('operation');
        $builder->select('operation.*, type_operation.libelle as libelle_op');
        $builder->join('type_operation', 'type_operation.id = operation.id_type_operation');
        $builder->orderBy('operation.date_operation', 'DESC');
        $operations = $builder->get()->getResultArray();

        $totalGainsOperateur = 0;
        $totalGainsAutresOperateurs = 0;

        $transactionsCalculees = [];

        foreach ($operations as $op) {
            $fraisTotaux = (float)$op['frais_applique'];
            $commissionExt = (float)($op['commission_externe'] ?? 0.0);

            $gainMaison = $fraisTotaux - $commissionExt;
            $gainPartage = $commissionExt;

            $totalGainsOperateur += $gainMaison;
            $totalGainsAutresOperateurs += $gainPartage;

            $op['gain_interne'] = $gainMaison;
            $op['gain_externe'] = $gainPartage;

            $transactionsCalculees[] = $op;
        }

        $data = [
            'transactions'           => $transactionsCalculees,
            'gain_operateur'         => $totalGainsOperateur,
            'gain_autres_operateurs' => $totalGainsAutresOperateurs,
            'gain_total'             => $totalGainsOperateur + $totalGainsAutresOperateurs
        ];

        return view('situation_gains', $data);
    }

    public function situationOperateurs()
    {
        $db = \Config\Database::connect();

        $transferts = $db->table('operation')
            ->where('id_type_operation', 3)
            ->where('id_client2', null)
            ->get()->getResultArray();

        $situation = [];

        foreach ($transferts as $t) {
            $numDest = trim($t['numero_destinataire'] ?? '');

            if (empty($numDest)) {
                continue;
            }

            $prefixe = substr($numDest, 0, 3);
            $opDest = $db->table('prefixe')->where('Valeur', $prefixe)->get()->getRowArray();

            if ($opDest) {
                $idOp = $opDest['id_operateur'];

                if (!isset($situation[$idOp])) {
                    $opData = $db->table('operateur')->where('id', $idOp)->get()->getRowArray();
                    $situation[$idOp] = [
                        'nom'        => $opData ? $opData['nom'] : 'Inconnu',
                        'fonds'      => 0.0,
                        'commission' => 0.0
                    ];
                }

                $situation[$idOp]['fonds'] += (float)$t['montant'];
                $situation[$idOp]['commission'] += (float)($t['commission_externe'] ?? 0.0);
            }
        }

        return view('situation_operateurs', ['coefficients' => $situation]);
    }
}