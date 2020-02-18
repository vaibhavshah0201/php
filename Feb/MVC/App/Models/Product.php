<?php

/* Product Model */
namespace App\Models;

use PDO;

class Product extends \Core\Model{

    protected static $table = 'products';
    protected static $primaryKey = 'productId';
    

    public static function fetchProduct($url) {
        try{
            $db = static::getDB();
            $table = self::$table;
            $stmt = $db->query("SELECT
                                    *
                                FROM
                                    products 
                                WHERE productUrlKey = '$url'");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
}