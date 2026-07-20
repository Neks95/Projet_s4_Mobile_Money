<?php

namespace App\Controllers;

use App\Models\ClientModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('connexion');
    }

    public function checkLogin()
    {
        $session = session();
        $model = new ClientModel();
        $numero = trim($this->request->getPost('numero_telephone'));
        
        if ($model->existsByNumero($numero)) {
            $client = $model->getByNumero($numero);
            $session->set('client', $client);
            $session->set('role','client');
            return redirect()->to('/client/home')->with('success', 'Bienvenue !');
        } else {
            return redirect()->back()->with('error', 'Numéro non reconnu.');
        }
    }
}