<?php
namespace App\Core;
use PDO;
use PDOException;


class Database extends PDO
{

    private $base;
    private static $instance = null;

    private function __construct()
    {
        $this->base = dirname(__DIR__) . '/testdb.db';
        $dsn = 'sqlite:' . $this->base;
        try {
            parent::__construct($dsn);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
}
