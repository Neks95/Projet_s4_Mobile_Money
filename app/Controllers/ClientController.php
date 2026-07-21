<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\OperationModel;
use App\Models\EpargneModel;



class ClientController extends BaseController
{
    public function getHome()
    {
        $session = session();
        $client = $session->get('client');

        $clientModel = new ClientModel();
        $opModel = new OperationModel();
        $epargneModel = new EpargneModel();

        $clientInfo = $clientModel->find($client['id']);

        $activites = $opModel->getRecentes($client['id']);

        return view('accueil', [
            'client' => $clientInfo,
            'activites' => $activites,
        ]);
    }

    public function processEpargne()
    {
        $session = session();
        $clientId = session()->get('client')['id'];

        $model = new EpargneModel();
        $valeur = $this->request->getPost('valeur');

        $model->save([
            'id_client' => $clientId,
            'valeur' => $valeur,
            'solde_epargne' => 0,
        ]);

        return redirect()->to('/client/home')->with('success', 'Valeur epargne enregistre avec succes !.');
    }

    public function historique()
    {
        $clientId = session()->get('client')['id'];
        $operationModel = new OperationModel();

        $data['transactions'] = $operationModel->select('operation.*, type_operation.libelle')
            ->join('type_operation', 'type_operation.id = operation.id_type_operation')
            ->where('id_client1', $clientId)
            ->orWhere('id_client2', $clientId)
            ->orderBy('date_operation', 'DESC')
            ->findAll();

        return view('historique_client', $data);
    }

    private function calculerFrais($montant, $idTypeOperation)
    {
        $db = \Config\Database::connect();
        $bareme = $db->table('bareme_frais')
            ->where('id_type_operation', $idTypeOperation)
            ->where('montant_min <=', $montant)
            ->where('montant_max >=', $montant)
            ->get()
            ->getRow();

        return $bareme ? $bareme->frais : 0;
    }

    public function processDepot()
    {
        $session = session();
        $client = $session->get('client');
        $montant = $this->request->getPost('montant');
        $description = $this->request->getPost('description');

        if (!$client || !is_numeric($montant) || $montant <= 0) {
            return redirect()->back()->with('error', 'Données invalides.');
        }

        $clientModel = new ClientModel();
        $opModel = new OperationModel();
        $db = \Config\Database::connect();

        $db->transStart();

        $clientInfo = $clientModel->find($client['id']);
        $clientModel->update($clientInfo['id'], ['solde' => $clientInfo['solde'] + $montant]);

        $opModel->save([
            'id_client1'       => $clientInfo['id'],
            'id_client2'       => $clientInfo['id'],
            'id_type_operation' => 1,
            'date_operation'   => date('Y-m-d H:i:s'),
            'montant'          => $montant,
            'frais_applique'   => 0,
            'description'      => !empty($description) ? $description : 'Dépôt en espèces'
        ]);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Erreur lors du dépôt.');
        }

