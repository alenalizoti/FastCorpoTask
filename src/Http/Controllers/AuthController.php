<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Core\Request;
use App\Core\View;
use App\Core\Response;

final class AuthController{
    public function __construct(private View $view){}
    public function showRegister(Request $request) : Response {
        return $this->view->render('auth/register');
    }
}