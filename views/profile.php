<?php
include "../controllers/profileController.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile — BidBD</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

    <nav class="navbar">
        <a href="../index.php"><div class="brand">BidBD</div></a>
        <div class="nav-links">
            <span class="nav-user">Hello, <?= htmlspecialchars($_SESSION['name']) ?></span>
            <a href="browse.php">Browse Auctions</a>
            <a href="become_seller.php">Become a Seller</a>
            <a href="logout.php" class="btn-nav">Logout</a>
        </div>
    </nav>

    <div class="form-wrapper">
        <div class="form-box" style="max-width: 520px;">

            <h2>My Profile</h2>
            <p class="sub">Update your personal information below.</p>
            <p class="sub"><a href="change_password.php" style="text-decoration: underline;color: #1a3c5e;">Change password</a></p>

            <div style="background:#f0f5fb; border:1px solid #d4e3f5; border-radius:8px; padding:14px 16px; margin-bottom:24px; font-size:14px;">
                <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                <p style="margin-top:6px;"><strong>Role:</strong>
                    <?php if ($user['role'] === 'admin'): ?>
                        <span class="badge badge-active">Admin</span>
                    <?php elseif ($user['seller_verified'] == 1): ?>
                        <span class="badge badge-approved">Verified Seller</span>
                    <?php else: ?>
                        <span class="badge badge-pending">Buyer</span>
                    <?php endif; ?>
                </p>
                <p style="margin-top:6px;"><strong>Member since:</strong> <?= date('d M Y', strtotime($user['created_at'])) ?></p>
            </div>

            <?php if ($success): ?>
                <div class="alert-success">Profile updated successfully!</div>
            <?php endif; ?>

            <?php if (isset($errors['general'])): ?>
                <div class="alert-error"><?= $errors['general'] ?></div>
            <?php endif; ?>

            <form method="POST" action="profile.php">

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name"
                        value="<?= htmlspecialchars($user['name']) ?>">
                    <?php if (isset($errors['name'])): ?>
                        <span class="error-msg"><?= $errors['name'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone"
                        value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
                    <?php if (isset($errors['phone'])): ?>
                        <span class="error-msg"><?= $errors['phone'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="bio">Bio <span style="color:#999; font-weight:normal;">(optional)</span></label>
                    <textarea id="bio" name="bio"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
                </div>

                <button type="submit" class="btn-submit">Save Changes</button>

            </form>

        </div>
    </div>

    <div class="footer">
        <p>© <?= date('Y') ?> BidBD — Web Technologies Project</p>
    </div>

</body>
</html>