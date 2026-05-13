<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

include "../models/usersModel.php";

$email = trim($_POST['email'] ?? '');

header('Content-Type: text/plain; charset=UTF-8');

if ($email === '') {
    echo 'Email is required.';
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Invalid email address.';
    exit;
}

$model = new UserModel();
if ($model->emailExists($email)) {
    echo 'This email is already registered.';
} else {
    echo 'Email is available.';
}
