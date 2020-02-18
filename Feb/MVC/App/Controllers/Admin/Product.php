<?php

namespace App\Controllers\Admin;
use App\Models\Admin\Product as ProductModel;
use App\Models\Admin\Category;
use \Core\View;
use App\Config;

class Product extends \Core\Controller {

    public function indexAction() {
        $products = ProductModel::fetchAllProduct();
        View::renderTemplate('Admin/Product/product.html',[
            'products' => $products
        ]);
    }

    public function add() {
        $category = Category::fetchSubCategory();
        View::renderTemplate('Admin/Product/newproduct.html',[
            'category' => $category
        ]);
    }

    public function addProductAction(){
        $this->imageProcess();
        $filterdata = ProductModel::filter($_POST);
        $insertId = ProductModel::insertProduct($filterdata); 
        if($insertId > 0) { 
            $proctCat['productId'] = $insertId;
            $proctCat['catId'] = $_POST['selectCategory'];
            $lastId = ProductModel::insertProductCat($proctCat);
            if($lastId > 0){
                header('Location:'. Config::BASE_URL.'admin/product/index');
            } else {
                View::renderTemplate('500.html');
            }
            
        } else {
            View::renderTemplate('500.html');
        }
    }

    

    public function deleteProduct(){
        $param = $this->route_params['id'];
        $count = ProductModel::delete($param);
        if($count > 0) {
            header('Location:'. Config::BASE_URL.'admin/Product/index');
        } else {
            View::renderTemplate('500.html');
        }
    }

    public function updateProductView(){
        $param = $this->route_params['id'];
        $allCat = Category::fetchSubCategory();
        $displayData = ProductModel::fetchRow($param);
        View::renderTemplate('Admin/Product/updateproduct.html',[
            'allCat' => $allCat,
            'displayData' => $displayData
        ]);
    }

    public function update(){   
        $this->imageProcess();
        $param = $this->route_params['id'];
        $count = ProductModel::updateProduct($_POST, $param);
        if($count > 0) {
            header('Location:'. Config::BASE_URL.'admin/Product/index');
        } else {
            View::renderTemplate('500.html');
        }
    }

    public function imageProcess(){
        if(!empty($_FILES['userFile'])) {
            $name = $_FILES['userFile']['name'];
            $size = $_FILES['userFile']['size'];
            $type = $_FILES['userFile']['type'];
            $tmp_name = $_FILES['userFile']['tmp_name'];
            $uploadPath = '../resources/uploads/';
            $extension = strtolower(substr($name,strpos($name,'.')+1));
            if(($extension === 'jpeg' || $extension === 'png') && ($type === 'image/png' || $type === 'image/jpeg')) {
                    if($size < 3526840) {
                        if(move_uploaded_file($tmp_name,$uploadPath.$name)) {
                            echo "File Uploaded";
                        } else {
                            echo "Something want wrong";
                        } 
                    } else {
                        echo "Please select file upto 2 Mb";
                    }
            } else {
                echo "Please select only image file";
            }
        } else {
            echo "Please Select the file";
        }
    }
    
}
