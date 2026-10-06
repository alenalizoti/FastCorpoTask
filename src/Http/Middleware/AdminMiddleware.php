<?php

declare(strict_types=1);
namespace App\Http\Middleware;
use App\Core\Request;
use App\Core\Response;
use App\Http\Middleware\Middleware;

final class AdminMiddleware implements Middleware{
    public function handle(Request $request, callable $next) : Response {
        if($_SESSION['user']['role'] !== 'admin'){
            return Response::html('403 Forbidden', 403);
        }

        return $next($request);
    }
}