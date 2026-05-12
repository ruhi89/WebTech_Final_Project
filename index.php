<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BidBD — Online Auction</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="brand">BidBD</div>
        <div class="nav-links">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span class="nav-user">Hello, <?= htmlspecialchars($_SESSION['name']) ?></span>
                <a href="browse.php">Browse</a>
                <a href="logout.php" class="btn-nav">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php" class="btn-nav">Register</a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- HERO -->
    <div class="hero">
        <h1>Buy & Sell at the Best Price</h1>
        <p>Bangladesh's simple online auction platform.<br>Bid on items, win deals, sell your stuff.</p>
        <div class="hero-btns">
            <a href="register.php" class="btn-orange">Create Account</a>
            <a href="browse.php" class="btn-white-outline">See Auctions</a>
        </div>
    </div>

    <!-- HOW IT WORKS -->
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

    <!-- SELL SECTION -->
    <div class="sell-section">
        <h2>Want to Sell?</h2>
        <p>Register first, then apply to become a verified seller. Our admin will approve your request. After approval you can list your items for auction.</p>
        <a href="register.php" class="btn-navy">Register Now</a>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <p>© <?= date('Y') ?> BidBD — Web Technologies Project</p>
    </div>

</body>
</html>