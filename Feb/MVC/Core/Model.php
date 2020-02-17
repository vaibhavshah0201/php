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
            $stmt = static::getDB()->prepare("INSERT INTO $table ($key) VALUES($value)");   
            $stmt->execute();
            return static::getDB()->lastInsertId();    
    }

    public static function getAll(){
        $table = static::$table;
        $stmt = static::getDB()->query("SELECT * FROM $table");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public static function fetchRow($id) {
        $table = static::$table;
        $primaryKey = static::$primaryKey;
        $stmt = static::getDB()->query("SELECT * FROM $table WHERE $primaryKey = $id");
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        return $results;
    }

    protected static function update($keyValue, $id) {
        $table = static::$table;
        $primaryKey = static::$primaryKey;
        $stmt = static::getDB()->query("UPDATE $table SET $keyValue WHERE $primaryKey = $id");
        return $stmt->rowCount();
    }   

    public static function delete($id){
            $table = static::$table;
            $primaryKey = static::$primaryKey;
            $stmt = static::getDB()->query("DELETE FROM $table WHERE $primaryKey = $id");
            return $stmt->rowCount(PDO::FETCH_ASSOC);

    }

}