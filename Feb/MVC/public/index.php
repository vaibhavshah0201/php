<?php
/* Front Controller */


/*Autoloader*/
require '../vendor/autoload.php';

/*Error and Exception handling */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


$router = new Core\Router();

/*Add the routes*/

// $router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
// $router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('home', ['controller' => 'Home', 'action' => 'index']);
$router->add('{url}', ['controller' => 'Home', 'action' => 'view']);    
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\c+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
$router->add('admin/cms/{controller}/{action}', ['namespace' => 'Admin\CMS']);
$router->add('admin/{controller}/{action}/{id:\d+}', ['namespace' => 'Admin']);
$router->add('admin/cms/{controller}/{action}/{id:\d+}', ['namespace' => 'Admin\CMS']);
$router->add('{controller}/{action}/{url}');
$url = $_SERVER['QUERY_STRING'];

$router->dispatch($url);
// $router->getRoutes();