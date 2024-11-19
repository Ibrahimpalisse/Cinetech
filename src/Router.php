<?php
// src/Router.php
namespace App;

class Router {
    private $routes = [];

    public function addRoute($path, $controller, $method) {
        $this->routes[$path] = [$controller, $method];
    }

    public function dispatch($path) {
        if (isset($this->routes[$path])) {
            [$controllerClass, $method] = $this->routes[$path];
            $controller = new $controllerClass();
            return $controller->$method();
        }
        http_response_code(404);
        echo "404 Not Found";
    }
}
