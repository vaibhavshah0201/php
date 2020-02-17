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
        $data = $this->filter($_POST);
        $insertId = PageModel::insertPage($data); 
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
        $data = $this->filter($_POST);
        $count = PageModel::updatePage($data, $param);
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

    protected function filter($data) {
        $filterdata = [];
        $filterdata['cmsUrlKey'] = str_replace([" ", "&"], ["-", "%20"], strtolower($data['textPageName'])).'-page';
        foreach($data as $key => $value) {
            switch($key) {
                case 'textPageName':
                    $filterdata['cmsPageTitle'] = $value;
                break;

                case 'textPageDesc':
                    $filterdata['cmsContent'] = $value;
                break;
            }
        }
        return $filterdata;
    }
}