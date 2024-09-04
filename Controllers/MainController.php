<?php

namespace App\Controllers;

class MainController
{

    public function index(...$var)
    {
        var_dump($var);
        echo " Une methode de la main controller ";
    }
}