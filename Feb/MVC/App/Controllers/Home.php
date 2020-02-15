<?php
/* Home Controller */
namespace App\Controllers;
use \Core\View;

class Home extends \Core\Controller {
    
    //show the index page.
    public function indexAction() {
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