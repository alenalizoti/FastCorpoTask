<?php
declare(strict_types=1);
namespace App\Services;

use App\Enums\EventType;
use App\Repositories\ActivityEventRepository;
use App\Repositories\UserRepository;
use Exception;
use Throwable;

final class AuthService {
    public function __construct(
        private \PDO $pdo,
        private UserRepository $userRepository,
        private ActivityEventRepository $activityRepository
    ) {}

    public function register(string $name, string $email, string $password) : int{
        $user = $this->userRepository->findByEmail($email);
        if($user){
            throw new \DomainException('Email is already taken.');
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $this->pdo->beginTransaction();

        try{
            $userId = $this->userRepository->create($name, $email, $hash);
            $this->activityRepository->create($userId, EventType::Register);

            $this->pdo->commit();
        }catch (Throwable $e){
            $this->pdo->rollBack();
            throw $e;
        }

        return $userId;
    }
}