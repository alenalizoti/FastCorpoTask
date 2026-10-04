<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Core\Request;
use App\Core\View;
use App\Core\Response;
use App\Services\AuthService;
use \DomainException;

final class AuthController{
    public function __construct(private View $view, private AuthService $authService){}
    public function showRegister(Request $request) : Response {
        return $this->view->render('auth/register');
    }
    public function register(Request $request){
        $name = trim((string) $request->input('name',''));
        $email = $request->input('email','');
        $password = strtolower($request->input('password',''));

        $errors = $this->validateRegistration($name, $email, $password);

        if($errors != []){
            return $this->view->render('auth/register', [
                'errors' => $errors,
                'old' => ['name' => $name, 'email' => $email],
            ],422);
        }
        try{
            $userId = $this->authService->register($name, $email, $password);
        }catch(DomainException $e){
            return $this->view->render('auth/register', [
                'errors' => ['email' => $e->getMessage()],
                'old'    => ['name' => $name, 'email' => $email],
            ],422);
        }

        return Response::redirect('/login?registered=1');


    }
    private function validateRegistration($name, $email, $password) : array{
      $errors = [];

        if ($name === '') {
            $errors['name'] = 'Name is required.';
        } elseif (mb_strlen($name) > 100) {
            $errors['name'] = 'Name may not be longer than 100 characters.';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email address.';
        } elseif (strlen($email) > 255) {
            $errors['email'] = 'Email may not be longer than 255 characters.';
        }

        if (strlen($password) < 8) {
            $errors['password'] = 'Password must be at least 8 characters.';
        } elseif (strlen($password) > 72) {
            $errors['password'] = 'Password may not be longer than 72 characters.';
        }

        return $errors;
    }


}