<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $destination = $_POST['destination'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $accommodation = $_POST['accommodation'];
    $transportation = $_POST['transportation'];

    $stmt = $pdo->prepare('INSERT INTO trips (destination, start_date, end_date, accommodation, transportation) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$destination, $start_date, $end_date, $accommodation, $transportation]);

    echo "<p>Trip created successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Trip</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f0f0f0;
            color: #333;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #ffffff;
            width: 100%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 10px 0;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: #00796b;
            font-weight: bold;
            padding: 10px 20px;
            transition: background-color 0.3s, color 0.3s;
        }

        nav ul li a:hover {
            background-color: #00796b;
            color: #ffffff;
            border-radius: 4px;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        h1 {
            margin-bottom: 20px;
            color: #00796b;
        }

        form {
            display: flex;
            flex-direction: column;
            width: 300px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        form input[type="text"],
        form input[type="date"] {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #00796b;
            border-radius: 4px;
            outline: none;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        form input[type="text"]:focus,
        form input[type="date"]:focus {
            border-color: #004d40;
        }

        form button {
            padding: 10px;
            border: none;
            background-color: #00796b;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
        }

        form button:hover {
            background-color: #004d40;
        }
    </style>
</head>
<body>
    <nav>
        <ul id="user-links">
            <li><a href="search.php">Search Trips</a></li>
            <li><a href="create_trip.php">Create Trip</a></li>
            <li><a href="map.php">Explore Map</a></li>
            <li><a href="budget.php">Budget Plan</a></li>
            <li><a href="chatbox.php">Chatbox</a></li>
            <li><a href="review.php">Review</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="wishlist.php">Wishlist</a></li>
        </ul>
    </nav>
    <div class="container">
        <h1>Create Trip</h1>
        <form method="post">
            <input type="text" name="destination" placeholder="Destination" required>
            <input type="date" name="start_date" placeholder="Start Date" required>
            <input type="date" name="end_date" placeholder="End Date" required>
            <input type="text" name="accommodation" placeholder="Accommodation" required>
            <input type="text" name="transportation" placeholder="Transportation" required>
            <button type="submit">Create Trip</button>
        </form>
    </div>
</body>
</html>
