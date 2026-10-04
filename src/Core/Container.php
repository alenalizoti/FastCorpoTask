<?php
declare(strict_types=1);
namespace App\Core;

final class Container{
    private array $factories = [];
    private array $instances = [];

    public function set(string $id, callable $factory) : void {
        $this->factories[$id] = $factory;
    }
    public function get(string $id) : object {
        if(isset($this->instances[$id])){
            return $this->instances[$id];
        }

        if(!isset($this->factories[$id])){
            throw new \LogicException("Service {$id} not found");
        }

        $this->instances[$id] = $this->factories[$id]($this);
        return $this->instances[$id];
    }

    public function has(string $id) : bool {
        return isset($this->factories[$id]);
    }


}