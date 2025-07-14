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

if (isset($_POST['add_to_cart'])) {
    $item_id = intval($_POST['item_id']);
    $conn->query("INSERT INTO cart (id, user_id) VALUES ($item_id, $user_id)");
    header("Location: cart.php");
    exit;
}

$items = $conn->query("SELECT * FROM items");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h2 class="mb-4">Products</h2>
    <div class="row">
        <?php while ($item = $items->fetch_assoc()): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($item['name']) ?></h5>
                    <p class="card-text"><strong>R<?= $item['price'] ?></strong></p>
                    <form method="post">
                        <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                        <button type="submit" name="add_to_cart" class="btn btn-success">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
    <a href="cart.php" class="btn btn-primary mt-3">Go to Cart</a>
    <a href="logout.php" class="btn btn-secondary mt-3">Logout</a>
</div>
</body>
</html>