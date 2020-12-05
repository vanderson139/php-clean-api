<?php declare(strict_types = 1);

namespace Api\Database\Connection;

use Core\Adapter\Database\ConnectionInterface;
use Core\Adapter\Database\EntityInterface;
use RedBeanPHP\OODBBean;
use RedBeanPHP\R;

class RedBean implements ConnectionInterface
{
    const DB_FILE = '/tmp/dbfile.db';
    
    protected $injector;
    
    public function __construct(\Auryn\Injector $injector)
    {
        $this->injector = $injector;
    }

    public function find(string $table, int $id): ?EntityInterface
    {
        /** @var OODBBean $redBean */
        $redBean = R::load($table, $id);
        return $redBean->id ? $this->getModel($table, $redBean->getProperties()) : null;
    }

    public function save(string $table, array $data = []): ?int
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

        return (int)$storeId;
    }

    public function update(string $table, EntityInterface $entity, array $data = []): ?int
    {
        $redBean = R::dispense($table);
        $this->fill($redBean, array_merge($entity->toArray(), $data));
        return R::store($redBean);
    }

    protected function fill(OODBBean $entity, array $data = []): OODBBean
    {
        foreach ($data as $key => $value) {
            $entity->{$key} = $value;
        }
        return $entity;
    }

    public function connect(): ConnectionInterface
    {
        R::setup('sqlite:' . self::DB_FILE);
        return $this;
    }
    
    public function reset(): bool
    {
        if(file_exists(self::DB_FILE)) {
            unlink(self::DB_FILE);
        }
        return true;
    }
    
    protected function getModel(string $table, array $data): EntityInterface
    {
        return $this->injector->make($this->getModelName($table))->fill($data);
    }
    
    protected function getModelName(string $table)
    {
        $modelName = ucfirst($this->toSingular($table));
        
        return 'Api\Database\\'. $modelName .'Model'; 
    }
    
    protected function toSingular(string $string)
    {
        return rtrim(strtolower($string), 's');
    }
}
