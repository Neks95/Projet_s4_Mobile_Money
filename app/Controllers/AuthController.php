<?php

namespace App\Controllers;

use App\Models\ClientModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('connexion');
    }
     public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
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
            $prefixeModel = new \App\Models\PrefixeModel();
            session()->set('prefixes', array_column($prefixeModel->getPrefixesByOperateur(1), 'valeur'));
            return redirect()->to('/client/home')->with('success', 'Bienvenue !');
        } else {
            return redirect()->back()->with('error', 'Numéro non reconnu.');
        }
    }
}