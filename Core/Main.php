<?php
namespace App\Core;
use AltoRouter;

class Main
{



    public function start()
    {
        // Initialiser AltoRouter
        $router = new AltoRouter();
        // Définir les routes
        $router->map('GET', '/', 'MainController#index');
        $router->map('GET', '/{controller}[/{action}[/{id}]]', 'Controller#action');
        // Trouver la correspondance
        $match = $router->match();
        // Traiter la correspondance
        if ($match) {
            // Extraire le contrôleur et l'action de la route correspondante
            list($controllerName, $action) = explode('#', $match['target']);
            $controllerClass = "\\App\\Controllers\\" . ucfirst($controllerName);

            if (class_exists($controllerClass)) {
                $controller = new $controllerClass();
                $action = isset($action) ? filter_var($action, FILTER_SANITIZE_SPECIAL_CHARS) : 'index';
                if (method_exists($controller, $action)) {
                    // Appeler la méthode avec les paramètres restants
                    $methodParams = $match['params'];
                    call_user_func_array([$controller, $action], $methodParams);
                } else {
                    // Si la méthode n'existe pas, afficher une erreur
                    http_response_code(404);
                    echo "Erreur 404 : La méthode {$action} n'existe pas.";
                    exit();
                }
            } else {
                // Si le contrôleur n'existe pas, afficher une erreur
                http_response_code(404);
                echo "Erreur 404 : Le contrôleur {$controllerName} n'existe pas.";
                exit();
            }
        } else {
            // Rediriger vers une page d'accueil ou une action par défaut
            $defaultController = new \App\Controllers\MainController();
            $defaultController->index();
        }
    }
}