<?php
session_start();

// Database connection details
$servername = "localhost"; // or your server name
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "go_serendip"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize totals
$total_trips = 0;
$total_admin_amount = 0;
$total_user_amount = 0;
$total_revenue = 0;

// Fetch the total number of trips
$query_trips = "SELECT COUNT(*) AS total_trips FROM locations"; // Adjust if the table is different
$result_trips = $conn->query($query_trips);
if ($result_trips) {
    $row = $result_trips->fetch_assoc();
    $total_trips = $row['total_trips'];
} else {
    echo "Error fetching total trips: " . $conn->error;
}

// Fetch the total amount for admins and users
// Assuming you have a different structure for amount; replace 'amount' with the correct column name
$query_users = "SELECT role, SUM(some_amount_column) AS total_amount FROM users GROUP BY role"; // Adjust 'some_amount_column'
$result_users = $conn->query($query_users);
if ($result_users) {
    while ($row = $result_users->fetch_assoc()) {
        if ($row['role'] == 'admin') {
            $total_admin_amount = $row['total_amount'];
        } else {
            $total_user_amount = $row['total_amount'];
        }
    }
} else {
    echo "Error fetching user amounts: " . $conn->error;
}

// Fetch total revenue
// Adjust the table and column names as needed
$query_revenue = "SELECT SUM(revenue_column) AS total_revenue FROM trips"; // Replace 'revenue_column'
$result_revenue = $conn->query($query_revenue);
if ($result_revenue) {
    $row = $result_revenue->fetch_assoc();
    $total_revenue = $row['total_revenue'];
} else {
    echo "Error fetching total revenue: " . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - GO SERENDIP</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
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

        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        .sidebar.collapsed + .content {
            margin-left: 80px;
        }

        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="<?php echo htmlspecialchars($_SESSION['theme']); ?>">

    <aside class="sidebar">
        <div class="logo">
            <h2>Go Serendip</h2>
        </div>
        <nav class="menu">
            <ul>
                <li><a href="home.php"><i class="fas fa-chart-line"></i><span>Dashboard</span></a></li>
                <li><a href="add_trip.php"><i class="fas fa-wallet"></i><span>Add Trip Creation</span></a></li>
                <li><a href="view_locations.php"><i class="fas fa-map-marker-alt"></i><span>View Locations</span></a></li>
                <li><a href="account_management.php"><i class="fas fa-user-cog"></i><span>Account Management</span></a></li>
                <li><a href="message_requests.php"><i class="fas fa-envelope"></i><span>Message Requests</span></a></li>
                <!-- Dropdown Menu for Settings -->
                <li class="dropdown">
                    <a href="#"><i class="fas fa-cogs"></i><span>Settings</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Change Username</a></li>
                        <li><a href="#">Change Password</a></li>
                    </ul>
                </li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
            </ul>
        </nav>
        <div class="sidebar-toggle">
            <i class="fas fa-angle-double-left"></i>
        </div>
    </aside>

    <div class="content">
        <div class="container">
            <h1>Admin Dashboard</h1>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Trips</h5>
                            <p class="card-text"><?php echo htmlspecialchars($total_trips); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Admin Amount</h5>
                            <p class="card-text"><?php echo htmlspecialchars($total_admin_amount); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total User Amount</h5>
                            <p class="card-text"><?php echo htmlspecialchars($total_user_amount); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Revenue</h5>
                            <p class="card-text"><?php echo htmlspecialchars($total_revenue); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and Font Awesome scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Sidebar toggle script -->
    <script>
        document.querySelector('.sidebar-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
            document.querySelector('.content').classList.toggle('collapsed');
        });
    </script>
</body>
</html>
