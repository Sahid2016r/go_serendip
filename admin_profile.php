<?php
session_start();
require 'db_connect.php';
// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}


// Fetch user details
$user = $_SESSION['username'];
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();

// Handle form submission for updating username
if (isset($_POST['update_username'])) {
    $new_username = $_POST['new_username'];

    $updateStmt = $conn->prepare("UPDATE users SET username = ? WHERE username = ?");
    $updateStmt->bind_param("ss", $new_username, $user);

    if ($updateStmt->execute()) {
        // Update session variables
        $_SESSION['username'] = $new_username;

        // Redirect to the same page to reflect changes
        header("Location: admin_profile.php");
        exit();
    } else {
        echo "Error: " . $updateStmt->error;
    }

    $updateStmt->close();
}

// Handle form submission for updating password
if (isset($_POST['update_password'])) {
    $new_password = $_POST['new_password'];

    if (!empty($new_password)) {
        // Directly use the new password without hashing
        $updateStmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
        $updateStmt->bind_param("ss", $new_password, $user);

        if ($updateStmt->execute()) {
            echo "Password updated successfully.";
        } else {
            echo "Error: " . $updateStmt->error;
        }

        $updateStmt->close();
    } else {
        echo "Please enter a new password.";
    }
}

// Fetch all administrators from admin_role table
$admin_query = "SELECT * FROM users WHERE role = 'admin'";
 // Adjust this query based on your actual table structure
$admin_result = $conn->query($admin_query);

// Check if query execution was successful
if ($admin_result === false) {
    echo "Error executing query: " . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile - GO SERENDIP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Sidebar Styling */
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

        /* Top Navigation Bar Styling */
        .top-nav {
            height: 60px;
            width: calc(100% - 250px);
            background-color: #f8f9fa;
            position: fixed;
            top: 0;
            left: 250px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: left 0.3s, width 0.3s;
            z-index: 1000;
        }

        .top-nav.collapsed {
            left: 80px;
            width: calc(100% - 80px);
        }

        .top-nav .search-bar {
            display: flex;
            align-items: center;
        }

        .top-nav .search-bar input {
            border: 1px solid #ced4da;
            padding: 8px;
            border-radius: 4px;
            margin-right: 10px;
        }

        .top-nav .search-bar button {
            border: none;
            background-color: #007bff;
            color: #fff;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        .top-nav .nav-icons a {
            margin-left: 20px;
            color: #495057;
            text-decoration: none;
        }

        .top-nav .profile-icon {
            display: flex;
            align-items: center;
        }

        .top-nav .profile-icon img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 5px;
        }

        /* Main Content Styling */
        .content {
            margin-left: 250px;
            margin-top: 60px;
            padding: 30px;
            background-color: #f4f6f9;
            min-height: calc(100vh - 120px);
            transition: margin-left 0.3s, width 0.3s;
        }

        .content.collapsed {
            margin-left: 80px;
        }

        .content h1 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        .content .card {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .content p {
            font-size: 18px;
        }

        .section-box {
            margin-bottom: 20px;
        }

        .section-box h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .btn-custom {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        /* Footer Styling */
        .footer {
            width: calc(100% - 250px);
            margin-left: 250px;
            background-color: #2c3e50;
            color: #adb5bd;
            text-align: center;
            padding: 20px 0;
            position: fixed;
            bottom: 0;
            transition: margin-left 0.3s, width 0.3s;
            z-index: 1000;
        }

        .footer.collapsed {
            margin-left: 80px;
            width: calc(100% - 80px);
        }

        .footer a {
            color: #adb5bd;
            text-decoration: none;
        }

        .footer a:hover {
            color: #fff;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 60px;
            }

            .top-nav {
                left: 60px;
                width: calc(100% - 60px);
            }

            .content {
                margin-left: 60px;
            }

            .footer {
                margin-left: 60px;
                width: calc(100% - 60px);
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="logo">
            GO SERENDIP
        </div>
        <div class="menu">
            <ul>
                <li><a href="admin_profile.php"><i class="fas fa-user"></i> <span>Admin Profile</span></a></li>
                <li><a href="add_trip.php"><i class="fas fa-plus"></i> <span>Add Trip Creation</span></a></li>
                <li><a href="account_management.php"><i class="fas fa-cogs"></i> <span>Account Management</span></a></li>
                <li><a href="budget_planning.php"><i class="fas fa-dollar-sign"></i> <span>Budget Planning & Expense Tracking</span></a></li>
                <li><a href="customizable_settings.php"><i class="fas fa-cogs"></i> <span>Customizable Settings</span></a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
            </ul>
        </div>
        <div class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="fas fa-arrow-left"></i>
        </div>
    </div>

    <!-- Top Navigation Bar -->
    <div class="top-nav" id="top-nav">
        <div class="search-bar">
            <input type="text" placeholder="Search...">
            <button>Search</button>
        </div>
        <div class="nav-icons">
            <a href="#"><i class="fas fa-bell"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
            <div class="profile-icon">
                <img src="https://via.placeholder.com/30" alt="Profile">
                <span>Admin</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content" id="content">
        <h1>Admin Profile</h1>

        <!-- Update Username Form -->
        <div class="section-box">
            <h3>Update Username</h3>
            <form method="post">
                <div class="form-group">
                    <label for="new_username">New Username:</label>
                    <input type="text" id="new_username" name="new_username" class="form-control" required>
                </div>
                <button type="submit" name="update_username" class="btn-custom">Update Username</button>
            </form>
        </div>

        <!-- Update Password Form -->
        <div class="section-box">
            <h3>Update Password</h3>
            <form method="post">
                <div class="form-group">
                    <label for="new_password">New Password:</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" required>
                </div>
                <button type="submit" name="update_password" class="btn-custom">Update Password</button>
            </form>
        </div>

        <!-- List of Administrators -->
        <div class="section-box">
            <h3>List of Administrators</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($admin_result) && $admin_result instanceof mysqli_result) {
                        if ($admin_result->num_rows > 0) {
                            while ($row = $admin_result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row['role'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No administrators found</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>Error fetching administrators</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <div><p>vafjhafdfdfdfdfgh</p></div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer" id="footer">
        <p>&copy; 2024 GO SERENDIP. All rights reserved. | <a href="#">Privacy Policy</a></p>
    </div>

    <!-- Scripts -->
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