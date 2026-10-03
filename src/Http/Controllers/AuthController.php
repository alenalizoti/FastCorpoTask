<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Core\Request;
use App\Core\Response;

final class AuthController{
    public function showRegister(Request $request) : Response {
        return Response::html('<h1>Register Page</h1>');
    }
}