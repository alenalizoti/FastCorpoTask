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

    public function search(?int $userId, ?EventType $eventType, ?string $dateFrom, ?string $dateTo, int $limit = 100) : array {
        $sql = 'select e.id, e.event_type, e.target, e.created_at, u.name as user_name, u.email as user_email 
        from activity_events e
        left join users u on u.id = e.user_id';

        $where = [];
        $params = [];

        if($userId !== null){
            $where[] = 'e.user_id = ?';
            $params[] = $userId;
        }
        if($eventType !== null){
            $where[] = 'e.event_type = ?';
            $params[] = $eventType->value;
        }
        if($dateFrom !== null){
            $where[] = 'e.created_at >= ?';
            $params[] = $dateFrom . ' 00:00:00';
        }
        if($dateTo !== null){
            $where[] = 'e.created_at < ?';
            $params[] = (new \DateTimeImmutable($dateTo))->modify('+1 day')->format('Y-m-d 00:00:00');
        }

        if($where !== []){
            $sql .= ' where ' . implode(' and ', $where);
        }

        $sql .= ' order by e.created_at DESC, e.id desc limit ' . $limit;

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }
}