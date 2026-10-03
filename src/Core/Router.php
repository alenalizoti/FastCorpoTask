<?php
declare(strict_types=1);
namespace App\Core;
use App\Core\Request;
use App\Core\Response;


class Router {
    private array $routes = [];

    public function get(string $path, array $handler): void {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, array $handler) : void {
        $this->routes['POST'][$path] = $handler;
    }

    public function dispatch(Request $request) : Response {
        $method = $request->method;
        $path = $request->path;

        if (isset($this->routes[$method][$path])) {
            $handler = $this->routes[$method][$path];
            [$controllerClass, $action] = $handler;

        }else{
            return Response::html('404 Not Found', 404);
        }

        if (!class_exists($controllerClass)) {
            throw new \LogicException("Controller {$controllerClass} not found");
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $action)) {
            throw new \LogicException("Method {$controllerClass}::{$action} not found");
        }

        return $controller->$action($request);
        

    }

}