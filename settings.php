<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $theme = $_POST['theme'];
    $language = $_POST['language'];
    $privacy = $_POST['privacy'];

    $stmt = $pdo->prepare('UPDATE users SET theme = ?, language = ?, privacy = ? WHERE id = ?');
    $stmt->execute([$theme, $language, $privacy, $user_id]);

    echo "Settings updated successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Settings</h1>
    <form method="post">
        <input type="number" name="user_id" placeholder="User ID" required>
        <select name="theme" required>
            <option value="light">Light</option>
            <option value="dark">Dark</option>
        </select>
        <select name="language" required>
            <option value="en">English</option>
            <option value="si">Sinhala</option>
            <option value="ta">Tamil</option>
        </select>
        <select name="privacy" required>
            <option value="public">Public</option>
            <option value="private">Private</option>
        </select>
        <button type="submit">Save Settings</button>
    </form>
</body>
</html>
