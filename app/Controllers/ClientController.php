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
        $client = $session->get('client');
        $montant = $this->request->getPost('montant');
        $numeroDestinataire = $this->request->getPost('destinataire');
        $description = $this->request->getPost('description');
        $frais = $this->calculerFrais($montant, 3); 
        $totalADebiter = $montant + $frais;

        $clientModel = new ClientModel();
        $opModel = new OperationModel();
        $db = \Config\Database::connect();

        $expediteur = $clientModel->find($client['id']);
        $destinataire = $clientModel->where('numero_telephone', $numeroDestinataire)->first(); 

        if (!$destinataire) {
            return redirect()->back()->with('error', 'Destinataire introuvable.');
        }
        if ($expediteur['solde'] < $totalADebiter) {
            return redirect()->back()->with('error', 'Solde insuffisant.');
        }
        if ($expediteur['id'] == $destinataire['id']) {
            return redirect()->back()->with('error', 'Impossible de s\'envoyer à soi-même.');
        }

        $destinataireNumero = $destinataire['numero_telephone'];

        $db->transStart();

        // 2. Débit expéditeur
        $clientModel->update($expediteur['id'], ['solde' => $expediteur['solde'] - $totalADebiter]);
        // 3. Crédit destinataire
        $clientModel->update($destinataire['id'], ['solde' => $destinataire['solde'] + $montant]);

        $defaultDescription = 'Transfert vers ' . $destinataireNumero;
        if (!empty($destinataire['prenom']) && !empty($destinataire['nom'])) {
            $defaultDescription = 'Transfert vers ' . $destinataire['prenom'] . ' ' . $destinataire['nom'] . ' (' . $destinataireNumero . ')';
        }

        $opModel->save([
            'id_client1'       => $expediteur['id'],
            'id_client2'       => $destinataire['id'], 
            'id_type_operation' => 3, 
            'date_operation'   => date('Y-m-d H:i:s'),
            'montant'          => $montant,
            'frais_applique'   => $frais,
            'description'      => !empty($description) ? $description : $defaultDescription
        ]);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Erreur transfert.');
        }

        $session->set('client', $clientModel->find($expediteur['id']));
        return redirect()->to('/client/home')->with('success', 'Transfert vers ' . $destinataireNumero . ' réussi.');
    }
}