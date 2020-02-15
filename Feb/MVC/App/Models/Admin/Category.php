<?php

/* Product Model */
namespace App\Models\Admin;

use PDO;

class Category extends \Core\Model{

    protected static $table = 'categories';
    protected static $primaryKey = 'catId';
    

    public static function insertCategory($data) {
        try{
            $filterdata = Static::filter($data);
            $key = array_keys($filterdata);
            $value = array_values($filterdata);
            return parent::insert($key, $value);
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    protected static function filter($data) {
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