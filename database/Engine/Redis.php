<?php

namespace Database\Client;

use Redis as PhpRedis;
use Exception;

class Redis
{
    /**
     * @var PhpRedis
     */
    public PhpRedis $db;

    public function __construct(
        string $host,
        string $port,
        string|null $pass,
        string $name, // Used as the DB index (0-15)
    )
    {
        try {
            $this->db = new PhpRedis();

            // 1. Establish connection
            $this->db->connect($host, (int)$port);

            // 2. Authenticate if a password is provided (FIXED LOGIC)
            if ($pass !== null && $pass !== '') {
                $this->db->auth($pass);
            }

            // 3. Select database index (FIXED EMPTY STRING/ZERO BUG)
            if ($name !== '') {
                $this->db->select((int)$name);
            }

        } catch (Exception $e) {
            throw new Exception("Redis Connection failed: " . $e->getMessage());
        }
    }
}

