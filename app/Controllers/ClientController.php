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

    public function processDepot()
    {
        $session = session();
        $client = $session->get('client');
        $montant = $this->request->getPost('montant');

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
            'frais_applique'   => 0
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

        if (!$client || !is_numeric($montant) || $montant <= 0) {
            return redirect()->back()->with('error', 'Données invalides.');
        }

        $clientModel = new ClientModel();
        $opModel = new OperationModel();
        $db = \Config\Database::connect();

        $clientInfo = $clientModel->find($client['id']);

        if ($clientInfo['solde'] < $montant) {
            return redirect()->back()->with('error', 'Solde insuffisant.');
        }


        $db->transStart();

        $clientModel->update($clientInfo['id'], ['solde' => $clientInfo['solde'] - $montant]);

        $opModel->save([
            'id_client1'       => $clientInfo['id'],
            'id_client2'       => $clientInfo['id'],
            'id_type_operation' => 2, // ID 2 = Retrait
            'date_operation'   => date('Y-m-d H:i:s'),
            'montant'          => $montant,
            'frais_applique'   => 0
        ]);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Erreur lors du retrait.');
        }

        $session->set('client', $clientModel->find($clientInfo['id']));
        return redirect()->to('/client/home')->with('success', 'Retrait effectué avec succès.');
    }
}
