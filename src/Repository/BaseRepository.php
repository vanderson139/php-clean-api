<?php declare(strict_types = 1);

namespace Api\Repository;

use Api\Adapter\RepositoryInterface;
use RedBeanPHP\R;

class BaseRepository implements RepositoryInterface
{
    public function __construct()
    {
        R::setup('sqlite:/tmp/dbfile.db');
    }
    
    public function find($table, $id)
    {
        return R::load($table, $id);
    }
}