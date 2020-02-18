<?php

/* Product Model */
namespace App\Models\Admin;

use PDO;

class Product extends \Core\Model{

    protected static $table = 'products';
    protected static $relationTable = 'products_categories';
    protected static $primaryKey = 'productId';

    public static function insertProduct($data) {
        try{
            $key = array_keys($data);
            $value = array_values($data);
            return parent::insert($key, $value);
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function insertProductCat($data) {
        try{
    
            $key = array_keys($data);
            $value = array_values($data);
            $key = implode(", ", $key);
            $value = "'" . implode("', '", $value) . "'";
            $table = static::$relationTable;
            $stmt = static::getDB()->prepare("INSERT INTO $table ($key) VALUES($value)");   
            $stmt->execute();
            return static::getDB()->lastInsertId();  
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function fetchAllProduct(){
        try{
            $db = static::getDB();
            $table = self::$table;
            $stmt = $db->query("SELECT
                                    *
                                FROM
                                    $table");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function updateProduct($data, $id) {
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

    public static function filter($data) {
        $filterdata['productImage'] = $_FILES['userFile']['name'];
        $filterdata['productUrlKey'] = str_replace([" ", "&"], ["-", "%20"], strtolower($data['txtProductName']));
            foreach($data as $key => $value) {
                switch($key) {
                    case 'txtProductName':
                        $filterdata['productName'] = $value;
                    break;

                    case 'txtProductPrice':
                        $filterdata['productPrice'] = $value;
                    break;

                    case 'txtShortDesc':    
                        $filterdata['productShortDesc'] = $value;
                    break;

                    case 'txtStock':
                        $filterdata['productStock'] = $value;
                    break;

                    case 'txtDesc':
                        $filterdata['productDesc'] = $value;
                    break;

                    case 'txtDesc':
                        $filterdata['productDesc'] = $value;
                    break;

                }
            }
        return $filterdata;
    }
      
}