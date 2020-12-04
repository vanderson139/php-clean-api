<?php declare(strict_types = 1);

namespace Api\Database\Connection;

use Core\Adapter\Database\ConnectionInterface;
use RedBeanPHP\R;

class RedBean implements ConnectionInterface
{
    const DB_FILE = '/tmp/dbfile.db';

    protected static $db;
    
    public function find(string $table, int $id)
    {
        return R::load($table, $id);
    }

    public function save(string $table, array $data = [])
    {
        $id = null;
        if (isset($data['id'])) {
            $id = $data['id'];
            unset($data['id']);
        }

        $entity = R::dispense($table);

        $this->fill($entity, $data);

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

    public function update(string $table, $entity, array $data = [])
    {
        $this->fill($entity, $data);
        return R::store($entity);
    }

    protected function fill($entity, $data)
    {
        foreach ($data as $key => $value) {
            $entity->{$key} = $value;
        }
        return $entity;
    }

    public function connect()
    {
        if (!self::$db) {
            self::$db = R::setup('sqlite:' . self::DB_FILE);
        }
        return $this;
    }
    
    public function reset()
    {
        if(file_exists(self::DB_FILE)) {
            unlink(self::DB_FILE);
        }
        return true;
    }
}
