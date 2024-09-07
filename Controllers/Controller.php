<?php

namespace App\Controllers;
class Controller
{

    public function render(string $fichier, array $tab)
    {
        extract($tab);


        ob_start();
        require_once '../Views/' . $fichier . '.php';
        $contenue = ob_get_clean();
        require '../Views/defaulf.php';
    }
}