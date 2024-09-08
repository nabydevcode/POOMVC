<?php

namespace App\Controllers;


class Controller
{

    /*  public function render(string $fichier, array $tab)
     {
         extract($tab);
         ob_start();
         require_once '../Views/' . $fichier . '.php';
         $contenue = ob_get_clean();
         require(dirname(__DIR__) . '/Views/default.php');
     } */
    public function render(string $fichier, array $tab)
    {
        // Extraire les variables passées dans l'array
        extract($tab);

        // Utiliser un chemin absolu pour inclure le fichier de vue
        $vuePath = dirname(__DIR__) . '/Views/' . $fichier . '.php';

        // Tester si le fichier existe
        if (file_exists($vuePath)) {
            ob_start();
            require_once $vuePath;  // Inclure la vue spécifique
            $contenue = ob_get_clean();
        } else {
            die("Erreur : le fichier de vue $vuePath n'existe pas.");
        }

        // Inclure le fichier layout (template par défaut)
        $defaultPath = dirname(__DIR__) . '/Views/default.php';

        // Vérifier si le fichier de template existe
        if (file_exists($defaultPath)) {
            require_once $defaultPath;  // Inclure le layout principal
        } else {
            die("Erreur : le fichier de layout $defaultPath n'existe pas.");
        }
    }

}