<?php
declare(strict_types=1);
namespace App\Http\Middleware;

use App\Core\Request;
use App\Core\Response;
use App\Http\Middleware\Middleware;

final class AuthMiddleware implements Middleware{
    public function handle(Request $request, callable $next): Response{
        if(!isset($_SESSION['user'])){
            return Response::redirect('/login');
        }

        return $next($request);
    }

}