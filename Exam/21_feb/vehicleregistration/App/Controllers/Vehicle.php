<?php
/* Home Controller */
namespace App\Controllers;
use App\Models\Vehicle as VehicleModel;
use \Core\View;

class Vehicle extends \Core\Controller {
    
    //show the index page.
    
    public function newServiceView() {
        View::renderTemplate('Vehicle/newvehicle.html');  
    }

    public function viewServices() {
        $result = VehicleModel::fetchAllServices();
        View::renderTemplate('Vehicle/viewall.html',[
            'result' => $result
        ]);  
    }
    
    public function vehicleRegister(){
        $checkData = VehicleModel::checkData($_POST);
        if($checkData == null)
        {
            $data = VehicleModel::CheckTimeSlot($_POST);
            if($data['time'] >= 3) {
                View::renderTemplate('Vehicle/newvehicle.html',[
                    'time' => true
                ]);
            } else {
                $insertId = VehicleModel::insertVehicle($_POST); 
        if($insertId != 0){
            View::renderTemplate('User/index.html',[
                'register' => true
            ]);
        } else {
            echo "fail";
        }
            }
        } else
        {
            if($_SESSION['userId'] == $checkData['userId']){
                $data = VehicleModel::CheckTimeSlot($_POST);
            if($data['time'] >= 3) {
                View::renderTemplate('Vehicle/newvehicle.html',[
                    'time' => true
                ]);
            } else {
                $insertId = VehicleModel::insertVehicle($_POST); 
        if($insertId != 0){
            View::renderTemplate('User/index.html',[
                'register' => true
            ]);
        } else {
            echo "fail";
        }
            }
            } else {
                View::renderTemplate('Vehicle/newvehicle.html',[
                    'number' => true
                ]);  
            }
        }
    }

    public function insertVehicle(){
        $insertId = VehicleModel::insertVehicle($_POST); 
        if($insertId != 0){
            View::renderTemplate('User/index.html',[
                'register' => true
            ]);
        } else {
            echo "fail";
        }
    }

    public function checkCredentials() {
        $data = VehicleModel::checkLogin($_POST);
        if(sizeof($data) == NULL ){
            View::renderTemplate('Vehicle/login.html',[
                'login' => true
            ]);
        } else {
            $_SESSION['userId'] = $data[0]['id'];
            View::renderTemplate('Vehicle/index.html');
        }
            
    
    }

    // public function viewAction($url_key) {
    //     $result = HomeModel::getPages($url_key);
    //     View::renderTemplate('Home/viewpage.html',[
    //         'data' => $result
    //     ]);
    // }

    
}