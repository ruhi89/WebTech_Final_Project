<?php include "../controllers/adminController.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Requests — Admin</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <?php include "partials/nav.php"; ?>

    <div class="page-wrapper">
        <h2>Pending Seller Requests</h2>

        <?php if (empty($requests)): ?>
            <p style="color:#666;">No pending requests at the moment.</p>
        <?php else: ?>

        <div class="table-box">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Motivation</th>
                        <th>Requested At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="requests-table">
                    <?php foreach ($requests as $i => $req): ?>
                    <tr id="row-<?= $req['user_id'] ?>">
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($req['name']) ?></td>
                        <td><?= htmlspecialchars($req['email']) ?></td>
                        <td><?= htmlspecialchars($req['motivation']) ?></td>
                        <td><?= date('d M Y, h:i A', strtotime($req['requested_at'])) ?></td>
                        <td>
                            <button class="btn-approve"
                                onclick="handleRequest(<?= $req['user_id'] ?>, 'approve')">
                                Approve
                            </button>
                            <button class="btn-reject"
                                onclick="handleRequest(<?= $req['user_id'] ?>, 'reject')">
                                Reject
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php endif; ?>
    </div>

    <?php include "partials/footer.php"; ?>

    <script>
    function handleRequest(user_id, action) {
        var url = action === 'approve'
            ? '../controllers/approve.php'
            : '../controllers/reject.php';

        var xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onreadystatechange = function () {
            if (xhr.readyState !== 4) return;

            var data = JSON.parse(xhr.responseText);

            if (data.ok) {
                var row = document.getElementById('row-' + user_id);
                if (action === 'approve') {
                    row.querySelector('td:last-child').innerHTML = '<span class="badge badge-approved">Approved ✓</span>';
                } else {
                    row.remove();
                }
            } else {
                alert(data.message || 'Request failed.');
            }
        };

        xhr.send(JSON.stringify({ user_id: user_id }));
    }
    </script>

</body>
</html>