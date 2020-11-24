<?php declare(strict_types = 1);

namespace Api\Repository;

use Api\Adapter\ResetRepositoryInterface;
use RedBeanPHP\R;

class ResetRepository extends BaseRepository implements ResetRepositoryInterface
{
    public function drop()
    {
        if(file_exists(self::DB_FILE)) {
            unlink(self::DB_FILE);
        }
        
        return true;
    }

    public function create()
    {
        $this->createAccountsTable();
    }
    
    protected function createAccountsTable()
    {
        $sql = "
        CREATE TABLE accounts (
            id INTEGER PRIMARY KEY,
            balance TEXT
        );
        ";
        
        R::exec($sql);
    }
}