<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Set default values for session variables if they are not set
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light-mode';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GO SERENDIP - Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            flex: 1;
        }
        .dark-mode .sidebar {
            background-color: #212529;
        }
        .dark-mode .sidebar a {
            color: #adb5bd;
        }
        .dark-mode .sidebar a:hover {
            background-color: #495057;
        }
        .toggle-button {
            background-color: transparent;
            border: none;
            cursor: pointer;
            color: inherit;
        }
    </style>
</head>
<body class="<?php echo htmlspecialchars($theme); ?>">
    <div class="sidebar">
        <h2 class="text-center">GO SERENDIP</h2>
        <a href="admin_profile.php">Admin Profile</a>
        <a href="add_trip.php">Add Trip Creation</a>
        <a href="account_management.php">Account Management</a>
        <a href="budget_planning.php">Budget Planning & Expense Tracking</a>
        <a href="customizable_settings.php">Customizable Settings</a>
        <button class="btn toggle-button" onclick="toggleMode()">
            <i class="fas fa-<?php echo ($theme === 'dark-mode') ? 'sun' : 'moon'; ?>"></i>
        </button>
        <a href="logout.php">Logout</a>
    </div>
    <div class="content">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    </div>
    <script>
        function toggleMode() {
            const body = document.body;
            const button = document.querySelector('.toggle-button');
            const icon = button.querySelector('i');
            if (body.classList.contains('light-mode')) {
                body.classList.remove('light-mode');
                body.classList.add('dark-mode');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
                localStorage.setItem('mode', 'dark');
            } else {
                body.classList.remove('dark-mode');
                body.classList.add('light-mode');
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
                localStorage.setItem('mode', 'light');
            }
        }

        function applyMode() {
            const mode = localStorage.getItem('mode');
            const button = document.querySelector('.toggle-button');
            const icon = button.querySelector('i');
            if (mode === 'dark') {
                document.body.classList.add('dark-mode');
                document.body.classList.remove('light-mode');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            } else {
                document.body.classList.add('light-mode');
                document.body.classList.remove('dark-mode');
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            }
        }

        window.onload = applyMode;
    </script>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
