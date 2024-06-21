<?php

namespace App\Models;

use App\Helpers\Database;
use PDO;

class Message {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getLastMessage(): ?object {
        $stmt = $this->db->query("SELECT email, `message` FROM messages ORDER BY id DESC LIMIT 1");
        return $stmt->fetch(PDO::FETCH_OBJ) ?: null;
    }


    public function createMessage(array $data): bool {
        $stmt = $this->db->prepare("INSERT INTO messages (email, `message`) VALUES (:email, :message)");
        return $stmt->execute($data);
    }
}
