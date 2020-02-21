<?php

/* Product Model */
namespace App\Models;

use PDO;

class Vehicle extends \Core\Model{

    protected static $table = 'service_registrations';
    protected static $primaryKey = 'serviceId';
    

    public static function insertVehicle($data){
        $filterData = Static::filter($data);
        $filterData['userId'] = $_SESSION['userId'];
        $lastId = parent::insert($filterData);
        // $_SESSION['serviceId'] = $lastId;
        return $lastId;
        
    }

    public static function updateService($data, $id) {
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

    public static function checkData($data) {
            try{
                $db = static::getDB();
                $table = self::$table;
                $stmt = $db->query("SELECT
                                        userId
                                    FROM
                                        $table 
                                    WHERE 
                                        vehicleNumber = '$data[txtNumber]' 
                                    OR
                                        userLicenseNumber = '$data[txtLicenseNumber]' ");
                $results = $stmt->fetch(PDO::FETCH_ASSOC);
                return $results;
                
                
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

    public static function CheckTimeSlot($data) {
        try{
            $db = static::getDB();
            $table = self::$table;
            $stmt = $db->query("SELECT
                                    COUNT(`timeslot`) As time
                                FROM
                                    $table
                                WHERE
                                    `DATE` = '$data[txtdate]' 
                                AND 
                                    `timeslot` = $data[selectTimeSlot]");
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            return $results;
            
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function fetchAllServices() {
        try{
            $db = static::getDB();
            $table = self::$table;
            $stmt = $db->query("SELECT * FROM $table WHERE userId = $_SESSION[userId] ");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    public static function filter($data) {
        $filterdata = [];
            foreach($data as $key => $value) {
                switch($key) {
                    case 'txtTitle':
                        $filterdata['title'] = $value;
                    break;

                    case 'txtNumber':
                        $filterdata['vehicleNumber'] = $value;
                    break;

                    case 'txtLicenseNumber':    
                        $filterdata['userLicenseNumber'] = $value;
                    break;

                    case 'txtdate':
                        $filterdata['date'] = $value;
                    break;

                    case 'selectTimeSlot':
                        $filterdata['timeslot'] = $value;
                    break;

                    case 'txtIssue':
                        $filterdata['vehicleIssue'] = $value;
                    break;

                    case 'selectCenter':
                        $filterdata['serviceCentre'] = $value;
                    break;
                }
            }
        return $filterdata;
    }

}