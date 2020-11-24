<?php declare(strict_types = 1);

namespace Api\Adapter;

interface RepositoryInterface
{
    public function find($table, $id);
    public function save($table, $data);
    public function update($table, $data);
}
