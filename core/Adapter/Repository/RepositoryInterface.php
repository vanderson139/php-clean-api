<?php declare(strict_types = 1);

namespace Core\Adapter\Repository;

use Core\Adapter\Database\EntityInterface;

interface RepositoryInterface
{
    public function find($id): ?EntityInterface;
    public function save(array $data = []): ?int;
    public function update(EntityInterface $entity, array $data = []): ?int;
}
