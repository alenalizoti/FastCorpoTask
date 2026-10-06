<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Repositories\ActivityEventRepository;

final class ReportController{
    public function __construct(
        private View $view,
        private ActivityEventRepository $activityEventRepository
    ){}
    public function index(Request $request) : Response{

        $to   = (new \DateTimeImmutable('today'))->format('Y-m-d');
        $from = (new \DateTimeImmutable('today'))->modify('-29 days')->format('Y-m-d');

        $rows = $this->activityEventRepository->dailyReport($from, $to);
        $report = $this->fillMissingDays($rows, $from, $to);

        return $this->view->render('pages/reports', [
            'title'  => 'Reports',
            'user'   => $_SESSION['user'],
            'report' => $report,
            'from'   => $from,
            'to'     => $to,
        ]);
    }

    private function fillMissingDays(array $rows, string $from, string $to): array
    {
        $byDay = array_column($rows, null, 'day');

        $period = new \DatePeriod(
            new \DateTimeImmutable($from),
            new \DateInterval('P1D'),
            (new \DateTimeImmutable($to))->modify('+1 day'),
        );

        $report = [];

        foreach ($period as $date) {
            $day = $date->format('Y-m-d');
            $row = $byDay[$day] ?? [];

            $report[] = [
                'day'             => $day,
                'page_a_views'    => (int) ($row['page_a_views'] ?? 0),
                'page_b_views'    => (int) ($row['page_b_views'] ?? 0),
                'buy_cow_clicks'  => (int) ($row['buy_cow_clicks'] ?? 0),
                'download_clicks' => (int) ($row['download_clicks'] ?? 0),
            ];
        }

        return $report;
    }
}