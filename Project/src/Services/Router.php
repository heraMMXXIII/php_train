<?php

namespace src\Services;

class Router
{
    private array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function dispatch(string $uri): void
    {
        foreach ($this->routes as $pattern => $handler) {
            if (preg_match($pattern, $uri, $matches)) {
                [$controllerClass, $method] = $handler;
                
                if (!class_exists($controllerClass)) {
                    throw new \Exception("Controller class {$controllerClass} not found");
                }
                
                $controller = new $controllerClass();
                $controller->$method($matches[1] ?? null);
                return;
            }
        }
        
        throw new \Exception("Route not found for URI: {$uri}");
    }
}