        $session->set('client', $clientModel->find($clientInfo['id']));
        return redirect()->to('/client/home')->with('success', 'Dépôt effectué avec succès.');
    }

    public function processRetrait()
    {
        $session = session();
        $client = $session->get('client');
        $montant = $this->request->getPost('montant');
        $description = $this->request->getPost('description');
        $frais = $this->calculerFrais($montant, 2);
        $totalADebiter = $montant + $frais;

        if (!$client || !is_numeric($totalADebiter) || $totalADebiter <= 0) {
            return redirect()->back()->with('error', 'Données invalides.');
        }

        $clientModel = new ClientModel();
        $opModel = new OperationModel();
        $db = \Config\Database::connect();

        $clientInfo = $clientModel->find($client['id']);

        if ($clientInfo['solde'] < $totalADebiter) {
            return redirect()->back()->with('error', 'Solde insuffisant.');
        }

        $db->transStart();

        $clientModel->update($clientInfo['id'], ['solde' => $clientInfo['solde'] - $totalADebiter]);

        $opModel->save([
            'id_client1'       => $clientInfo['id'],
            'id_client2'       => $clientInfo['id'],
            'id_type_operation' => 2,
            'date_operation'   => date('Y-m-d H:i:s'),
            'montant'          => $montant,
            'frais_applique'   => $frais,
            'description'      => !empty($description) ? $description : 'Retrait en espèces'
        ]);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Erreur lors du retrait.');
        }

        $session->set('client', $clientModel->find($clientInfo['id']));
        return redirect()->to('/client/home')->with('success', 'Retrait effectué avec succès.');
    }

    public function processTransfert()
    {
        $session = session();
        $db = \Config\Database::connect();
        $clientModel = new ClientModel();
        $opModel = new OperationModel();
        $epargneModel = new EpargneModel();

        $montantTotal = (float)$this->request->getPost('montant');
        $inputDest = $this->request->getPost('destinataire');
        $description = $this->request->getPost('description');
        $inclureFrais = $this->request->getPost('inclure_frais_retrait') === 'on';

        $numeros = array_map('trim', explode(',', $inputDest));
        $numeros = array_filter($numeros, fn($n) => !empty($n));
        $numeros = array_unique($numeros);
        $nbDest = count($numeros);

        if ($nbDest === 0) {
            return redirect()->back()->with('error', 'Veuillez saisir au moins un numéro de destinataire.');
        }

        $expediteur = $clientModel->find($session->get('client')['id']);
        if (!$expediteur) {
            return redirect()->back()->with('error', 'Utilisateur non trouvé.');
        }

        $prefixesYas = $session->get('prefixes');

        $estToutInterne = true;
        $numerosInvalides = [];
        $interneParNum = [];

        foreach ($numeros as $num) {
            $interne = false;
            foreach ($prefixesYas as $p) {
                if (str_starts_with($num, $p)) {
                    $interne = true;
                    break;
                }
            }

            $interneParNum[$num] = $interne;

            if (!$interne) {
                $estToutInterne = false;
                $numerosInvalides[] = $num;
            }
        }

        if ($nbDest > 1 && !$estToutInterne) {
            $numerosStr = implode(', ', $numerosInvalides);
            return redirect()->back()->with(
                'error',
                'Transfert multiple impossible. Les numéros suivants ne sont pas Yas : ' . $numerosStr .
                    '. Les préfixes acceptés sont : ' . implode(', ', $prefixesYas)
            );
        }

        $destinatairesExistants = [];
        foreach ($numeros as $num) {
            $destinataire = $clientModel->where('numero_telephone', $num)->first();

            if ($destinataire) {
                $destinatairesExistants[$num] = $destinataire;

                if ($destinataire['id'] == $expediteur['id']) {
                    return redirect()->back()->with('error', 'Impossible de s\'envoyer à soi-même.');
                }
            } else {
                $interne = false;
                foreach ($prefixesYas as $p) {
                    if (str_starts_with($num, $p)) {
                        $interne = true;
                        break;
                    }
                }

                if ($interne) {
                    return redirect()->back()->with(
                        'error',
                        'Le numéro ' . $num . ' est un client Aura (Yas) mais n\'existe pas dans notre système.'
                    );
                }
            }
        }

        $montantParPersonne = $montantTotal / $nbDest;
        $fraisTransfert = $this->calculerFrais($montantTotal, 3);
        $promo = $this->calculerPromotion($fraisTransfert);

        $fraisRetrait = 0;
        if ($estToutInterne) {
            $fraisTransfert = $fraisTransfert - $promo;
            if ($inclureFrais) {
                $fraisRetrait = $this->calculerFrais($montantTotal, 2);
            }
        }

        // Commission externe : dépend de l'opérateur destinataire (conf_transfert), calculée au moment
        // du transfert et STOCKÉE dans commission_externe pour garder une trace figée dans l'historique,
        // même si conf_transfert change plus tard.
        $commissionParNum = [];
        $totalCommissionExterne = 0.0;

        foreach ($numeros as $num) {
            if (!$interneParNum[$num]) {
                $idOperateur = $this->determinerOperateurExterne($num, $db);
                $commission = $idOperateur !== null
                    ? $this->calculerCommissionExterne($montantParPersonne, $idOperateur, $db)
                    : 0.0;

                $commissionParNum[$num] = $commission;
                $totalCommissionExterne += $commission;
            } else {
                $commissionParNum[$num] = 0.0;
            }
        }

        $totalFrais = $fraisTransfert + $fraisRetrait + $totalCommissionExterne;
        $totalADebiter = $montantTotal + $totalFrais;

        if ($expediteur['solde'] < $totalADebiter) {
            return redirect()->back()->with(
                'error',
                'Solde insuffisant. Montant : ' . number_format($montantTotal, 0, ',', '.') .
                    ' Ar + Frais : ' . number_format($totalFrais, 0, ',', '.') .
                    ' Ar = ' . number_format($totalADebiter, 0, ',', '.') . ' Ar'
            );
        }

        $db->transStart();

        $clientModel->update($expediteur['id'], ['solde' => $expediteur['solde'] - $totalADebiter]);

        $i = 0;
        foreach ($numeros as $num) {
            $i++;
            $destinataire = $destinatairesExistants[$num] ?? null;
            $estInterne = $destinataire !== null;
            $estEpargne = $epargneModel->isEpargned($destinataire['id']);
            if ($estEpargne > 0) {
                $valeur = $epargneModel->calculerMontantEpargne($destinataire['id'], $montantParPersonne);
                $montantParPersonne = $montantParPersonne - $valeur;
                $nouveau_solde_epargne = $epargneModel->getSolde($destinataire['id']) + $valeur;
                $epargneModel->update([
                    'solde_epargne' => $nouveau_solde_epargne,
                ]);
            }

            if ($estInterne) {
                $clientModel->update($destinataire['id'], [
                    'solde' => $destinataire['solde'] + $montantParPersonne
                ]);
            }

            $defaultDescription = 'Transfert';
            if ($estInterne) {
                $defaultDescription = 'Transfert vers ' . $destinataire['prenom'] . ' ' . $destinataire['nom'];
            } else {
                $defaultDescription = 'Transfert externe vers ' . $num;
            }

            // Le numéro doit TOUJOURS apparaître dans la description : situationOperateurs()
            // en dépend pour retrouver l'opérateur externe via le préfixe.
            $descriptionFinale = !empty($description)
                ? $description . ' (Numéro : ' . $num . ')'
                : $defaultDescription;

            $fraisOperation = ($i === 1) ? ($fraisTransfert + $fraisRetrait) : 0;

            $opModel->save([
                'id_client1'         => $expediteur['id'],
                'id_client2'         => $estInterne ? $destinataire['id'] : null,
                'id_type_operation'  => 3,
                'date_operation'     => date('Y-m-d H:i:s'),
                'montant'            => $montantParPersonne,
                'frais_applique'     => $fraisOperation,
                'commission_externe' => $commissionParNum[$num],
                'description'        => $descriptionFinale,
            ]);
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Erreur lors du transfert.');
        }

        $session->set('client', $clientModel->find($expediteur['id']));

        if ($nbDest === 1) {
            $num = $numeros[0];
            $destinataire = $destinatairesExistants[$num] ?? null;
            if ($destinataire) {
                $message = 'Transfert de ' . number_format($montantTotal, 0, ',', '.') . ' Ar vers ' .
                    $destinataire['prenom'] . ' ' . $destinataire['nom'] . ' effectué avec succès.';
            } else {
                $message = 'Transfert externe de ' . number_format($montantTotal, 0, ',', '.') . ' Ar vers ' . $num . ' effectué.';
            }
        } else {
            $message = 'Transfert multiple de ' . number_format($montantTotal, 0, ',', '.') . ' Ar vers ' .
                $nbDest . ' destinataires effectué avec succès.';
        }

        return redirect()->to('/client/home')->with('success', $message);
    }

    private function determinerOperateurExterne(string $numero, $db): ?int
    {
        $prefixesList = $db->table('prefixe')->get()->getResultArray();

        foreach ($prefixesList as $p) {
            if (str_starts_with($numero, $p['valeur'])) {
                return (int)$p['id_operateur'];
            }
        }

        return null;
    }

    private function calculerCommissionExterne(float $montant, int $idOperateur, $db): float
    {
        $conf = $db->table('conf_transfert')->where('id_operateur', $idOperateur)->get()->getRowArray();
        $taux = $conf ? (float)$conf['comission'] : 0.0;

        return ($montant * $taux) / 100;
    }

    private function calculerPromotion(float $frais): float
    {
        $db = \Config\Database::connect();
        $conf = $db->table('promotion')->get()->getRowArray();
        $taux = $conf ? (float)$conf['pourcentage'] : 0.0;

        return ($frais * $taux) / 100;
    }

    public function situationClients()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('client');
        $builder->select('client.*, prefixe.Valeur as code_prefixe, operateur.nom as nom_operateur');
        $builder->join('prefixe', 'prefixe.id = client.id_prefixe', 'left');
        $builder->join('operateur', 'operateur.id = prefixe.id_operateur', 'left');
        $builder->orderBy('client.nom', 'ASC');

        $clients = $builder->get()->getResultArray();

        $totalSoldes = 0;
        foreach ($clients as $c) {
            $totalSoldes += (float) $c['solde'];
        }

        $data = [
            'clients'       => $clients,
            'total_soldes'  => $totalSoldes,
            'total_clients' => count($clients)
        ];

        return view('situation_clients', $data);
    }
}
