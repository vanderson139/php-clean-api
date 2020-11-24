<?php declare(strict_types=1);

namespace Api\Repository;

use Api\Adapter\RepositoryInterface;
use RedBeanPHP\R;

class BaseRepository implements RepositoryInterface
{
    const DB_FILE = '/tmp/dbfile.db';
    
    public function __construct()
    {
        R::setup('sqlite:'. self::DB_FILE);
    }

    public function find($table, $id)
    {
        return R::load($table, $id);
    }

    public function save($table, $data)
    {
        $entity = R::dispense($table);

        foreach ($data as $key => $value) {
            $entity->{$key} = $value;
        }
        
        return R::store($entity);
    }
}