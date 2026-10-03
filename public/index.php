<?php
declare(strict_types=1);
use App\Core\Request;
use App\Core\Router;

require __DIR__ . '/../vendor/autoload.php';

$router = new Router();
$routes = require __DIR__ . '/../routes/web.php';
$routes($router);

$router->dispatch(Request::fromGlobals())->send();
