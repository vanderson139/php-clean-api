<?php declare(strict_types = 1);

namespace Core\Repository;

use Core\Adapter\ResetRepositoryInterface;
use Core\Service\Database;

class ResetRepository extends AbstractRepository implements ResetRepositoryInterface
{
    public function drop(): bool
    {
        return Database::getConnection()->reset();
    }
}