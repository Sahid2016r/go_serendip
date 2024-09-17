<?php
// Include the database connection file
include 'db_connect.php';

// Handle deletion of admin
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $delete_sql = "DELETE FROM users WHERE id = $id";
    
    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Admin deleted successfully!');</script>";
    } else {
        echo "<script>alert('Error deleting admin: " . $conn->error . "');</script>";
    }
}

// Handle admin registration
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register_admin'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirm_password = $conn->real_escape_string($_POST['confirm_password']);
    $role = 'admin';  // Set role to admin
    $privacy = 1;  // Assuming privacy is some kind of consent field

    // Validate if passwords match
   // Handle admin registration
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register_admin'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirm_password = $conn->real_escape_string($_POST['confirm_password']);
    $role = 'admin';  // Set role to admin
    $privacy = 1;  // Assuming privacy is some kind of consent field

    // Validate if passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        // Store the password as plain text (not recommended for security reasons)
        // Insert into the database
        $insert_sql = "INSERT INTO users (username, email, password, privacy, role, created_at) 
                       VALUES ('$username', '$email', '$password', '$privacy', '$role', NOW())";

        if ($conn->query($insert_sql) === TRUE) {
            echo "<script>alert('Admin registered successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . $insert_sql . "<br>" . $conn->error . "');</script>";
        }
    }
}

}

// Fetch all admins
$sql = "SELECT id, username, email, created_at FROM users WHERE role = 'admin'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: #ecf0f1;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
        }

        .sidebar .logo {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            padding-bottom: 20px;
        }

        .sidebar .menu ul {
            list-style: none;
            padding: 0;
        }

        .sidebar .menu ul li {
            padding: 10px 20px;
        }

        .sidebar .menu ul li a {
            color: #ecf0f1;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .sidebar .menu ul li a i {
            margin-right: 10px;
        }

        .sidebar .menu ul li a:hover {
            background-color: #34495e;
            border-radius: 4px;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        button {
            background-color: #f44336;
            color: white;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #d32f2f;
        }

        .register-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .submit-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .submit-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">GO SERENDIP</div>
        <nav class="menu">
            <ul>
                <li><a href="home.php"><i class="fas fa-chart-line"></i><span>Dashboard</span></a></li>
                <li><a href="add_trip.php"><i class="fas fa-wallet"></i><span>Add Trip Creation</span></a></li>
                <li><a href="view_locations.php"><i class="fas fa-map-marked-alt"></i><span>View Locations</span></a></li>
                <li><a href="account_management.php"><i class="fas fa-user-cog"></i><span>Account Management</span></a></li>
                <li><a href="message_requests.php"><i class="fas fa-envelope"></i><span>Message Requests</span></a></li>
                <li><a href="message_requests.php"><i class="fas fa-cogs"></i><span>Settings</span></a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Admin Management</h1>

        <!-- Display All Admins -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data for each admin
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['created_at']}</td>
                                <td><a href='account_management.php?delete={$row['id']}'><button>Delete</button></a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No admins found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Register New Admin -->
        <div class="register-form">
            <h2>Register New Admin</h2>
            <form action="account_management.php" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" name="confirm_password" id="confirm_password" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="register_admin" class="submit-button">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
