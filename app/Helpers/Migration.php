<?php

namespace App\Helpers;

use PDO;
use Exception;

class Migration {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function migrate(): void {
        $this->createMigrationsTable();

        $executedMigrations = $this->getExecutedMigrations();
        $migrationFiles = $this->getMigrationFiles();

        $newMigrations = array_diff($migrationFiles, $executedMigrations);

        foreach ($newMigrations as $migration) {
            $this->runMigration($migration);
        }

        if (empty($newMigrations)) {
            echo "All migrations are up to date.\n";
        }
    }

    private function createMigrationsTable(): void {
        $this->db->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;");
    }

    /**
     * @return array<string>
     */
    private function getExecutedMigrations(): array {
        $stmt = $this->db->query("SELECT migration FROM migrations");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * @return array<string>
     */
    private function getMigrationFiles(): array {
        $files = array_diff(scandir(__DIR__ . '/../../migrations'), ['.', '..']);
        return array_values(array_filter($files, fn($file) => pathinfo($file, PATHINFO_EXTENSION) === 'php'));
    }

    private function getClassNameFromFileName(string $fileName): string {
        return preg_replace('/^[0-9]+_/', '', pathinfo($fileName, PATHINFO_FILENAME));
    }

    private function runMigration(string $migration): void {
        require_once __DIR__ . "/../../migrations/$migration";
        $className = $this->getClassNameFromFileName($migration);
        echo "Migrating: $className\n";
        if (!class_exists($className)) {
            throw new Exception("Migration class $className not found in $migration.");
        }

        $migrationInstance = new $className();

        if (!method_exists($migrationInstance, 'up')) {
            throw new Exception("Method 'up' not found in migration class $className.");
        }

        /** @var callable $upMethod */
        $upMethod = [$migrationInstance, 'up'];

        if (!is_callable($upMethod)) {
            throw new Exception("Method 'up' is not callable in migration class $className.");
        }

        call_user_func($upMethod, $this->db);

        $this->logMigration($migration);
        echo "Migrated: $migration\n";
    }

    private function logMigration(string $migration): void {
        $stmt = $this->db->prepare("INSERT INTO migrations (migration) VALUES (:migration)");
        $stmt->execute(['migration' => $migration]);
    }
}
