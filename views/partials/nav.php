<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$role = $_SESSION['role'] ?? null;
?>
<nav class="navbar">
        <?php if ($role === 'admin'): ?>
                    <a href="../views/seller_requests.php"><div class="brand">BidBD</div></a>

        <?php endif; ?>
        <?php if ($role !== 'admin'): ?>
                    <a href="../index.php"><div class="brand">BidBD</div></a>
        <?php endif; ?>
        <div class="nav-links">
            <a href="profile.php" class="nav-user">Hello, <?= htmlspecialchars($_SESSION['name'] ?? '') ?></a>
            <?php if ($role !== 'admin'): ?>
                <a href="#">Browse Auctions</a>
                <a href="become_seller.php">Become a Seller</a>
            <?php endif; ?>
            <a href="logout.php" class="btn-nav">Logout</a>
        </div>
    </nav>