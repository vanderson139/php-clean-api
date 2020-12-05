<?php declare(strict_types = 1);

namespace Core\Adapter;

interface ResetRepositoryInterface extends RepositoryInterface
{
    public function drop(): bool;
}
