<?php
declare(strict_types=1);

namespace App\Core;

final class View {
    public function __construct(private string $basePath){}

    public function render(string $template, array $data= [], int $statusCode = 200) : Response {
        extract($data);
        ob_start();
        require $this->basePath . '/' . $template . '.php';

        return Response::html(ob_get_clean(), $statusCode);
    }
    public function e(mixed $value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }

}