<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: ../views/login.php');
    exit;
}

if ($_SESSION['role'] === 'admin') {
    header('Location: ../views/seller_requests.php');
    exit;
}

require_once "../models/sellerModel.php";

$error   = '';
$success = false;
$model   = new SellerModel();

$already_requested = $model->requestExists($_SESSION['user_id']);
$already_seller    = $model->isSeller($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $motivation = trim($_POST['motivation'] ?? '');

    if ($already_seller) {
        $error = 'You are already a verified seller.';
    } elseif ($already_requested) {
        $error = 'You already submitted a request. Please wait for admin approval.';
    } elseif ($motivation === '') {
        $error = 'Please write a short motivation.';
    } elseif (strlen($motivation) < 10) {
        $error = 'Motivation must be at least 10 characters.';
    } else {
        if ($model->createRequest($_SESSION['user_id'], $motivation)) {
            $success           = true;
            $already_requested = true;
        } else {
            $error = 'Something went wrong. Please try again.';
        }
    }
}

