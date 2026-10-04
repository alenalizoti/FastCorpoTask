<?php
declare(strict_types=1);
namespace App\Core;

final class Response{
    public function __construct(
        private string $body = '',
        private int $statusCode = 200,
        private array $headers = []
    ) {}

    public static function html(string $html, int $statusCode = 200) : self {
        return new self(
            $html,
            $statusCode,
            ['Content-Type' => 'text/html; charset=utf-8']
        );
    }
    public static function json(array $data, int $statusCode = 200) : self{
        return new self(
            json_encode($data, JSON_THROW_ON_ERROR),
            $statusCode,
            ['Content-Type' => 'application/json; charset=utf-8']
        );
    }
    public static function redirect(string $url, int $statusCode = 303) : self{
        return new self(
            '',
            $statusCode,
            ['Location' => $url]
        );
    }

    public static function download(string $path, string $filename) : self{
        return new self(
            file_get_contents($path),
            200,
            [
                'Content-Type'        => 'application/octet-stream',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                'Content-Length'      => (string) filesize($path),
            ]
        );
    }

    public function send() : void{
        http_response_code($this->statusCode);
        foreach ($this->headers as $name => $value) {
            header("{$name}: {$value}");
        }
        echo $this->body;
    }
}