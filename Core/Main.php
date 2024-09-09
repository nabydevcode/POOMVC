<?php
namespace App\Core;
use AltoRouter;

class Main
{



    public function start()
    {
        // Initialiser AltoRouter
        $router = new AltoRouter();
        // Définir la route pour la page d'accueil
        $router->map('GET', '/', function () {
            require dirname(__DIR__) . '/views/home.php';
        }, 'main');
        $router->map('GET', '/post', 'PostController#index', 'post_list');
        // Route dynamique pour les contrôleurs et actions avec un ID facultatif
        $router->map('GET', '/[a:controller]/[a:action]/[i:id]?', function ($controller, $action = 'index', $id = null) {
            // Construire le nom complet du contrôleur
            $controllerClass = "\\App\\Controllers\\" . ucfirst($controller) . "Controller";
            // Vérifier si la classe du contrôleur existe
            if (class_exists($controllerClass)) {
                $controllerInstance = new $controllerClass();
                // Vérifier si la méthode (action) existe dans le contrôleur
                if (method_exists($controllerInstance, $action)) {
                    // Appeler la méthode avec l'ID (si fourni)
                    if ($id) {
                        $controllerInstance->$action($id);
                    } else {
                        $controllerInstance->$action();
                    }
                } else {
                    // Si l'action n'existe pas, afficher une erreur
                    http_response_code(404);
                    echo "Erreur 404 : L'action {$action} n'existe pas.";
                    require(dirname(__DIR__) . '/Views/Error/error404.php');
                }
            } else {
                // Si le contrôleur n'existe pas, afficher une erreur
                http_response_code(404);
                echo "Erreur 404 : Le contrôleur {$controller} n'existe pas.";
                require(dirname(__DIR__) . '/Views/Error/error404.php');
            }
        });

        // Trouver la correspondance
        $match = $router->match();

        // Vérifier la correspondance
        if ($match) {
            call_user_func_array($match['target'], $match['params']);
        } else {
            // Si aucune route ne correspond, afficher une erreur 404 ou rediriger
            http_response_code(404);
            require(dirname(__DIR__) . '/Views/Error/error404.php');

        }
    }

}