<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="navbar">
        <a href="../index.php"><div class="brand">BidBD</div></a>
        <div class="nav-links">
            <a href="profile.php" class="nav-user">Hello, <?= htmlspecialchars($_SESSION['name']) ?></a>
            <a href="#">Browse Auctions</a>
            <a href="become_seller.php">Become a Seller</a>
            <a href="logout.php" class="btn-nav">Logout</a>
        </div>
    </nav>