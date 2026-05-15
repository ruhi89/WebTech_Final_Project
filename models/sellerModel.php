<?php
require_once "db.php";

class SellerModel {

    private $conn;

    public function __construct() {
        $this->conn = get_db();
    }

    public function requestExists($user_id) {
        $sql    = "SELECT id FROM seller_requests WHERE user_id = '$user_id'";
        $result = $this->conn->query($sql);
        return $result->num_rows > 0;
    }

    public function isSeller($user_id) {
        $sql    = "SELECT seller_verified FROM users WHERE id = '$user_id'";
        $result = $this->conn->query($sql);
        if ($row = $result->fetch_assoc()) {
            return $row['seller_verified'] == 1;
        }
        return false;
    }

      public function createRequest($user_id, $motivation) {
        $motivation = $this->conn->real_escape_string($motivation);
        $sql        = "INSERT INTO seller_requests (user_id, motivation) VALUES ('$user_id', '$motivation')";
        return $this->conn->query($sql);
    }

     public function getPendingRequests() {
        $sql    = "SELECT sr.id, sr.user_id, sr.motivation, sr.requested_at, u.name, u.email
                   FROM seller_requests sr
                   JOIN users u ON u.id = sr.user_id
                   WHERE u.seller_verified = 0
                   ORDER BY sr.requested_at ASC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

     public function approveRequest($user_id) {
        $this->conn->query("UPDATE users SET seller_verified = 1 WHERE id = '$user_id'");
        $this->conn->query("DELETE FROM seller_requests WHERE user_id = '$user_id'");
        return true;
    }

    public function rejectRequest($user_id) {
        $sql = "DELETE FROM seller_requests WHERE user_id = '$user_id'";
        return $this->conn->query($sql);
    }
}