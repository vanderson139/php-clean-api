<?php declare(strict_types=1);

namespace Core\Repository;

use Core\Adapter\RepositoryInterface;
use Core\Service\Database;

abstract class AbstractRepository implements RepositoryInterface
{
    
    protected $table;

    public function find($id)
    {
        return Database::getConnection()->find($this->getTable(), (int)$id);
    }

    public function save($data)
    {
        return Database::getConnection()->save($this->getTable(), $data);
    }

    public function update($entity, $data)
    {
        return Database::getConnection()->update($this->getTable(), $entity, $data);
    }
    
    protected function getTable()
    {
        return $this->table;
    }
}