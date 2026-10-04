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

    public function pageB(Request $request) : Response{
        $userId = $_SESSION['user']['id'];
        $this->activityEventRepository->create($userId, EventType::PageView, 'page-b');

        return $this->view->render('pages/page-b', ['user' => $_SESSION['user']]);
    }

    public function download(Request $request) : Response{
        $path = __DIR__ . '/../../../storage/test.exe';
        if (!is_file($path)) {
            throw new \RuntimeException('Download file is missing.');
        }

        $userId = $_SESSION['user']['id'];
        $this->activityEventRepository->create($userId, EventType::ButtonClick, 'download');

        return Response::download($path, 'test.exe');
    }
}