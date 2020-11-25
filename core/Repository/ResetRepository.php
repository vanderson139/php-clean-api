<?php declare(strict_types = 1);

namespace Core\Repository;

use Core\Adapter\ResetRepositoryInterface;

class ResetRepository extends AbstractRepository implements ResetRepositoryInterface
{
    public function drop()
    {
        if(file_exists(self::DB_FILE)) {
            unlink(self::DB_FILE);
        }
        
        return true;
    }
}