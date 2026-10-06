<?php

declare(strict_types=1);
namespace App\Http\Controllers;

use App\Core\Request;
use App\Core\Response;

final class StatsController {
    public function index(Request $request) : Response{
        return Response::html('<h1>Stats</h1>');
    }
}