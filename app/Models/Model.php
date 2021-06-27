<?php

namespace App\Models;

use PDO;

    abstract class model
    {
        private static $db;

        /* Connexion à une base MySQL avec l'invocation de pilote */
        private static $dsn = 'mysql:dbname=examen;host=127.0.0.1';
        private static $user = 'root';
        private static $password = '';

        private static function setDb()
        {
            self::$db = new PDO(self::$dsn, self::$user, self::$password);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); 
        }

        protected static function getDb()
        {
            if (self::$db == null)
            {
                self::setDb();
            }
            return self::$db;
        }

        // $dbh = new PDO($dsn, $user, $password);
    }