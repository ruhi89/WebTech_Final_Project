<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include "../models/usersModel.php";

$pass_errors = [];
$pass_success = false;
$model = new UserModel();
$user = $model->findById($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_POST['current_password'] ;
    $new     = $_POST['new_password'] ;
    $confirm = $_POST['confirm_password'] ;

    if ($current === '') {
        $pass_errors['current_password'] = 'Current password is required.';
    }
    if (strlen($new) < 8) {
        $pass_errors['new_password'] = 'New password must be at least 8 characters.';
    }
    if ($new !== $confirm) {
        $pass_errors['confirm_password'] = 'Passwords do not match.';
    }

    if (empty($pass_errors)) {
        if (!password_verify($current, $user['password_hash'])) {
            $pass_errors['current_password'] = 'Current password is incorrect.';
        }
    }

    if (empty($pass_errors)) {
        $new_hash = password_hash($new, PASSWORD_BCRYPT);
        if ($model->updatePassword($_SESSION['user_id'], $new_hash)) {
            $pass_success = true;
            $user = $model->findById($_SESSION['user_id']);
        } else {
            $pass_errors['general'] = 'Something went wrong. Please try again.';
        }
    }
}
