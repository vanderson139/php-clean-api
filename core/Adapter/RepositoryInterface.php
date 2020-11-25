<?php declare(strict_types = 1);

namespace Core\Adapter;

interface RepositoryInterface
{
    public function find($id);
    public function save($data);
    public function update($entity, $data);
}
