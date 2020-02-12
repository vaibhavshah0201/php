<?php

namespace App\Controllers;
use \Core\View;
/* Posts Controller */
class Posts extends \Core\Controller {
    
    //show the index page.
    public function indexAction() {
        View::renderTemplate('Posts/index.html');
    }

    public function addNew() {
        echo "hello this is addNew action from posts controller";
    }

    public function edit() {
        echo "this is edit action from posts controller";
        echo "<pre>".htmlspecialchars(print_r($this->route_params, true));
    }
}