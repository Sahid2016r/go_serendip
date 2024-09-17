<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $item = $_POST['item'];

    $stmt = $pdo->prepare('INSERT INTO wishlist (user_id, item) VALUES (?, ?)');
    $stmt->execute([$user_id, $item]);

    echo "Item added to wishlist!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Wishlist</h1>
    <form method="post">
        <input type="number" name="user_id" placeholder="User ID" required>
        <input type="text" name="item" placeholder="Item" required>
        <button type="submit">Add to Wishlist</button>
    </form>
</body>
</html>
