<?php

/* Product Model */
namespace App\Models;

use PDO;

class Category extends \Core\Model{

    protected static $table = 'categories';
    protected static $primaryKey = 'catId';
    

    public static function fetchCategory($url) {
        try{
            $db = static::getDB();
            $table = self::$table;
            $stmt = $db->query("SELECT
                                    *
                                FROM
                                    products P
                                LEFT JOIN products_categories PC ON
                                    PC.productId = P.productId
                                LEFT JOIN categories C ON
                                    PC.catId = C.catId
                                WHERE C.catUrlKey = '$url'");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    

    public static function fetchAllCategory(){
        try{
            $db = static::getDB();
            $table = self::$table;
            $stmt = $db->query("SELECT
                                    C.catId,
                                    C.catName,
                                    C.catUrlKey,
                                    C.catDesc,
                                    PC.catName as parentName
                                FROM
                                    $table C
                                LEFT JOIN $table PC ON
                                    C.catParentId = PC.catId");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
}