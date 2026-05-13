<?php
include "../models/db.php";

class UserModel {

    private $conn;

    public function __construct() {
        $this->conn = get_db();
    }

    public function emailExists($email) {
        $email  = $this->conn->real_escape_string($email);
        $sql    = "SELECT id FROM users WHERE email = '$email'";
        $result = $this->conn->query($sql);
        return $result->num_rows > 0;
    }

    public function createUser($name, $email, $phone, $bio, $hash) {
        $name  = $this->conn->real_escape_string($name);
        $email = $this->conn->real_escape_string($email);
        $phone = $this->conn->real_escape_string($phone);
        $bio   = $this->conn->real_escape_string($bio);
        $sql   = "INSERT INTO users (name, email, phone, bio, password_hash, role, seller_verified)
                  VALUES ('$name', '$email', '$phone', '$bio', '$hash', 'buyer', 0)";
        return $this->conn->query($sql);
    }

    public function findByEmail($email) {
        $email  = $this->conn->real_escape_string($email);
        $sql    = "SELECT * FROM users WHERE email = '$email'";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    public function findById($id) {
        $id     = $this->conn->real_escape_string($id);
        $sql    = "SELECT * FROM users WHERE id = '$id'";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    public function updateProfile($id, $name, $phone, $bio) {
        $name  = $this->conn->real_escape_string($name);
        $phone = $this->conn->real_escape_string($phone);
        $bio   = $this->conn->real_escape_string($bio);
        $sql   = "UPDATE users SET name='$name', phone='$phone', bio='$bio' WHERE id='$id'";
        return $this->conn->query($sql);
    }

    public function updatePassword($id, $new_hash) {
        $sql = "UPDATE users SET password_hash='$new_hash' WHERE id='$id'";
        return $this->conn->query($sql);
    }
}