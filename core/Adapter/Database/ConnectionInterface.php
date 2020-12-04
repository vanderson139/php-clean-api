<?php declare(strict_types = 1);

namespace Core\Adapter\Database;

interface ConnectionInterface
{
    public function connect();
    public function find(string $table, int $id);
    public function save(string $table, array $data);
    public function update(string $table, $entity, array $data);
    public function reset();
}
