<?php

declare(strict_types=1);
use App\Core\Container;
use App\Core\View;
use App\Core\Database;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StatsController;
use App\Http\Middleware\AdminMiddleware;
use App\Repositories\ActivityEventRepository;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use App\Http\Middleware\AuthMiddleware;


$container = new Container();

$container->set(View::class, fn() => new View(__DIR__ . '/../views'));
$container->set(PDO::class, fn() => Database::connect(require __DIR__ . '/../config/database.php'));

$container->set(AuthController::class, fn(Container $c) => new AuthController
($c->get(View::class),
($c->get(AuthService::class))
));
$container->set(UserRepository::class, fn(Container $c) => new UserRepository($c->get(PDO::class)));
$container->set(ActivityEventRepository::class, fn(Container $c) => new ActivityEventRepository($c->get(PDO::class)));
$container->set(AuthService::class, fn(Container $c) => new AuthService(
    $c->get(PDO::class),
    $c->get(UserRepository::class),
    $c->get(ActivityEventRepository::class),
));
$container->set(AuthMiddleware::class, fn() => new AuthMiddleware());
$container->set(PageController::class, fn(Container $c) => new PageController(
    $c->get(View::class),
    $c->get(ActivityEventRepository::class),
));

$container->set(AdminMiddleware::class, fn() => new AdminMiddleware());
$container->set(StatsController::class, fn(Container $c) => new StatsController(
    $c->get(View::class),
    $c->get(UserRepository::class),
    $c->get(ActivityEventRepository::class)
));

return $container;