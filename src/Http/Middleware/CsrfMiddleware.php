<?php
declare(strict_types=1);
namespace App\Http\Middleware;
use App\Http\Middleware\Middleware;
use App\Core\Request;
use App\Core\Response;

final class CsrfMiddleware implements Middleware{
    public function handle(Request $request, callable $next): Response{
        $token = $request->input('_csrf', '');

        if(!is_string($token) || !hash_equals($_SESSION['csrf'], $token)){
            return Response::html('419 Page Expired', 419);
        }

        return $next($request);
    }
}