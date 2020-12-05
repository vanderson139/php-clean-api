<?php declare(strict_types=1);

namespace Core\Repository;

use Core\Adapter\Database\EntityInterface;
use Core\Adapter\RepositoryInterface;
use Core\Service\Database;

abstract class AbstractRepository implements RepositoryInterface
{
    
    protected $table;

    public function find($id): ?EntityInterface
    {
        return Database::getConnection()->find($this->getTable(), (int)$id);
    }

    public function save($data): ?int
    {
        return Database::getConnection()->save($this->getTable(), $data);
    }

    public function update($entity, $data): ?int
    {
        return Database::getConnection()->update($this->getTable(), $entity, $data);
    }
    
    protected function getTable(): string
    {
        return $this->table;
    }
}