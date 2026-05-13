<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

include "../models/usersModel.php";

$errors = [];
$old    = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email    = trim($_POST['email']    ?? '');
    $password = $_POST['password']      ?? '';

    $old = ['email' => $email];

    // Validate
    if ($email === '')    $errors['email']    = 'Email is required.';
    if ($password === '') $errors['password'] = 'Password is required.';

    // Check user exists and password matches
    if (empty($errors)) {
        $model = new UserModel();
        $user = $model->findByEmail($email);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            $errors['general'] = 'Incorrect email or password.';
        }
    }

    // Login success — set session and redirect
    if (empty($errors)) {
        $_SESSION['user_id']         = $user['id'];
        $_SESSION['name']            = $user['name'];
        $_SESSION['role']            = $user['role'];
        $_SESSION['seller_verified'] = $user['seller_verified'];

        if ($user['role'] === 'admin') {
            header('Location: ../views/admin/seller_requests.php');
        } else {
            header('Location: ../index.php');
        }
        exit;
    }
}

include "../views/login.php";