<?php

namespace App\Controllers\Admin;
use App\Models\Admin\Category as CategoryModel;
use \Core\View;
use App\Config;



class Category extends \Core\Controller {

    public function indexAction() {
        $result = CategoryModel::fetchAllCategory();
        View::renderTemplate('Admin/Category/category.html',[
            'category' => $result
        ]);
    }

    public function add($error = "") {
        $result = CategoryModel::fetchCategory();     
       View::renderTemplate('Admin/Category/newcategory.html',[
           'parentCat' => $result,
           'error' => $error
       ]);
    }

    public function addCategoryAction(){
        $data = $this->filter($_POST);
        if((CategoryModel::isUniqueURL($data['catUrlKey']))) {
            $this->add("true");
        } else {
            $insertId = CategoryModel::insertCategory($data); 
            if($insertId > 0) {
                header('Location:'. Config::BASE_URL.'admin/Category/index');   
            } else {
                View::renderTemplate('500.html');
            }
        }
        
    }


    public function updateCategory(){
        $param = $this->route_params['id'];
        $allCat = CategoryModel::fetchCategory();
        $displayData = CategoryModel::fetchRow($param);
        View::renderTemplate('Admin/Category/updatecategory.html',[
            'allCat' => $allCat,
            'displayData' => $displayData
        ]);
    }

    public function update(){
        $param = $this->route_params['id'];
        $data = $this->filter($_POST);
        $count = CategoryModel::updateCat($data, $param);
        if($count > 0) {
            header('Location:'. Config::BASE_URL.'admin/Category/index');
        } else {
            View::renderTemplate('500.html');
        }
    }

    public function deleteCategory(){
        $param = $this->route_params['id'];
        $count = CategoryModel::delete($param);
        if($count > 0) {
            header('Location:'. Config::BASE_URL.'admin/Category/index');
        } else {
            View::renderTemplate('500.html');
        }
    }

    protected function filter($data) {
        $filterdata = [];
        $filterdata['catUrlKey'] = str_replace([" ", "&"], ["-", "%20"], strtolower($data['textCatName'])).'-store';
        foreach($data as $key => $value) {
            switch($key) {
                case 'textCatName':
                    $filterdata['catName'] = $value;
                break;

                case 'selectParent':
                    $filterdata['catParentId'] = $value;
                break;

                case 'textCatDesc':    
                    $filterdata['catDesc'] = $value;
                break;
            }
        }
        return $filterdata;
    }
}