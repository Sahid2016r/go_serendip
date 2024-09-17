<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $trip_id = $_POST['trip_id'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    $stmt = $pdo->prepare('INSERT INTO reviews (user_id, trip_id, rating, review) VALUES (?, ?, ?, ?)');
    $stmt->execute([$user_id, $trip_id, $rating, $review]);

    echo "Review added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ratings and Reviews</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Ratings and Reviews</h1>
    <form method="post">
        <input type="number" name="user_id" placeholder="User ID" required>
        <input type="number" name="trip_id" placeholder="Trip ID" required>
        <input type="number" name="rating" placeholder="Rating" required>
        <input type="text" name="review" placeholder="Review" required>
        <button type="submit">Add Review</button>
    </form>
</body>
</html>
