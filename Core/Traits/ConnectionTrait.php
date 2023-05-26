<?php

namespace Core\Traits;

use Config\Config;
use PDO;

trait ConnectionTrait
{
    protected static PDO|null $connect = null;

    protected static function connect()
    {
        if (is_null(static::$connect)){
            $dsn = 'mysql:host=' . Config::get('db.host') . ';dbname=' . Config::get('db.database');
            $options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
            self::$connect = new \PDO(
                $dsn,
                Config::get('db.user'),
                Config::get('db.password'),
                $options
            );

            self::$connect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return self::$connect;
    }
}