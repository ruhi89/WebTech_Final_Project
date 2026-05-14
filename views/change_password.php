<?php
include "../controllers/changePasswordController.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password — BidBD</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

    <?php include "partials/nav.php"; ?>

    <div class="form-wrapper">
        <div class="form-box" style="max-width: 520px;">

            <h2>Change Password</h2>
            <p class="sub">Fill in the fields below to update your password.</p>
            <p class="sub"><a href="profile.php" style="text-decoration: underline;color: #1a3c5e;">Back to Profile</a></p>
            <?php if ($pass_success): ?>
                <div class="alert-success">Password changed successfully!</div>
            <?php endif; ?>

            <?php if (isset($pass_errors['general'])): ?>
                <div class="alert-error"><?= $pass_errors['general'] ?></div>
            <?php endif; ?>

            <form method="POST" action="change_password.php">

                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" id="current_password" name="current_password" placeholder="Enter current password">
                    <?php if (isset($pass_errors['current_password'])): ?>
                        <span class="error-msg"><?= $pass_errors['current_password'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" id="new_password" name="new_password" placeholder="Minimum 8 characters">
                    <?php if (isset($pass_errors['new_password'])): ?>
                        <span class="error-msg"><?= $pass_errors['new_password'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm New Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Repeat new password">
                    <?php if (isset($pass_errors['confirm_password'])): ?>
                        <span class="error-msg"><?= $pass_errors['confirm_password'] ?></span>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn-submit">Change Password</button>

            </form>

        </div>
    </div>

    <?php include "partials/footer.php"; ?>

</body>
</html>
