<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — BidBD</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="brand">BidBD</div>
        <div class="nav-links">
            <a href="../index.php">Home</a>
            <a href="register.php" class="btn-nav">Register</a>
        </div>
    </nav>

    <!-- FORM -->
    <div class="form-wrapper">
        <div class="form-box">

            <h2>Login</h2>
            <p class="sub">Welcome back! Enter your details below.</p>

            <?php if (isset($_GET['registered'])): ?>
                <div class="alert-success">Account created! You can now log in.</div>
            <?php endif; ?>

            <?php if (isset($errors['general'])): ?>
                <div class="alert-error"><?= $errors['general'] ?></div>
            <?php endif; ?>

            <form method="POST" action="../controllers/loginController.php">

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email"
                        placeholder="e.g. rahim@gmail.com"
                        value="<?= htmlspecialchars($old['email'] ?? '') ?>">
                    <?php if (isset($errors['email'])): ?>
                        <span class="error-msg"><?= $errors['email'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                        placeholder="Enter your password">
                    <?php if (isset($errors['password'])): ?>
                        <span class="error-msg"><?= $errors['password'] ?></span>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn-submit">Login</button>

            </form>

            <p class="form-footer-link">
                Don't have an account? <a href="register.php">Register here</a>
            </p>

        </div>
    </div>

    <div class="footer">
        <p>© <?= date('Y') ?> BidBD — Web Technologies Project</p>
    </div>

</body>
</html>