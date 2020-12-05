<?php declare(strict_types=1);

namespace Core\Repository;

use Core\Adapter\Database\EntityInterface;
use Core\Adapter\Repository\RepositoryInterface;
use Core\Service\Database;

abstract class AbstractRepository implements RepositoryInterface
{
    
    protected $table;

    public function find(int $id): ?EntityInterface
    {
        return Database::getConnection()->find($this->getTable(), $id);
    }

    public function save(array $data = []): ?int
    {
        return Database::getConnection()->save($this->getTable(), $data);
    }

    public function update(EntityInterface $entity): ?int
    {
        return Database::getConnection()->update($this->getTable(), $entity);
    }
    
    protected function getTable(): string
    {
        return $this->table;
    }
}