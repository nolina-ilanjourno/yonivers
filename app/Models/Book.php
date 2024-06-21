<?php

namespace App\Models;

use App\Helpers\Database;
use PDO;

class Book {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getMembersWhoHaveBorrowedBooksPublishedBeforeTheYear200(): ?object {
        $stmt = $this->db->query("SELECT members.firstname from loans
            INNER JOIN books on books.id = loans.book_id
            INNER JOIN members on members.id = loans.member_id
            WHERE books.publication_year < 2000");
        return $stmt->fetch(PDO::FETCH_OBJ) ?: null;
    }
}
