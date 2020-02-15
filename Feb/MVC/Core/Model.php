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

    protected static function insert($key, $value){
            $key = implode(", ", $key);
            $value = "'" . implode("', '", $value) . "'";
            $table = static::$table;
            echo "INSERT INTO $table ($key) VALUES($value)";
            die;
            $stmt = static::getDB()->prepare("INSERT INTO $table ($key) VALUES($value)");
            $static::getDB()->beginTransaction();
            $stmt->execute( array_values($data));
            return $static::getDB()->lastInsertId();    
    }


}