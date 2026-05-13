<?php
include "db.php";

class UserModel {

    private mysqli $conn;

    public function __construct() {
        $this->conn = get_db();
    }

    public function emailExists(string $email): bool {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $found = $stmt->num_rows > 0;
        $stmt->close();
        return $found;
    }

    public function createUser(string $name, string $email, string $phone, string $bio, string $hash): bool {
        $stmt = $this->conn->prepare(
            "INSERT INTO users (name, email, phone, bio, password_hash, role, seller_verified)
             VALUES (?, ?, ?, ?, ?, 'buyer', 0)"
        );
        $stmt->bind_param("sssss", $name, $email, $phone, $bio, $hash);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function findByEmail(string $email): ?array {
        $stmt = $this->conn->prepare("SELECT id, name, email, phone, bio, password_hash, role, seller_verified FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        return $user ?: null;
    }

}