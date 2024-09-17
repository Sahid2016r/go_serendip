<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $new_password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare('UPDATE users SET password = ?, reset_token = NULL WHERE reset_token = ?');
    $stmt->execute([$new_password, $token]);

    echo "Password has been updated!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Set New Password</h1>
    <form method="post">
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>" required>
        <input type="password" name="password" placeholder="New Password" required>
        <button type="submit">Set Password</button>
    </form>
</body>
</html>
