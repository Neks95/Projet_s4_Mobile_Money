<?php

namespace App\Controllers;

class Etudiant extends BaseController
{
    public function liste(): string
    {
        return view('liste_etudiant');
    }
}
