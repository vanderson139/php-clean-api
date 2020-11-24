<?php declare(strict_types=1);

namespace Api\Repository;

use Api\Adapter\RepositoryInterface;
use RedBeanPHP\R;

class BaseRepository implements RepositoryInterface
{
    const DB_FILE = '/tmp/dbfile.db';

    protected static $db;

    public function __construct()
    {
        $this->connect();
    }

    public function find($table, $id)
    {
        return R::load($table, $id);
    }

    public function save($table, $data)
    {
        $id = null;
        if (isset($data['id'])) {
            $id = $data['id'];
            unset($data['id']);
        }

        $entity = R::dispense($table);

        foreach ($data as $key => $value) {
            $entity->{$key} = $value;
        }

        $storeId = R::store($entity);

        // store method does not allow to set id
        if (!empty($id) && $id != $storeId) {
            R::exec("UPDATE {$table} SET id = :dataId WHERE id = :storeId", [
                ':storeId' => $storeId,
                ':dataId' => $id
            ]);

            $storeId = $id;
        }

        return $storeId;
    }

    public function update($entity, $data)
    {
        foreach ($data as $key => $value) {
            $entity->{$key} = $value;
        }
        return R::store($entity);
    }

    protected function connect()
    {
        if (self::$db) return;
        self::$db = R::setup('sqlite:' . self::DB_FILE);
    }
}