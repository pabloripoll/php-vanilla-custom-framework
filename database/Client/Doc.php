<?php

namespace DB;

use Config\Storage\Mongo;

class Doc
{
    public function __construct()
    {
        $host = env('REDIS_HOST');
        $port = env('REDIS_PORT');
        $user = env('REDIS_USER');
        $pass = env('REDIS_PASS');
        $index = env('REDIS_INDEX');

        return new Mongo(
            $host,
            $port,
            $user,
            $pass,
            $index
        );
    }

    public static function conn()
    {
        return new self;
    }
}
