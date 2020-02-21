<?php
/* Home Controller */
namespace App\Controllers;
use App\Models\User as UserModel;
use \Core\View;

class User extends \Core\Controller {
    
    //show the index page.
    
    public function indexAction() {
        View::renderTemplate('User/login.html');  
    }

    public function registerView() {
       
        View::renderTemplate('User/register.html');  
    }

    public function dashboard() {
       
        View::renderTemplate('User/index.html');  
    }
    
    public function userRegister(){
        $insertId = UserModel::insertUser($_POST); 
        if($insertId != 0){
            View::renderTemplate('User/index.html');
        } else {
            echo "fail";
        }
    }

    

    public function checkCredentials() {
        if(sizeof($data = UserModel::checkLogin($_POST)) == NULL ){
            View::renderTemplate('User/login.html',[
                'login' => true
            ]);
        } else {
            $_SESSION['userId'] = $data[0]['userId'];
            View::renderTemplate('User/index.html');
        }
            
    
    }

    public function viewAction($url_key) {
        $result = HomeModel::getPages($url_key);
        View::renderTemplate('Home/viewpage.html',[
            'data' => $result
        ]);
    }

    
}