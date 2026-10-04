<?php

declare(strict_types=1);
use App\Core\Container;
use App\Core\View;
use App\Core\Database;
use App\Http\Controllers\AuthController;
use App\Repositories\ActivityEventRepository;
use App\Repositories\UserRepository;

$container = new Container();

$container->set(View::class, fn() => new View(__DIR__ . '/../views'));
$container->set(PDO::class, fn() => Database::connect(require __DIR__ . '/../config/database.php'));

$container->set(AuthController::class, fn(Container $c) => new AuthController($c->get(View::class)));
$container->set(UserRepository::class, fn(Container $c) => new UserRepository($c->get(PDO::class)));
$container->set(ActivityEventRepository::class, fn(Container $c) => new ActivityEventRepository($c->get(PDO::class)));

return $container;