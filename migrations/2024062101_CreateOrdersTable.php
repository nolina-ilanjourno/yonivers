<?php

class CreateOrdersTable {
    public function up(PDO $db): void {
        $db->exec("CREATE TABLE orders (
            id INT AUTO_INCREMENT PRIMARY KEY,
            `status` VARCHAR(100) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=INNODB;");
    }

    public function down(PDO $db): void {
        $db->exec("DROP TABLE orders;");
    }
}
