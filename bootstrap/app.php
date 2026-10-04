<?php

declare(strict_types=1);

use App\Core\Container;
use App\Core\View;
use App\Http\Controllers\AuthController;

$container = new Container();

$container->set(View::class, fn() => new View(__DIR__ . '/../views'));

$container->set(AuthController::class, fn(Container $c) => new AuthController($c->get(View::class)));

return $container;