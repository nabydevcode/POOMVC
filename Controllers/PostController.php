<?php
namespace App\Controllers;
use App\Controllers\Controller;
use App\Core\Database;
use App\Models\AnnonceModel;
use App\Models\Model;
use App\Models\PostModel;


class PostController extends Controller
{
    public function index()
    {
        $annonce = new PostModel();
        $donnee = $annonce->findAll();
        return $this->render('poste/index', ['donnee' => $donnee]);
    }
    public function findbycible()
    {
        $postbycile = new PostModel();
        $donnee = $postbycile->findByIndice(['actif' => 1]);
        return $this->render('poste/findallbycible', ['donnee' => $donnee]);
    }


}