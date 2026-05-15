<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$role = $_SESSION['role'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BidBD — Online Auction</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

    <nav class="navbar">
        <div class="brand">BidBD</div>
        <div class="nav-links">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="views/profile.php" class="nav-user">Hello, <?= htmlspecialchars($_SESSION['name']) ?></a>
                <?php if ($role !== 'admin'): ?>
                <a href="#">Browse Auctions</a>
                <a href="views/become_seller.php">Become a Seller</a>
            <?php endif; ?>
                <a href="views/logout.php" class="btn-nav">Logout</a>
            <?php else: ?>
                <a href="views/login.php">Login</a>
                <a href="views/register.php" class="btn-nav">Register</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="hero">
        <h1>Buy & Sell at the Best Price</h1>
        <p>Bangladesh's simple online auction platform.<br>Bid on items, win deals, sell your stuff.</p>
        <div class="hero-btns">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="views/browse.php" class="btn-orange">Browse Auctions</a>
                <a href="views/become_seller.php" class="btn-white-outline">Become a Seller</a>
            <?php else: ?>
                <a href="views/register.php" class="btn-orange">Create Account</a>
                <a href="views/browse.php" class="btn-white-outline">See Auctions</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="steps-section">
        <h2>How It Works</h2>
        <div class="steps">
            <div class="step">
                <div class="step-num">1</div>
                <h3>Register</h3>
                <p>Create a free account. All users start as buyers.</p>
            </div>
            <div class="step">
                <div class="step-num">2</div>
                <h3>Browse & Bid</h3>
                <p>Find items you like and place your bid before time runs out.</p>
            </div>
            <div class="step">
                <div class="step-num">3</div>
                <h3>Win!</h3>
                <p>Highest bid wins. Contact the seller to collect your item.</p>
            </div>
        </div>
    </div>

    <div class="sell-section">
        <h2>Want to Sell?</h2>
        <p>Register first, then apply to become a verified seller. Our admin will approve your request. After approval you can list your items for auction.</p>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="views/become_seller.php" class="btn-navy">Apply to Sell</a>
        <?php else: ?>
            <a href="views/register.php" class="btn-navy">Register Now</a>
        <?php endif; ?>
    </div>

    <div class="footer">
        <p>© <?= date('Y') ?> BidBD — Web Technologies Project</p>
    </div>

</body>
</html>