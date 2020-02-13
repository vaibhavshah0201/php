<?php

namespace Core;

use PDO;
use App\Config;

/*Base Model- */

abstract class Model{

    protected static function getDB(){
        static $db = null;

        if($db === null) {
                
            $dsn = 'mysql:host='. Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
            $db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);
            
            //Throw an exception when an errror occur;
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
            
        }
        return $db;
    }
}