<?php
/* Home Controller */
namespace App\Controllers;
use App\Models\Admin\Pages as PageModel;
use App\Models\Admin\Category as CategoryModel;
use App\Models\Home as HomeModel;
use \Core\View;

class Home extends \Core\Controller {
    
    //show the index page.
    public function __construct() {
        
        $result = PageModel::getAll();
        View::renderTemplate('navigation.html',[
            'pages' => $result
        ]);
    }
    
    public function indexAction() {
        $result = CategoryModel::getAllCat();
        View::renderTemplate('Home/index.html', [
            'data' => $result
        ]);  
    }


    public function viewAction($url_key) {
        $result = HomeModel::getPages($url_key);
        View::renderTemplate('Home/viewpage.html',[
            'data' => $result
        ]);
    }

    
}