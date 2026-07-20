<?php

namespace App\Controllers;

class OperateurController extends BaseController
{
    public function index(): string
    {
        return view('config_operateur');
    }
}
