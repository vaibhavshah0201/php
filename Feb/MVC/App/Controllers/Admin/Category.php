<?php

namespace App\Controllers\Admin;
use App\Models\Admin\Category as CategoryModel;
use \Core\View;
use App\Config;



class Category extends \Core\Controller {

    public function indexAction() {
        View::renderTemplate('Admin/Category/category.html');
    }

    public function add() {
        View::renderTemplate('Admin/Category/newcategory.html');
    }

    public function addCategoryAction(){
        $insertId = CategoryModel::insertCategory($_POST); 
        if($insertId > 0) {
            // header('Location:'. Config::BASE_URL.'admin/product/index');   
            echo "test";
        } else {
            View::renderTemplate('500.html');
        }
    }
}