<?php
namespace App\Core;

use PDO;
use PDOException;

class Database extends PDO
{
    private const DB_USER = 'root';
    private const DB_NAME = 'testdb';
    private const DB_HOST = 'localhost';
    private const DB_PASS = '';
    private static $instance = null;


    // Constructeur privé pour le singleton
    private function __construct()
    {
        $dsn = 'mysql:dbname=' . self::DB_NAME . ';host=' . self::DB_HOST;
        try {
            parent::__construct($dsn, self::DB_USER, self::DB_PASS);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    // Méthode pour récupérer l'instance unique de la classe Database
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();  // Utilisation de 'new self()' au lieu de 'new Database()'
        }
        return self::$instance;
    }



}
