<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Enums\EventType;
use App\Repositories\ActivityEventRepository;

final class PageController{
    public function __construct(
        private View $view,
        private ActivityEventRepository $activityEventRepository
    ){}
    public function pageA(Request $request) : Response{
        $userId = $_SESSION['user']['id'];
        $this->activityEventRepository->create($userId, EventType::PageView, 'page-a');

        return $this->view->render('pages/page-a', ['user' => $_SESSION['user']]);
    }

     public function buyCow(Request $request) : Response{
        $userId = $_SESSION['user']['id'];
        $this->activityEventRepository->create($userId, EventType::ButtonClick, 'buy_cow');

        return Response::json(['message' => 'thankYou'], 201);

    }
}