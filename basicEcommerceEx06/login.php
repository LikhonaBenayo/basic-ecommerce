<?php
session_start();
include 'db.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $res = $conn->query("SELECT * FROM users WHERE username='$username' AND password='$password'");
    if ($res && $res->num_rows === 1) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - LifeChoices Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background-image: url('secondhand.jpg');
            background-size: cover;
            background-position: center;
        }
        .bg-blur {
            backdrop-filter: blur(5px);
            background: rgba(255,255,255,0.3);
            min-height: 100vh;
            width: 100vw;
            position: fixed;
            top: 0; left: 0;
            z-index: 0;
        }
        .login-container {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body>
    <div class="bg-blur"></div>
    <div class="container py-5 login-container">
        <h2 class="mb-4 text-center">Login</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="post" class="w-25 mx-auto">
            <div class="mb-3">
                <label class="form-label">Username:</label>
                <input class="form-control" type="text" name="username" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password:</label>
                <input class="form-control" type="password" name="password" required>
            </div>
            <button class="btn btn-primary" type="submit">Login</button>
        </form>
    </div>
</body>
</html>