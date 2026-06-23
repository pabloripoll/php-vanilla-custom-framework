<?php

namespace DB;

use Config\Storage\Redis;

class Memo
{
    public function __construct()
    {
        $host = env('REDIS_HOST');
        $port = env('REDIS_PORT');
        $user = env('REDIS_USER');
        $pass = env('REDIS_PASS');
        $index = env('REDIS_INDEX');

        return new Redis(
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
