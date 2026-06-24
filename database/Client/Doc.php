<?php

namespace DB;

use Config\Storage\Mongo;
use MongoDB\Database;

class Doc
{
    /**
     * Holds the unique engine connection instance for this specific Doc context
     * @var Mongo
     */
    public Mongo $engine;

    public function __construct()
    {
        $host = env('MONGO_HOST');
        $port = env('MONGO_PORT');
        $user = env('MONGO_USER');
        $pass = env('MONGO_PASS');
        $name = env('MONGO_NAME');

        // Capture the distinct connection instance into this object's state
        $this->engine = new Mongo(
            $host,
            $port,
            $user,
            $pass,
            $name
        );
    }

    /**
     * Shortcut factory to instantiate the class and return its engine's database object
     *
     * @return Database
     */
    public static function conn(): Database
    {
        $instance = new self();
        return $instance->engine->db;
    }
}

