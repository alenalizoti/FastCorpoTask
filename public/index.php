<?php
declare(strict_types=1);
use App\Core\Request;
use App\Core\Router;



require __DIR__ . '/../vendor/autoload.php';

$container = require __DIR__ . '/../bootstrap/app.php';
session_start([
    'cookie_httponly' => true,
    'cookie_samesite' => 'Lax',
]);
$router = new Router($container);
$routes = require __DIR__ . '/../routes/web.php';
$routes($router);

$router->dispatch(Request::fromGlobals())->send();
