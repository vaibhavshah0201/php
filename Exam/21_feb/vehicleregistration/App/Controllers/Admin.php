<?php
/* Home Controller */
namespace App\Controllers;
use App\Models\Vehicle as VehicleModel;
use App\Models\Admin as AdminModel;
use \Core\View;
use App\Config;

class Admin extends \Core\Controller {
    
    //show the index page.
    
    public function indexAction() {
        View::renderTemplate('Admin/dashboard.html');  
    }

    public function viewAllServices() {
        $result = VehicleModel::getAll('service_registrations');
        View::renderTemplate('Admin/viewAllServices.html',[
            'result' => $result
        ]);  
    }

    public function viewAllUser() {
        $result = VehicleModel::getAll('users');
        View::renderTemplate('Admin/viewAllUser.html',[
            'result' => $result
        ]);  
    }
    
    public function updateService() {
        $param = $this->route_params['id'];
        $displayData = VehicleModel::fetchRow($param);
        View::renderTemplate('Vehicle/updatevehicle.html',[
            'displayData' => $displayData
        ]);
    }

    public function updateServiceData() {
        $param = $this->route_params['id'];
        $updateCount = VehicleModel::updateService($_POST, $param);
        if($updateCount > 0) {
            header('Location:'. Config::BASE_URL.'admin/viewAllServices');
        } else {
            View::renderTemplate('500.html');
        }
    }


    public function deleteService() {
        $param = $this->route_params['id'];
        $count =VehicleModel::delete($param);
        if($count > 0) {
            header('Location:'. Config::BASE_URL.'admin/viewAllServices');
        } else {
            View::renderTemplate('500.html');
        }
    }
    
}