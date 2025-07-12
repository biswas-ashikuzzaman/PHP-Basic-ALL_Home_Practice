<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <style>
        body {
            background: #152733;
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 100px;
        }
        a {
            color: #00c4ff;
        }
    </style>
</head>
<body>
    <h1>Welcome, <?= htmlspecialchars($user['name']) ?>!</h1>
    <p>Position: <?= htmlspecialchars($user['position']) ?></p>
    <p>Gender: <?= htmlspecialchars($user['gender']) ?></p>

    <a href="logout.php">Logout</a>
</body>
</html>
