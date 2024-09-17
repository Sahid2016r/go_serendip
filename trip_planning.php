<?php
// Start session to handle cart functionality
session_start();
require 'db_connect.php'; // Include your database connection file

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Handle Add to Cart (wishlist) action
if (isset($_GET['add_to_cart'])) {
    $location_id = $_GET['add_to_cart'];
    if (!in_array($location_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $location_id;
    }
}

// Fetch locations from the database
$search = "";
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $sql = "SELECT `id`, `location_name`, `location_url`, `image_url`, `descriptions`, `created_at` 
            FROM `locations` 
            WHERE `location_name` LIKE '%$search%'";
} else {
    $sql = "SELECT `id`, `location_name`, `location_url`, `image_url`, `descriptions`, `created_at` FROM `locations`";
}
// Handle Remove from Cart (wishlist) action
if (isset($_GET['remove_from_cart'])) {
    $location_id = $_GET['remove_from_cart'];
    if (($key = array_search($location_id, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
    }
}

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trip Planning</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #2c3e50;
            color: #ecf0f1;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: width 0.3s;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar .logo {
            text-align: center;
            padding: 20px;
            font-size: 24px;
            background-color: #1a252f;
        }

        .sidebar.collapsed .logo {
            font-size: 18px;
            padding: 15px;
        }

        .sidebar .menu ul {
            list-style: none;
            padding: 0;
        }

        .sidebar .menu ul li {
            padding: 15px 20px;
        }

        .sidebar .menu ul li a {
            color: #ecf0f1;
            text-decoration: none;
            font-size: 16px;
            display: flex;
            align-items: center;
            transition: background-color 0.3s;
        }

        .sidebar .menu ul li a i {
            margin-right: 15px;
            font-size: 20px;
        }

        .sidebar.collapsed .menu ul li a {
            justify-content: center;
        }

        .sidebar.collapsed .menu ul li a span {
            display: none;
        }

        .sidebar .menu ul li a:hover {
            background-color: #34495e;
            border-radius: 4px;
        }

        .sidebar-toggle {
            padding: 15px;
            text-align: center;
            cursor: pointer;
        }

        .sidebar-toggle i {
            color: #adb5bd;
            transition: transform 0.3s;
        }

        .sidebar.collapsed .sidebar-toggle i {
            transform: rotate(180deg);
        }

        /* Content Styles */
        .container {
            margin-left: 270px;
            padding: 20px;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .search-bar {
            margin: 20px 0;
        }

        .saved-locations {
            max-height: 600px;
            overflow-y: auto;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .saved-locations h3 {
            text-align: center;
        }

        .card-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #fff;
            background-color: #28a745;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="logo">GO SERENDIP</div>
        <nav class="menu">
            <ul>
                <li><a href="user_page.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li> <!-- Dashboard icon -->
                <li><a href="trip_planning.php"><i class="fas fa-route"></i><span>Trip Planning</span></a></li> <!-- Trip Planning icon -->
                <li><a href="budget_planning.php"><i class="fas fa-dollar-sign"></i><span>Budget Plans</span></a></li> <!-- Budget Plans icon -->
                <li><a href="ai_chatbot.php"><i class="fas fa-robot"></i><span>AI Chat Bot</span></a></li> <!-- AI Chat Bot icon -->
                <li><a href="message_requests.php"><i class="fas fa-envelope-open-text"></i><span>Message Request</span></a></li> <!-- Message Request icon -->
                <li><a href="settings.php"><i class="fas fa-cog"></i><span>Settings</span></a></li> <!-- Settings icon -->
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li> <!-- Logout icon -->
            </ul>
        </nav>
        <div class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="fas fa-chevron-left"></i>
        </div>
    </div>

    <div class="container">
        <h1 class="my-4">Trip Planning</h1>

        <!-- Search Form -->
        <form method="POST" class="form-inline search-bar">
            <input type="text" name="search" class="form-control mr-sm-2" placeholder="Search Locations" value="<?php echo $search; ?>">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>

        <div class="row">
            <!-- Locations Grid (Left) -->
            <div class="col-md-8">
                <div class="row">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <img class="card-img-top" src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['location_name']; ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['location_name']; ?></h5>
                                        <p class="card-text"><?php echo substr($row['descriptions'], 0, 100); ?>...</p>
                                        <a href="<?php echo $row['location_url']; ?>" target="_blank" class="btn btn-primary">View Details</a>
                                    </div>
                                    <div class="card-footer text-right">
                                        <a href="trip_planning.php?add_to_cart=<?php echo $row['id']; ?>" class="card-icon"><i class="fas fa-cart-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="col-12 text-center">No locations found.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Saved Locations (Right) -->
           <!-- Saved Locations (Right) -->
<div class="col-md-4">
    <div class="saved-locations">
        <h3>Saved Locations</h3>
        <?php if (!empty($_SESSION['cart'])): ?>
            <ul class="list-group">
                <?php
                // Fetch saved locations
                $cart_items = implode(',', $_SESSION['cart']);
                $sql_cart = "SELECT `id`, `location_name`, `location_url` FROM `locations` WHERE `id` IN ($cart_items)";
                $cart_result = $conn->query($sql_cart);
                if ($cart_result->num_rows > 0):
                    while($cart_row = $cart_result->fetch_assoc()): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo $cart_row['location_name']; ?>
                            <div class="btn-group">
                                <a href="<?php echo $cart_row['location_url']; ?>" target="_blank" class="btn btn-sm btn-primary">View</a>
                                <!-- Remove/Cancel button -->
                                <a href="trip_planning.php?remove_from_cart=<?php echo $cart_row['id']; ?>" class="btn btn-sm btn-danger ml-2">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </li>
                    <?php endwhile;
                endif;
                ?>
            </ul>
        <?php else: ?>
            <p class="text-center">No saved locations yet.</p>
        <?php endif; ?>
    </div>
</div>

        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        }
    </script>
</body>
</html>
