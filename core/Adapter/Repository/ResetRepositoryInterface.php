<?php declare(strict_types = 1);

namespace Core\Adapter\Repository;

interface ResetRepositoryInterface extends RepositoryInterface
{
    public function drop(): bool;
}
