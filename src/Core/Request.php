<?php
declare(strict_types=1);
namespace App\Core;

final class Request{
    public function __construct(
        public readonly string $method,
        public readonly string $path,
        public readonly array $input
    ) {}

    public static function fromGlobals() : self{
        $method = strtoupper(($_SERVER['REQUEST_METHOD'] ?? 'GET'));
        $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ? : '/';
        $path = \rtrim($path, '/') ? : '/';

        if (str_contains($_SERVER['CONTENT_TYPE'] ?? '', 'application/json')){
            $input = json_decode(file_get_contents('php://input') ? : '', true);
            if (!is_array($input)){
                $input = [];
            }
        }else{
            $input = $_POST;
        }
        $input = array_merge($_GET, $input);
        return new self($method, $path, $input);
    }
    public function input(string $key, mixed $default = null): mixed{
        return $this->input[$key] ?? $default;
    }
}