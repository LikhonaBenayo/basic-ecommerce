<?php
session_start();
include 'db.php';

// Redirect to login if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['username'];

// Get user's user_id
$userRes = $conn->query("SELECT user_id FROM users WHERE username='$user'");
$userRow = $userRes->fetch_assoc();
$user_id = $userRow['user_id'];


if (isset($_GET['remove'])) {
    $cart_id = intval($_GET['remove']);
    $conn->query("DELETE FROM cart WHERE cart_id=$cart_id AND user_id=$user_id");
    header("Location: cart.php");
    exit;
}

$cart = $conn->query("SELECT cart.cart_id, items.name, items.price
    FROM cart
    JOIN items ON cart.id = items.id
    WHERE cart.user_id = $user_id");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h2 class="mb-4">Your Cart</h2>
    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Remove</th>
        </tr>
        <?php while ($row = $cart->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td>R<?= $row['price'] ?></td>
            <td>
                <a href="?remove=<?= $row['cart_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Remove this item?')">Remove</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="products.php" class="btn btn-secondary">Back to Products</a>
    <a href="logout.php" class="btn btn-secondary">Logout</a>
</div>
</body>
</html>