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

        return view('home', [
            'client' => $clientInfo,
            'activites' => $activites
        ]);
    }

    // public function showDepot(){
    //     return view 
    // }

   public function processDepot()
{
    $session = session();
    $client = $session->get('client');
    $montant = $this->request->getPost('montant');

    if (!is_numeric($montant) || $montant <= 0) {
        return redirect()->back()->with('error', 'Le montant doit être positif.');
    }

    $clientModel = new ClientModel();
    $opModel = new OperationModel();
    $db = \Config\Database::connect();

    $db->transStart();

    try {
        $nouveauSolde = $client['solde'] + $montant;
        $clientModel->update($client['id'], ['solde' => $nouveauSolde]);
        $opModel->save([
            'id_client1'       => $client['id'], 
            'id_client2'       => $client['id'], 
            'id_type_operation'=> 1, 
            'date_operation'   => date('Y-m-d H:i:s'),
            'montant'          => $montant,
            'frais_applique'   => 0 
        ]);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Erreur lors du dépôt.');
        }

        $session->set('client', $clientModel->find($client['id']));
        return redirect()->to('/client/home')->with('success', 'Dépôt effectué avec succès.');

    } catch (\Exception $e) {
        $db->transRollback();
        return redirect()->back()->with('error', 'Une erreur est survenue.');
    }
}
 


}