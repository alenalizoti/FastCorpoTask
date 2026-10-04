<?php
declare(strict_types=1);
use App\Http\Controllers\AuthController;
use App\Core\Router;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\PageController;


return function (Router $router) : void {
    $router->get('/register', [AuthController::class, 'showRegister']);
    $router->post('/register',[AuthController::class, 'register']);
    $router->get('/login', [AuthController::class, 'showLogin']);
    $router->post('/login',[AuthController::class, 'login']);
    $router->post('/logout', [AuthController::class, 'logout'], [AuthMiddleware::class]);

    $router->get('/page-a', [PageController::class, 'pageA'], [AuthMiddleware::class]);
    $router->post('/page-a/buy', [PageController::class, 'buyCow'], [AuthMiddleware::class]);
    $router->get('/page-b', [PageController::class, 'pageB'], [AuthMiddleware::class]);
    $router->post('/page-b/download', [PageController::class, 'download'], [AuthMiddleware::class]);


};
