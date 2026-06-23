<?php

namespace Config\Storage;

use mysqli;

class Mysql
{
    /**
     * @var mysqli
     */
    public $db;

    public function __construct(
        string $host,
        string $port,
        string $name,
        string $user,
        string $pass,
    )
    {
        // Enable internal mysqli error reporting to throw exceptions (matches PDO behavior)
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $this->db = new mysqli($host, $user, $pass, $name, $port);

        return $this->db;
    }
}
