<?php

namespace Database\Client;

use Database\Engine\Postgre;

class PrimaryDB
{
    public function __construct()
    {
        $host = env('PGSQL_HOST');
        $port = env('PGSQL_PORT');
        $name = env('PGSQL_NAME');
        $user = env('PGSQL_USER');
        $pass = env('PGSQL_PASS');

        return new Postgre(
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
