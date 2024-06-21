<?php

class CreateBooksTable {
    public function up(PDO $db): void {
        $db->exec("CREATE TABLE books (
            id INT AUTO_INCREMENT PRIMARY KEY,
            author VARCHAR(255) NOT NULL,
            title VARCHAR(255) NOT NULL,
            publication_year YEAR NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=INNODB;");
    }

    public function down(PDO $db): void {
        $db->exec("DROP TABLE books;");
    }
}
