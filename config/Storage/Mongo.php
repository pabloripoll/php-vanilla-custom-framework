<?php

namespace Config\Storage;

use MongoDB\Client;
use MongoDB\Database;

/**
 * install the official MongoDB library via Composer first using
 * $ composer require mongodb/mongodb
 * $ composer require mongodb/mongodb --ignore-platform-reqs
 */
class Mongo
{
    /**
     * @var Database
     */
    public Database $db; // Strict type definition clears Intelephense completely

    public function __construct(
        string $host,
        string $port,
        string $user,
        string $pass,
        string $name
    ) {
        $uri = "mongodb://{$user}:{$pass}@{$host}:{$port}";

        $client = new Client($uri);

        // Explicitly map the database selection to the instance property
        $this->db = $client->selectDatabase($name);
    }
}
