<?php declare(strict_types = 1);

namespace Core\Adapter\Database;

interface ConnectionInterface
{
    public function connect(): ConnectionInterface;
    public function find(string $table, int $id): ?EntityInterface;
    public function save(string $table, array $data): ?int;
    public function update(string $table, EntityInterface $entity): ?int;
    public function reset(): bool;
}
