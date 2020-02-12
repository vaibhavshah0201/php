<?php

namespace App\Controllers;
use \Core\View;
/* Home Controller */
class Home extends \Core\Controller {
    
    //show the index page.
    public function indexAction() {
        // echo "hello this is index action from Home controller";
        // View::render('Home/index.php',[
        //     'name' => 'ABC',
        //     'colour' => ['red', 'green', 'blue']
        // ]);
        View::renderTemplate('Home/index.html',[
            'name' => 'ABC',
            'colour' => ['red', 'green', 'blue']
        ]);  
    }

    protected function before() {
        // echo "(before)";
    }

    protected function after() {
        // echo "(after)";
    }

}