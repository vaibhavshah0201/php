<?php
/* Admin Controller */
namespace App\Controllers;
use \Core\View;
use App\Config;

class Admin extends \Core\Controller {
    
    //show the index page.
    public function loginAction() {
        View::renderTemplate('Admin/Login.html');  
    }

    public function checkCredetials() {
        if($_POST['txtemail'] === Config::USER_NAME && $_POST['txtpwd'] === Config::USER_PASSWORD) {
            //  header('Loction:'.Config::BASE_URL.'admin/dashboardView');
            $this->dashboardView(); 
        } else {
            View::renderTemplate('Admin/Login.html',[
                'login' => true
            ]);
        }
    }

    public function dashboardView(){
        View::renderTemplate('Admin/dashboard.html');  
    }

}