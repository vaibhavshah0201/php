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
        $filterdata = $this->filter($_POST);
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

    protected static function filter($data) {
        $filterdata['productUrlKey'] = str_replace([" ", "&"], ["-", "%20"], strtolower($data['txtProductName']));
            foreach($data as $key => $value) {
                switch($key) {
                    case 'txtProductName':
                        $filterdata['productName'] = $value;
                    break;

                    case 'txtProductPrice':
                        $filterdata['productPrice'] = $value;
                    break;

                    case 'txtShortDesc':    
                        $filterdata['productShortDesc'] = $value;
                    break;

                    case 'txtStock':
                        $filterdata['productStock'] = $value;
                    break;

                    case 'txtDesc':
                        $filterdata['productDesc'] = $value;
                    break;

                    case 'txtDesc':
                        $filterdata['productDesc'] = $value;
                    break;
                }
            }
        return $filterdata;
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
        $param = $this->route_params['id'];
        $data = $this->filter($_POST);
        $count = ProductModel::updateProduct($data, $param);
        if($count > 0) {
            header('Location:'. Config::BASE_URL.'admin/Product/index');
        } else {
            View::renderTemplate('500.html');
        }
    }
    
}
