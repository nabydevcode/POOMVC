<?php

namespace App\Core;


class Main
{
    public function start()
    {
        $uri = $_SERVER['REQUEST_URI'];

        if (!empty($uri) && $uri[-1] === '/' && substr($uri, -1)) {
            $uri = rtrim($uri, '/');
            http_response_code(301);
            header('Location: ' . $uri);
        }

        $params = [];
        if (isset($_GET['p']) && !empty($_GET['p']))
            $params = explode('/', trim($_GET['p'], '/'));
        if (isset($params[0]) && $params[0] != '') {
            $param = array_shift($params);
            $controller = "\\App\\Controllers\\" . ucfirst($param) . "Controller";
            $controller = new $controller;

            $action = (isset($params[0])) ? array_shift($params) : 'index';

            echo '<pre>';
            var_dump($params);
            echo '<pre>';
            if (method_exists($controller, $action)) {
                (isset($params[0])) ? call_user_func_array([$controller, $action], $params) : $controller->$action();
            }

        }




    }
}