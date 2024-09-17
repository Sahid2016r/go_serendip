<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $token = bin2hex(random_bytes(50));
        $stmt = $pdo->prepare('UPDATE users SET reset_token = ? WHERE email = ?');
        $stmt->execute([$token, $email]);

        // Here you would send the reset link via email. For simplicity, we'll just output it.
        echo "Password reset link: http://localhost/go-serendip/new_password.php?token=$token";
    } else {
        echo "No user found with that email address!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Reset Password</h1>
    <form method="post">
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
