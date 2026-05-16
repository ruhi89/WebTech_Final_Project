<?php
include "../models/usersModel.php";

$email = $_POST['email'] ?? '';

if (!$email) {
    echo "Email is required.";
} else {
    $model = new UserModel();
    if ($model->emailExists($email)) {
        echo "Email already taken.";
    } else {
        echo "Email available.";
    }
}
