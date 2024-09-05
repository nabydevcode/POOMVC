<?php
namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\PostModel;


class PostController extends Controller
{
    public function index()
    {
        $annonnce = new PostModel();
        $donnee = $annonnce->findAll();
        return $this->render('poste/index.php', ['donnee' => $donnee]);
    }

}