<?php

declare(strict_types=1);
namespace App\Http\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Enums\EventType;
use App\Repositories\ActivityEventRepository;
use App\Repositories\UserRepository;

final class StatsController {
    public function __construct(
        private View $view,
        private UserRepository $userRepostpry,
        private ActivityEventRepository $activityEventRepository
    ) {}
    public function index(Request $request) : Response{
        $userId = $request->input('user_id', '');
        $userId = is_string($userId) && ctype_digit($userId) ? (int) $userId : null;
        $eventType = EventType::tryFrom((string) $request->input('action',''));

        $dateFrom  = $this->validDate($request->input('date_from', ''));
        $dateTo    = $this->validDate($request->input('date_to', ''));
        return $this->view->render('pages/stats', [
            'title'   => 'Stats',
            'user'    => $_SESSION['user'],
            'events'  => $this->activityEventRepository->search($userId, $eventType, $dateFrom, $dateTo),
            'users'   => $this->userRepostpry->all(),
            'actions' => EventType::cases(),
            'filters' => [
                'user_id'   => $userId,
                'action'    => $eventType?->value,
                'date_from' => $dateFrom,
                'date_to'   => $dateTo,
            ],
        ]);
    }

    private function validDate(mixed $value): ?string
    {
        if (!is_string($value)) {
            return null;
        }

        $date = \DateTimeImmutable::createFromFormat('!Y-m-d', $value);

        return $date && $date->format('Y-m-d') === $value ? $value : null;
    }
}