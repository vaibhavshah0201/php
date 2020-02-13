<?php
/* Router */ 
namespace Core;

class Router {

    /* Associative array of routes */
    protected $routes = [];
    protected $params = [];

    /* Params from the routing table */
    /* Add a route to the routing table
        param ('controller', 'action,)
        return void
    */
    public function add($route, $params = []) {
        //convert the shalshes
        $route = preg_replace('/\//', '\\/', $route);

        //convert the variables e.g.{controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        //convert variables with custom regular exression e.g. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        //Add start and end delimters, and case flag
        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;

    }

    /* Get all the routes from the routing table 
        return array*/
    public function getRoutes() {
        return $this->routes;
    }

    /* Match the route and return boolean value */
    public function match($url) {
        foreach ($this->routes as $route => $params) {
            if(preg_match($route, $url, $matches)) {
                foreach($matches as $key => $match) {
                    if(is_string($key)) {
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /* Get the currently match parameters */
    public function getParams() {
        return $this->params;
    }

    public function dispatch($url) {
        $url= $this->removeQueryStringVaribles($url);

        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);
            $controller = $this->getNamespace() . $controller;

            if(class_exists($controller)) {
                $controller_object = new $controller($this->params);

                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);

                if(is_callable([$controller_object, $action])) {
                    $controller_object->$action();
                } else {
                    throw new \Exception("Method $action (in controller $controller) not found!");
                }
            } else {
                throw new \Exception("Controller class $controller not found");
            }
        } else {
            throw new \Exception("No route matched!!", 404);
        }
    }

    //Convert the string in to studlyCaps.
    protected function convertToStudlyCaps($string) {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string )));
    } 

    //convert the string in to camelCase.
    protected function convertToCamelCase($string) {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    protected function removeQueryStringVaribles($url) {
        if($url != '') {
            $parts = explode('&', $url, 2);

            if(strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }
        return $url;
    }

    protected function getNamespace() {
        $namespace = 'App\Controllers\\';

        if(array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'] . '\\';
        }
        return $namespace;
    }

}