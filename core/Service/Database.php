<?php declare(strict_types = 1);

namespace Core\Service;

use Core\Adapter\Database\ConnectionInterface;

class Database
{
    protected static $connection;
    
    public static function connect(ConnectionInterface $connection)
    {
        return self::$connection = $connection->connect();
    }

    public static function getConnection(): ConnectionInterface
    {
        if(!self::$connection) die("Database not connected!");
        return self::$connection;
    }
}