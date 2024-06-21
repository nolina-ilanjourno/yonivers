<?php

class CreateMembersTable {
    public function up(PDO $db): void {
        $db->exec("CREATE TABLE members (
            id INT AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=INNODB;");
    }

    public function down(PDO $db): void {
        $db->exec("DROP TABLE members;");
    }
}
