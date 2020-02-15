<?php

namespace App\Controllers\Admin;
use App\Models\Admin\Product as ProductModel;
use \Core\View;
use App\Config;



class Product extends \Core\Controller {

    public function indexAction() {
        View::renderTemplate('Admin/Product/product.html');
    }

    public function add() {
        View::renderTemplate('Admin/Product/newproduct.html');
    }

    public function addProductAction(){
        $insertId = ProductModel::insertProduct($_POST); 
        if($insertId > 0) {
            // header('Location:'. Config::BASE_URL.'admin/product/index');   
            echo "test";
        } else {
            View::renderTemplate('500.html');
        }
    }
}