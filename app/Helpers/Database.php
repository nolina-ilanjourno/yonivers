<?php

namespace App\Helpers;

use PDO;
use PDOException;

class Database {
    private static ?PDO $connection = null;

    public static function getConnection(): ?PDO {
        if (self::$connection === null) {
            try {
                $host = $_ENV['DB_HOST'] ?? 'localhost';
                $dbname = $_ENV['DB_NAME'] ?? 'yonivers';
                $user = $_ENV['DB_USER '] ?? 'root';
                $password = $_ENV['DB_PASSWORD'] ?? 'root';
                $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

                self::$connection = new PDO($dsn, $user, $password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return self::$connection;
    }
}
