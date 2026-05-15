<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['ok' => false, 'message' => 'Unauthorized.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['ok' => false, 'message' => 'Invalid request method.']);
    exit;
}

$data    = json_decode(file_get_contents('php://input'), true);
$user_id = intval($data['user_id'] ?? 0);

if ($user_id <= 0) {
    echo json_encode(['ok' => false, 'message' => 'Invalid user ID.']);
    exit;
}

include "../models/sellerModel.php";

$model = new SellerModel();
$model->rejectRequest($user_id);

echo json_encode(['ok' => true]);