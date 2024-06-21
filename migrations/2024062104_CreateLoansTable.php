<?php

class CreateLoansTable {
    public function up(PDO $db): void {
        $db->exec("CREATE TABLE loans (
            id INT AUTO_INCREMENT PRIMARY KEY,
            member_id INT NOT NULL,
            book_id INT NOT NULL,
            loan_date DATE NOT NULL,
            return_date DATE NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (member_id) REFERENCES members(id),
            FOREIGN KEY (book_id) REFERENCES books(id)
        ) ENGINE=INNODB;");
    }

    public function down(PDO $db): void {
        $db->exec("DROP TABLE loans;");
    }
}
