<?php

/* Product Model */
namespace App\Models;

use PDO;

class Home extends \Core\Model{

    protected static $table = 'cms_pages';
    protected static $primaryKey = 'cmsId';
  
    public static function getPages($url) {
        try{
            $db = static::getDB();
            $table = self::$table;
            $stmt = $db->query("SELECT
                                    *
                                FROM
                                    $table
                                WHERE 
                                    cmsUrlKey = '$url'");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}