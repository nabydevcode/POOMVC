<?php

namespace App\Core;
use PDO;

class Database extends PDO
{
    const DB_USER = 'root';
    const DB_NAME = 'testdb';
    const DB_HOST = 'localhos';
    const DB_PASS = '';

    private static $instance;



    private function __construct()
    {
        $dns = 'mysql:dbname=' . self::DB_NAME . ';host=' . self::DB_HOST;
        parent::__construct($dns, self::DB_USER, self::DB_PASS);
    }
    public static function getinstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
}

