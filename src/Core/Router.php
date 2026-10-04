<?php
declare(strict_types=1);
namespace App\Core;
use App\Core\Request;
use App\Core\Response;
use App\Core\Container;


class Router {
    private array $routes = [];

    public function __construct(private Container $container) {}

    public function get(string $path, array $handler, array $middleware = []): void {
        $this->routes['GET'][$path] = ['handler' => $handler, 'middleware' => $middleware];
    }

    public function post(string $path, array $handler, array $middleware = []) : void {
        $this->routes['POST'][$path] = ['handler' => $handler, 'middleware' => $middleware];
    }

    public function dispatch(Request $request) : Response {
        $method = $request->method;
        $path = $request->path;

        if (isset($this->routes[$method][$path])) {
            $route = $this->routes[$method][$path];
            [$controllerClass, $action] = $route['handler'];

        }else{
            return Response::html('404 Not Found', 404);
        }
    

        $controller = $this->container->get($controllerClass);
        $next = fn(Request $request) => $controller->$action($request);

        foreach (array_reverse($route['middleware']) as $middlewareClass) {
            $middleware = $this->container->get($middlewareClass);
            $next = fn(Request $request) => $middleware->handle($request, $next);
        }

        return $next($request);
    }

}