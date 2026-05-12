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

    $name     = trim($_POST['name']     ?? '');
    $email    = trim($_POST['email']    ?? '');
    $phone    = trim($_POST['phone']    ?? '');
    $bio      = trim($_POST['bio']      ?? '');
    $password = $_POST['password']      ?? '';
    $confirm  = $_POST['confirm']       ?? '';

    $old = compact('name', 'email', 'phone', 'bio');

    if ($name === '')                                   $errors['name']     = 'Name is required.';
    if ($email === '')                                  $errors['email']    = 'Email is required.';
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email']    = 'Invalid email address.';
    if ($phone === '')                                  $errors['phone']    = 'Phone is required.';
    if (strlen($password) < 8)                         $errors['password'] = 'Password must be at least 8 characters.';
    if ($password !== $confirm)                        $errors['confirm']  = 'Passwords do not match.';

    if (!isset($errors['email'])) {
        $model = new UserModel();
        if ($model->emailExists($email)) {
            $errors['email'] = 'This email is already registered.';
        }
    }

    if (empty($errors)) {
        $model = new UserModel();
        $hash  = password_hash($password, PASSWORD_BCRYPT);
        if ($model->createUser($name, $email, $phone, $bio, $hash)) {
            header('Location: ../index.php?registered=1');
            exit;
        } else {
            $errors['general'] = 'Something went wrong. Please try again.';
        }
    }
}

include "../views/register.php";