<?php
declare(strict_types=1);
use App\Http\Controllers\AuthController;
use App\Core\Router;


return function (Router $router) : void {
    $router->get('/register', [AuthController::class, 'showRegister']);
    $router->post('/register',[AuthController::class, 'register']);
};
