<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — BidBD</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
 
    <nav class="navbar">
        <div class="brand">BidBD</div>
        <div class="nav-links">
            <a href="../index.php">Home</a>
            <a href="../views/login.php" class="btn-nav">Login</a>
        </div>
    </nav>
 
    <div class="form-wrapper">
        <div class="form-box">
 
            <h2>Create Account</h2>
            <p class="sub">Register for free. All accounts start as buyer.</p>
 
            <?php if (isset($errors['general'])): ?>
                <div class="alert-error"><?= $errors['general'] ?></div>
            <?php endif; ?>
 
            <form method="POST" action="../controllers/registerController.php">
 
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="e.g. Rahim Uddin"
                        value="<?= htmlspecialchars($old['name'] ?? '') ?>"
                    >
                    <?php if (isset($errors['name'])): ?>
                        <span class="error-msg"><?= $errors['name'] ?></span>
                    <?php endif; ?>
                </div>
 
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="e.g. rahim@gmail.com"
                        value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                    >
                    <?php if (isset($errors['email'])): ?>
                        <span class="error-msg"><?= $errors['email'] ?></span>
                    <?php endif; ?>
                </div>
 
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        placeholder="e.g. 01712345678"
                        value="<?= htmlspecialchars($old['phone'] ?? '') ?>"
                    >
                    <?php if (isset($errors['phone'])): ?>
                        <span class="error-msg"><?= $errors['phone'] ?></span>
                    <?php endif; ?>
                </div>
 
                <div class="form-group">
                    <label for="bio">Short Bio <span style="color:#999; font-weight:normal;">(optional)</span></label>
                    <textarea
                        id="bio"
                        name="bio"
                        placeholder="Tell us a little about yourself..."
                    ><?= htmlspecialchars($old['bio'] ?? '') ?></textarea>
                </div>
 
                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Minimum 8 characters"
                    >
                    <?php if (isset($errors['password'])): ?>
                        <span class="error-msg"><?= $errors['password'] ?></span>
                    <?php endif; ?>
                </div>
 
                <div class="form-group">
                    <label for="confirm">Confirm Password</label>
                    <input
                        type="password"
                        id="confirm"
                        name="confirm"
                        placeholder="Repeat your password"
                    >
                    <?php if (isset($errors['confirm'])): ?>
                        <span class="error-msg"><?= $errors['confirm'] ?></span>
                    <?php endif; ?>
                </div>
 
                <button type="submit" class="btn-submit">Create Account</button>
 
            </form>
 
            <p class="form-footer-link">
                Already have an account? <a href="../views/login.php">Login here</a>
            </p>
 
        </div>
    </div>
 
    <div class="footer">
        <p>© <?= date('Y') ?> BidBD — Web Technologies Project</p>
    </div>
 
</body>
</html>