<?php

namespace Config\Storage;

use Exception;

class Redis
{
    /**
     * @var object
     */
    public object $db;

    public function __construct(
        string $host,
        string $port,
        string $user,
        string $pass,
        string $index, // Used as the DB index (0-15)
    )
    {
        /**
         * @disregard P1009 Undefined type
         */
        $this->db = new \Redis;

        $this->db->connect($host, (int)$port);

        if ($user !== null && $user !== '' && $pass !== null && $pass !== '') {
            $this->db->auth([$user, $pass]);
        }

        // Select database index (FIXED EMPTY STRING/ZERO BUG)
        if ($index !== null && $index !== '') {
            $this->db->select((int)$index);
        }
    }
}
