<?php

namespace App\Controllers;


class Controller
{
    public function render(string $fichier, array $tab = [], $templates = 'default')
    {
        // Extraire les variables passées dans l'array
        extract($tab);

        ob_start();
        require('../Views' . $fichier . '.php');
        $contenue = ob_get_clean();
        require_once('../Views/' . $templates . '.php');
    }

}