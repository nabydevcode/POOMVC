<?php

namespace App\Controllers;
class Controller
{

    public function render(string $fichier, array $tab)
    {
        extract($tab);

        require_once '../Views/' . $fichier . '.php';
    }
}