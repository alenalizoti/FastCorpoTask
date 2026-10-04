<?php
declare(strict_types=1);
namespace App\Core;
use App\Core\Request;
use App\Core\Response;
use App\Core\Container;


class Router {
    private array $routes = [];

    public function __construct(private Container $container) {}

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
    

        $controller = $this->container->get($controllerClass);
        return $controller->$action($request);
    }

}