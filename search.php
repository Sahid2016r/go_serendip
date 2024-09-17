<?php
require 'db.php';

$search_results = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['query'])) {
    $query = $_GET['query'];
    $stmt = $pdo->prepare('SELECT * FROM trips WHERE destination LIKE ?');
    $stmt->execute(["%$query%"]);
    $search_results = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GO SERENDIP - Search Trips</title>
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
            padding: 10px 150px;
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
            justify-content: center;
            width: 100%;
            margin-bottom: 20px;
        }

        form input[type="text"] {
            width: 300px;
            padding: 10px;
            border: 1px solid #00796b;
            border-radius: 4px 0 0 4px;
            outline: none;
            transition: border-color 0.3s;
            font-size: 16px;
        }

        form button {
            padding: 10px 20px;
            border: 1px solid #00796b;
            border-left: none;
            background-color: #00796b;
            color: #fff;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
        }

        form button:hover {
            background-color: #004d40;
        }

        h2 {
            color: #00796b;
            margin: 20px 0 10px;
        }

        ul {
            list-style: none;
            padding: 0;
            width: 100%;
            max-width: 600px;
        }

        ul li {
            background-color: #fff;
            margin: 5px 0;
            padding: 10px;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-size: 16px;
        }
    </style>
</head>
<body>
    <nav>
        <ul id="user-links">
            <li><a href="home.php">Home</a></li>
            <li><a href="search.php">Search </a></li>
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
        <h1>Search Trips</h1>
        <form method="get">
            <input type="text" name="query" placeholder="Search by destination" required>
            <button type="submit">Search</button>
        </form>

        <?php if ($search_results): ?>
            <h2>Search Results:</h2>
            <ul>
                <?php foreach ($search_results as $result): ?>
                    <li><?php echo htmlspecialchars($result['destination']); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>
</html>
