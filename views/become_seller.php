<?php include "../controllers/SellerController.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Become a Seller — BidBD</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

    <?php include "partials/nav.php"; ?>

    <div class="form-wrapper">
        <div class="form-box" style="max-width: 520px;">

            <h2>Become a Seller</h2>
            <p class="sub">Apply to list your items for auction. Admin will review your request.</p>

            <?php if ($already_seller): ?>

                <!-- Already a verified seller -->
                <div class="alert-success">
                    ✅ You are already a verified seller! Go to your
                    <a href="dashboard.php">Seller Dashboard</a> to list items.
                </div>

            <?php elseif ($success || $already_requested): ?>

                <!-- Request submitted -->
                <div class="alert-success">
                    ⏳ Your request has been submitted! Please wait for admin approval.
                    You will be able to list items once approved.
                </div>

            <?php else: ?>

                <!-- Show form -->
                <?php if ($error): ?>
                    <div class="alert-error"><?= $error ?></div>
                <?php endif; ?>

                <form method="POST" action="become_seller.php">

                    <div class="form-group">
                        <label for="motivation">Why do you want to become a seller?</label>
                        <textarea
                            id="motivation"
                            name="motivation"
                            placeholder="e.g. I want to sell handmade crafts from my hometown in Bangladesh..."
                            style="min-height: 120px;"
                        ><?= htmlspecialchars($_POST['motivation'] ?? '') ?></textarea>
                    </div>

                    <button type="submit" class="btn-submit">Submit Request</button>

                </form>

            <?php endif; ?>

        </div>
    </div>

    <?php include "partials/footer.php"; ?>

</body>
</html>