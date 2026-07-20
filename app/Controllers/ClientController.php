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
        $montant = (float)$this->request->getPost('montant');
        $numDest = $this->request->getPost('destinataire');
        $description = $this->request->getPost('description');
        $inclureFrais = $this->request->getPost('inclure_frais_retrait') === 'on';

        $clientModel = new ClientModel();
        $expediteur = $clientModel->find(session()->get('client')['id']);

        $destinataire = $clientModel->where('numero_telephone', $numDest)->first();

        $prefixesYas = session()->get('prefixes'); // ['033', '038']
        $estClientYas = false;
        foreach ($prefixesYas as $p) {
            if (str_starts_with($numDest, $p)) {
                $estClientYas = true;
                break;
            }
        }

        $fraisTransfert = $this->calculerFrais($montant, 3);
        $fraisRetrait = ($inclureFrais && $estClientYas) ? $this->calculerFrais($montant, 2) : 0; // ID 2 = retrait

        $totalADebiter = $montant + $fraisTransfert + $fraisRetrait;

        if ($expediteur['solde'] < $totalADebiter) {
            return redirect()->back()->with('error', 'Solde insuffisant. Total nécessaire : ' . number_format($totalADebiter, 0, ',', '.') . ' Ar');
        }

        if ($estClientYas && $destinataire && $expediteur['id'] == $destinataire['id']) {
            return redirect()->back()->with('error', 'Impossible de s\'envoyer à soi-même.');
        }

        $opModel = new OperationModel();
        $db->transStart();

        $clientModel->update($expediteur['id'], ['solde' => $expediteur['solde'] - $totalADebiter]);

        if ($estClientYas && $destinataire) {
            $clientModel->update($destinataire['id'], ['solde' => $destinataire['solde'] + $montant]);
            $destinataireNumero = $destinataire['numero_telephone'];
            $destinataireNom = $destinataire['prenom'] . ' ' . $destinataire['nom'];
        } else {
            $destinataireNumero = $numDest;
            $destinataireNom = 'Externe (' . $numDest . ')';
        }

        $defaultDescription = $estClientYas
            ? 'Transfert vers ' . $destinataireNom . ' (' . $destinataireNumero . ')'
            : 'Transfert externe vers ' . $destinataireNumero;

        $opModel->save([
            'id_client1'        => $expediteur['id'],
            'id_client2'        => $estClientYas && $destinataire ? $destinataire['id'] : null,
            'id_type_operation' => 3, // ID 3 = transfert
            'date_operation'    => date('Y-m-d H:i:s'),
            'montant'           => $montant,
            'frais_applique'    => $fraisTransfert + $fraisRetrait,
            'description'       => !empty($description) ? $description : $defaultDescription
        ]);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Erreur lors du transfert.');
        }

        $session->set('client', $clientModel->find($expediteur['id']));

        $message = $estClientYas
            ? 'Transfert vers ' . $destinataireNom . ' réussi.'
            : 'Transfert externe vers ' . $destinataireNumero . ' effectué.';

        return redirect()->to('/client/home')->with('success', $message);
    }
}
