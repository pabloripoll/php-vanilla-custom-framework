<?php

namespace Database\Client;

use PDO;
use Exception;

/**
 * This class requires Microsoft ODBC Driver for SQL Server and enable extension in your php.ini
 * extension=php_pdo_sqlsrv.dll (Windows)
 * extension=pdo_sqlsrv.so (Linux/macOS)
 */
class Mssql
{
    /**
     * @var PDO
     */
    public PDO $db;

    public function __construct()
    {
        $host = env('MSSQL_HOST');
        $port = env('MSSQL_PORT');
        $name = env('MSSQL_NAME');
        $user = env('MSSQL_USER');
        $pass = env('MSSQL_PASS');

        // Note: MS SQL uses a comma (,) for ports instead of a colon (:)
        $dsn = "sqlsrv:Server={$host},{$port};Database={$name}";

        try {
            $this->db = new PDO($dsn, $user, $pass);

            // Enable exceptions for error handling
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Optional: Prevents MS SQL from converting numeric columns to strings
            $this->db->setAttribute(PDO::SQLSRV_ATTR_FETCHES_NUMERIC_TYPE, true);

        } catch (Exception $e) {
            throw new Exception("MS SQL Connection failed: " . $e->getMessage());
        }
    }
}
