<?php

/* Product Model */
namespace App\Models\Admin;

use PDO;

class Category extends \Core\Model{

    protected static $table = 'categories';
    protected static $primaryKey = 'catId';
    

    public static function insertCategory($data) {
        try{
            // $data = $this->filter($data);
            $key = array_keys($data);
            $value = array_values($data);
            return parent::insert($key, $value);
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function updateCat($data, $id) {
        try{
            $data = Static::filter($data);
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

    public static function fetchCategory() {
        try{
            $db = static::getDB();
            $table = self::$table;
            $stmt = $db->query("SELECT catName, catId, catUrlKey, catParentId FROM $table WHERE catParentId Is NULL ");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getAllCat() {
        try{
            $db = static::getDB();
            $table = self::$table;
            $stmt = $db->query("SELECT catName, catId, catUrlKey, catParentId FROM $table WHERE catParentId Is NULL ");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data = [];
            foreach( $results as  $row){
                $stmt = $db->query("SELECT catName, catId, catUrlKey, catParentId FROM $table WHERE catParentId = $row[catId] ");
                $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $row['child'] = $result2;
                array_push($data,$row);
            }
            
            return $data;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function fetchSubCategory(){
        try{
            $db = static::getDB();
            $table = self::$table;
            $stmt = $db->query("SELECT catName, catId, catUrlKey, catParentId FROM $table WHERE catParentId Is NOT NULL ");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            
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

    public static function filter($data) {
        $filterdata = [];
        $filterdata['catUrlKey'] = str_replace([" ", "&"], ["-", "%20"], strtolower($data['textCatName'])).'-store';
        foreach($data as $key => $value) {
            switch($key) {
                case 'textCatName':
                    $filterdata['catName'] = $value;
                break;

                case 'selectParent':
                    $filterdata['catParentId'] = $value;
                break;

                case 'textCatDesc':    
                    $filterdata['catDesc'] = $value;
                break;
            }
        }
        return $filterdata;
    }
    
}