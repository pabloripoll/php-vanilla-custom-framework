<?php

namespace DB;

use Config\Storage\Mysql;

/**
 * Class name is customizable
 */
class Secondary
{
    protected object $db;

    public function __construct()
    {
        $host = env('MYSQL_HOST');
        $port = env('MYSQL_PORT');
        $name = env('MYSQL_NAME');
        $user = env('MYSQL_USER');
        $pass = env('MYSQL_PASS');

        return new Mysql(
            $host,
            $port,
            $name,
            $user,
            $pass,
        );
    }

    public static function conn()
    {
        return new self;
    }
}
