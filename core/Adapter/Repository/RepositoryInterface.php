<?php declare(strict_types = 1);

namespace Core\Adapter\Repository;

use Core\Adapter\Database\EntityInterface;

interface RepositoryInterface
{
    public function find(int $id): ?EntityInterface;
    public function save(array $data = []): ?int;
    public function update(EntityInterface $entity): ?int;
}
