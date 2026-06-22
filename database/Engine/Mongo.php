<?php

namespace Database\Client;

use MongoDB\Client;
use MongoDB\Database;

/**
 * install the official MongoDB library via Composer first using $ composer require mongodb/mongodb
 */
class Mongo
{
    /**
     * @var Database
     */
    public Database $db;

    public function __construct()
    {
        $host = env('MONGO_HOST');
        $port = env('MONGO_PORT');
        $name = env('MONGO_NAME');
        $user = env('MONGO_USER');
        $pass = env('MONGO_PASS');

        // Construct the MongoDB Connection URI
        // Format: mongodb://user:pass@host:port
        $uri = "mongodb://{$user}:{$pass}@{$host}:{$port}";

        // 1. Connect to the MongoDB server
        $client = new Client($uri);

        // 2. Select and assign the specific database to $this->db
        $this->db = $client->selectDatabase($name);

        return $this->db;
    }
}
