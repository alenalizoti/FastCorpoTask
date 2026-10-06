<?php

declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    exit('This script can only be run from the command line.');
}

require __DIR__ . '/../vendor/autoload.php';

$container = require __DIR__ . '/../bootstrap/app.php';
$pdo = $container->get(PDO::class);

$name     = 'Admin';
$email    = 'admin@example.com';
$password = 'Test.123!';

$stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
$stmt->execute([$email]);

if ($stmt->fetch()) {
    echo "Admin {$email} already exists." . PHP_EOL;
    exit;
}

$stmt = $pdo->prepare('INSERT INTO users (name, email, password_hash, role) VALUES (?, ?, ?, ?)');
$stmt->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT), 'admin']);

echo "Admin {$email} created." . PHP_EOL;