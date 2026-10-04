<?php
declare(strict_types=1);
namespace App\Repositories;

final class UserRepository {
    public function __construct(private \PDO $pdo){}
        public function findByEmail(string $email) : ?array {
            $stmt = $this->pdo->prepare('select id,name, email, password_hash, role from users where email = ?');
            $stmt->execute([$email]);
            $row = $stmt->fetch();

            return $row ? : null;
        }

        public function create(string $name, string $email, string $password) : int{
            $stmt = $this->pdo->prepare('insert into users (name,email,password_hash) values (?,?,?)');
            $stmt->execute([$name, $email, $password]);

            return (int) $this->pdo->lastInsertId();
        }
}