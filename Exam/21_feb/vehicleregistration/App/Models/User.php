<?php

/* Product Model */
namespace App\Models;

use PDO;

class User extends \Core\Model{

    protected static $table = 'users';
    protected static $primaryKey = 'userId';
    

    public static function checkLogin($data) {
        try{
            $db = static::getDB();
            $table = self::$table;
            $stmt = $db->query("SELECT
                                    userId, firstName
                                FROM
                                    $table 
                                WHERE 
                                    email = '$data[txtemail]' 
                                AND
                                    password = '$data[txtpassword]' ");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function insertUser($data){
        $filterUserData = Static::filterUser($data);
        $lastId = parent::insert($filterUserData);
        $_SESSION['userId'] = $lastId;
        return Static::insertAddress($data, $lastId); 
    }

    public static function insertAddress($data, $key){
        $filterAddressData = Static::filterUserAddress($data, $key);
        return parent::insert($filterAddressData, "user_addresses");
    }
    
    public static function filterUser($data) {
        $filterdata = [];
            foreach($data as $key => $value) {
                switch($key) {
                    case 'txtFname':
                        $filterdata['firstName'] = $value;
                    break;

                    case 'txtLname':
                        $filterdata['lastName'] = $value;
                    break;

                    case 'txtEmail':    
                        $filterdata['email'] = $value;
                    break;

                    case 'txtPassword':
                        $filterdata['password'] = $value;
                    break;
                }
            }
        return $filterdata;
    }

    public static function filterUserAddress($data, $id) {
        $filterdata['userId'] = $id;
            foreach($data as $key => $value) {
                switch($key) {
                    case 'txtStreet':
                        $filterdata['streeet'] = $value;
                    break;

                    case 'txtCity':
                        $filterdata['city'] = $value;
                    break;

                    case 'selectState':    
                        $filterdata['state'] = $value;
                    break;
                }
            }
        return $filterdata;
    }
}