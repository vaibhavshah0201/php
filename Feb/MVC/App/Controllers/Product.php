<?php

namespace App\Controllers;
// use App\Models\Category as CategoryModel;
use App\Models\Product as ProductModel;
use App\Models\Admin\Pages as PageModel;
use \Core\View;
use App\Config;



class Product extends \Core\Controller {

    public function __construct() {
        
        $result = PageModel::getAll();
        View::renderTemplate('navigation.html',[
            'pages' => $result
        ]);
    }


    public function viewAction($url_key) {
        $result = ProductModel::fetchProduct($url_key);
        View::renderTemplate('Home/productview.html',[
            'result' => $result
        ]);
    }
   
}