<?php
// Include the database connection file
include 'db_connect.php';

// Query to fetch locations data
$sql = "SELECT `id`, `location_name`, `location_url`, `image_url`, `descriptions`, `created_at` FROM `locations`";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Locations</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
         .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #2c3e50;
            color: #ecf0f1;
            position: fixed;
            left: 0;
            top: 0;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            z-index: 1000;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar .logo {
            text-align: center;
            padding: 20px;
            font-size: 24px;
            background-color: #1a252f;
            transition: all 0.3s;
        }

        .sidebar.collapsed .logo {
            font-size: 18px;
            padding: 15px;
        }

        .sidebar .menu ul {
            list-style: none;
            padding: 20px 0;
        }

        .sidebar .menu ul li {
            padding: 15px 20px;
            white-space: nowrap;
        }

        .sidebar .menu ul li a {
            color: #ecf0f1;
            text-decoration: none;
            font-size: 16px;
            display: flex;
            align-items: center;
            transition: all 0.3s;
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


        h1 {
            text-align: center;
            color: #333;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .location-box {
            background-color: #fff;
            margin: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            overflow: hidden;
            transition: transform 0.2s;
        }

        .location-box:hover {
            transform: scale(1.05);
        }

        .location-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .location-content {
            padding: 15px;
        }

        .location-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .location-description {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }

        .location-url {
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }

        .location-url:hover {
            color: #45a049;
        }

        @media (max-width: 768px) {
            .location-box {
                width: 100%;
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="logo">GO SERENDIP</div>
       <nav class="menu">
            <ul>
                <li><a href="home.php"><i class="fas fa-chart-line"></i><span>Dashboard</span></a></li>
                <li><a href="add_trip.php"><i class="fas fa-wallet"></i><span>Add Trip Creation</span></a></li>
                <li><a href="view_locations.php"><i class="fas fa-user-cog"></i><span>View Location</span></a></li>
                <li><a href="account_management.php"><i class="fas fa-user-cog"></i><span>Account Management</span></a></li>
                <li><a href="message_requests.php"><i class="fas fa-user-cog"></i><span>Message Request </span></a></li>
                <!-- Dropdown Menu for Settings -->
                <li >
                    <a href="#"><i class="fas fa-cogs"></i><span>Settings</span></a>
                    
                </li>
                
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
            </ul>
        </nav>
        <div class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="fas fa-chevron-left"></i>
        </div>
    </div>

<h1>Explore Locations</h1>

<div class="container">
    <?php
    // Check if any locations are found
    if ($result->num_rows > 0) {
        // Loop through the locations and display each in a box
        while($row = $result->fetch_assoc()) {
            ?>
            <div class="location-box">
                <!-- Display location image -->
                <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['location_name']; ?>" class="location-image">
                
                <div class="location-content">
                    <!-- Display location name -->
                    <div class="location-title"><?php echo $row['location_name']; ?></div>
                    
                    <!-- Display location description -->
                    <div class="location-description"><?php echo $row['descriptions']; ?></div>

                    <!-- Display location URL -->
                    <a href="<?php echo $row['location_url']; ?>" class="location-url" target="_blank">View Location</a>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<p>No locations found.</p>";
    }

    // Close the database connection
    $conn->close();
    ?>
</div>
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('top-nav').classList.toggle('collapsed');
            document.getElementById('content').classList.toggle('collapsed');
            document.getElementById('footer').classList.toggle('collapsed');
        }
    </script>

</body>
</html>
