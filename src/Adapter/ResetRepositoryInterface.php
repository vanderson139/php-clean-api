<?php declare(strict_types = 1);

namespace Api\Adapter;

interface ResetRepositoryInterface extends RepositoryInterface
{
    public function create();
    public function drop();
}
