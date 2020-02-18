<?php

/* Product Model */
namespace App\Models\Admin;

use PDO;

class Pages extends \Core\Model{

    protected static $table = 'cms_pages';
    protected static $primaryKey = 'cmsId';
    

    public static function insertPage($data) {
        try{
            $data = Static::filter($data);
            $key = array_keys($data);
            $value = array_values($data);
            return parent::insert($key, $value);
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function updatePage($data, $id) {
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

    public static function filter($data) {
        $filterdata = [];
        $filterdata['cmsUrlKey'] = str_replace([" ", "&"], ["-", "%20"], strtolower($data['textPageName'])).'-page';
        foreach($data as $key => $value) {
            switch($key) {
                case 'textPageName':
                    $filterdata['cmsPageTitle'] = $value;
                break;

                case 'textPageDesc':
                    $filterdata['cmsContent'] = $value;
                break;
            }
        }
        return $filterdata;
    }
    
}