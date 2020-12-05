<?php declare(strict_types = 1);

namespace Core\Adapter;

use Core\Adapter\Database\EntityInterface;

interface RepositoryInterface
{
    public function find($id): ?EntityInterface;
    public function save($data): ?int;
    public function update($entity, $data): ?int;
}
