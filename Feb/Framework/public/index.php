<?php
/* Front Controller */

//Twig

require '../vendor/autoload.php';


//Autoloader
// spl_autoload_register(function ($class) {
//     $root = dirname(__DIR__); // get the paret directory;
//     $file = $root . '/' . str_replace('\\', '/', $class) . '.php';    
//     if(is_readable($file)) {
//         require $root . '/' . str_replace('\\', '/', $class) . '.php';
//     }
// });

$router = new Core\Router();

//add the routes
// $router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
// $router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);

// echo "<pre>";
// // var_dump($router->getRoutes());
// echo htmlspecialchars(print_r($router->getRoutes(), true));  

$url = $_SERVER['QUERY_STRING'];
// if ($router->match($url)) {
//     var_dump($router->getParams());
// } else {
//     echo "NO route found $url";
// }
$router->dispatch($url);