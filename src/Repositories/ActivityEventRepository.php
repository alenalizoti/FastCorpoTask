<?php
declare(strict_types=1);
namespace App\Repositories;

use App\Enums\EventType;

final class ActivityEventRepository{
    public function __construct(private \PDO $pdo){

    }

    public function create (?int $userId, EventType $eventType, ?string $target = null) : void{
        $stmt = $this->pdo->prepare('insert into activity_events (user_id,event_type,target) values (?,?,?)');
        $stmt->execute([$userId,$eventType->value,$target]); 
    }
}