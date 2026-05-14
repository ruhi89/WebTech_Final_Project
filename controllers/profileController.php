<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include "../models/usersModel.php";

$errors      = [];
$success     = false;
$pass_errors = [];
$pass_success = false;
$model       = new UserModel();
$user        = $model->findById($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $name  = $_POST['name'] ;
        $phone = $_POST['phone'] ;
        $bio   = $_POST['bio']  ;

        if ($name === '')  
            $errors['name']  = 'Name is required.';
        if ($phone === '') 
            $errors['phone'] = 'Phone is required.';

        if (empty($errors)) {
            if ($model->updateProfile($_SESSION['user_id'], $name, $phone, $bio)) {
                $_SESSION['name'] = $name;
                $success = true;
                $user = $model->findById($_SESSION['user_id']);
            } else {
                $errors['general'] = 'Something went wrong. Please try again.';
            }
        }
}
