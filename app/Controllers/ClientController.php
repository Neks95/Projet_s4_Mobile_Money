<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\OperationModel;


class ClientController extends BaseController
{
    public function getHome()
    {
        $session = session();
        $client = $session->get('client');

        $clientModel = new ClientModel();
        $opModel = new OperationModel();

        $clientInfo = $clientModel->find($client['id']);

        $activites = $opModel->getRecentes($client['id']);

        return view('accueil', [
            'client' => $clientInfo,
            'activites' => $activites
        ]);
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
    
    foreach ($numeros as $num) {
        $interne = false;
        foreach ($prefixesYas as $p) {
            if (str_starts_with($num, $p)) {
                $interne = true;
                break;
            }
        }
        
        if (!$interne) {
            $estToutInterne = false;
            $numerosInvalides[] = $num;
        }
    }

    if ($nbDest > 1 && !$estToutInterne) {
        $numerosStr = implode(', ', $numerosInvalides);
        return redirect()->back()->with('error', 
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
                return redirect()->back()->with('error', 
                    'Le numéro ' . $num . ' est un client Aura (Yas) mais n\'existe pas dans notre système.'
                );
            }
        }
    }

    $montantParPersonne = $montantTotal / $nbDest;
    
    $fraisTransfert = $this->calculerFrais($montantTotal, 3);
    
    $fraisRetrait = 0;
    if ($estToutInterne && $inclureFrais) {
        $fraisRetrait = $this->calculerFrais($montantTotal, 2);
    }
    
    $totalFrais = $fraisTransfert + $fraisRetrait;
    $totalADebiter = $montantTotal + $totalFrais;

    if ($expediteur['solde'] < $totalADebiter) {
        return redirect()->back()->with('error', 
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

        $fraisOperation = ($i === 1) ? $totalFrais : 0;

        $opModel->save([
            'id_client1'          => $expediteur['id'],
            'id_client2'          => $estInterne ? $destinataire['id'] : null,
            'id_type_operation'   => 3,
            'date_operation'      => date('Y-m-d H:i:s'),
            'montant'             => $montantParPersonne,
            'frais_applique'      => $fraisOperation,
            'description'         => !empty($description) ? $description : $defaultDescription,
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



    
}
