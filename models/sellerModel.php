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

      public function createRequest($user_id, $motivation) {
        $motivation = $this->conn->real_escape_string($motivation);
        $sql        = "INSERT INTO seller_requests (user_id, motivation) VALUES ('$user_id', '$motivation')";
        return $this->conn->query($sql);
    }
}