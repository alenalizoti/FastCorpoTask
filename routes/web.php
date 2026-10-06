<?php
declare(strict_types=1);
use App\Http\Controllers\AuthController;
use App\Core\Router;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StatsController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\PageController;
use App\Http\Middleware\CsrfMiddleware;


return function (Router $router) : void {
    $router->get('/register', [AuthController::class, 'showRegister']);
    $router->post('/register',[AuthController::class, 'register'], [CsrfMiddleware::class]);
    $router->get('/login', [AuthController::class, 'showLogin']);
    $router->post('/login',[AuthController::class, 'login'], [CsrfMiddleware::class]);
    $router->post('/logout', [AuthController::class, 'logout'], [AuthMiddleware::class, CsrfMiddleware::class]);

    $router->get('/page-a', [PageController::class, 'pageA'], [AuthMiddleware::class]);
    $router->post('/page-a/buy', [PageController::class, 'buyCow'], [AuthMiddleware::class, CsrfMiddleware::class]);
    $router->get('/page-b', [PageController::class, 'pageB'], [AuthMiddleware::class]);
    $router->post('/page-b/download', [PageController::class, 'download'], [AuthMiddleware::class, CsrfMiddleware::class]);

    $router->get('/stats', [StatsController::class, 'index'], [AuthMiddleware::class, AdminMiddleware::class]);
    $router->get('/report', [ReportController::class, 'index'], [AuthMiddleware::class, AdminMiddleware::class]);
};
