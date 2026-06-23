<?php

namespace Database\Client;

use PDO;
use Exception;

class Oracle
{
    /**
     * @var PDO
     */
    public PDO $db;

    public function __construct()
    {
        $host = env('ORACLE_HOST');
        $port = env('ORACLE_PORT');
        $service = env('ORACLE_SERVICE_NAME'); // Oracle relies on Service Names / SIDs
        $user = env('ORACLE_USER');
        $pass = env('ORACLE_PASS');

        // Construct the Oracle Easy Connect string (e.g., oci:dbname=//localhost:1521/XEPDB1)
        $dsn = "oci:dbname=//{$host}:{$port}/{$service}";

        try {
            $this->db = new PDO($dsn, $user, $pass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            throw new Exception("Oracle PDO Connection failed: " . $e->getMessage());
        }
    }
}
