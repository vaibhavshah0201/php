<?php
/* Posts Controller */
namespace App\Controllers;

use \Core\View;
use App\Models\Post;
use App\Config;
use \Core\Router;

class Posts extends \Core\Controller {
    
    //show the index page.
    public function indexAction() {
        $posts = POST::getAll();   
        View::renderTemplate('Posts/index.html',[
            'posts' => $posts
        ]);
    }

    public function addNew() {
        View::renderTemplate('Posts/newPost.html');
    }

    public function edit() {
        echo "this is edit action from posts controller";
        echo "<pre>".htmlspecialchars(print_r($this->route_params, true));
    }

    public function insert(){
        echo $lastId = POST::insertPost($_POST); 
        die(); 
        if($lastId > 0) {
            View::renderTemplate('Posts/newPost.html',[
                'view' => true
            ]);   
        } else {
            View::renderTemplate('500.html');
        }
    }   

    public function updateAction() {
        $id = $this->route_params['id'];
        $fetchData = POST::fetchRow($id);
        View::renderTemplate('Posts/update.html',[
            'fetchData' => $fetchData
        ]);        
    }

    public function updateData() {
        $id = $this->route_params['id'];
        $updateCount = POST::updatePost($_POST,$id);
        if($updateCount > 0) {
            header('Location: '.Config::BASE_URL .'posts/index');
        }
    }

    public function deletePost(){
        $id = $this->route_params['id'];
        $updateCount = POST::deletePost($id);
        if($updateCount > 0) {
            header('Location: '.Config::BASE_URL .'posts/index');
        }
    }

    



}