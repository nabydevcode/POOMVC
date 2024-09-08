<?php

namespace App\Controllers;
use App\Controllers\Controller;


class MainController extends Controller
{

    public function index()
    {
        return $this->render('/home');
    }
}