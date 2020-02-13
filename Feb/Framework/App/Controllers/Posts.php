<?php
/* Posts Controller */
namespace App\Controllers;

use \Core\View;
use App\Models\Post;

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
        $lastId = POST::insertPost($_POST);  
        if($lastId > 0) {
            View::renderTemplate('Posts/newPost.html',[
                'view' => true
            ]);   
        } else {
            echo "fail";
        }
    }   


}