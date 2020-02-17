<?php

/* Product Model */
namespace App\Models\Admin;

use PDO;

class Pages extends \Core\Model{

    protected static $table = 'cms_pages';
    protected static $primaryKey = 'cmsId';
    

    public static function insertPage($data) {
        try{
            $key = array_keys($data);
            $value = array_values($data);
            return parent::insert($key, $value);
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function updatePage($data, $id) {
        try{
            $keyValue = [];
            foreach($data as $key => $value) {
                array_push($keyValue, "$key = '$value'");
            }
            $keyValue = implode(", ", $keyValue);
            return parent::update($keyValue, $id);
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function isUniqueURL($url) {
        try{
            $db = static::getDB();
            $table = self::$table;
            $stmt = $db->query("SELECT catId, catUrlKey FROM $table WHERE catUrlKey = '$url'");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
}