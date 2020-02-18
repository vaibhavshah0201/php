<?php

namespace App\Controllers\Admin\CMS;
use App\Models\Admin\Pages as PageModel;
use \Core\View;
use App\Config;



class Pages extends \Core\Controller {

    public function indexAction() {
        $result = PageModel::getAll();
        View::renderTemplate('Admin/CMS/pages.html',[
            'pages' => $result
        ]);
    }

    public function addPageView() { 
       View::renderTemplate('Admin/CMS/newpage.html');
    }

    public function addPageAction(){
        $insertId = PageModel::insertPage($_POST); 
        if($insertId > 0) {
            header('Location:'. Config::BASE_URL.'admin/cms/pages/index');   
        } else {
            View::renderTemplate('500.html');
        }
    }


    public function updatePageView(){
        $param = $this->route_params['id'];
        $displayData = PageModel::fetchRow($param);
        View::renderTemplate('Admin/CMS/updatepage.html',[
            'displayData' => $displayData
        ]);
    }

    public function update(){
        $param = $this->route_params['id'];
        $count = PageModel::updatePage($_POST, $param);
        if($count > 0) {
            header('Location:'. Config::BASE_URL.'admin/cms/pages/index');
        } else {
            View::renderTemplate('500.html');
        }
    }

    public function deletePage(){
        echo "call";
        $param = $this->route_params['id'];
        $count = PageModel::delete($param);
        if($count > 0) {
            header('Location:'. Config::BASE_URL.'admin/cms/pages/index');
        } else {
            View::renderTemplate('500.html');
        }
    }

    
}