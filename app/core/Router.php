<?php

class Router
{
    public function run()
    {
        $connection = new mysqli("localhost", "root", "", "prueba");
    
        if ($connection->connect_error) {
            die("Error de conexión: " . $connection->connect_error);
        }
    
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $segments = explode('/', $uri);
    
        $controllerName = empty($segments[3]) ? "login" : ucfirst($segments[3]);
        
        $methodName = !empty($segments[4]) ? $segments[4] : 'index';
        $controller = new $controllerName($connection);        
        $controller->$methodName();
    }
    private function notFound()
    {
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
    }
}