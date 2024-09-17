<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Planning App</title>
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
            background-color: #343a40;
            color: #fff;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar .logo {
            text-align: center;
            padding: 20px;
            font-size: 24px;
            background-color: #212529;
        }

        .sidebar .menu ul {
            list-style: none;
            padding: 20px 0;
        }

        .sidebar .menu ul li {
            padding: 15px 20px;
        }

        .sidebar .menu ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            display: flex;
            align-items: center;
        }

        .sidebar .menu ul li a i {
            margin-right: 10px;
        }

        .sidebar .menu ul li a:hover {
            background-color: #495057;
            border-radius: 4px;
        }

        .sidebar-toggle {
            padding: 10px;
            text-align: center;
            cursor: pointer;
        }

        .sidebar-toggle i {
            color: #adb5bd;
        }

        /* Top Navigation Bar Styling */
        .top-nav {
            height: 60px;
            width: calc(100% - 250px);
            background-color: #fff;
            position: fixed;
            top: 0;
            left: 250px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            padding: 20px;
            background-color: #f8f9fa;
            min-height: calc(100vh - 120px);
        }

        .content h1 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        .content p {
            font-size: 18px;
        }

        /* Footer Styling */
        .footer {
            width: calc(100% - 250px);
            margin-left: 250px;
            background-color: #212529;
            color: #adb5bd;
            text-align: center;
            padding: 20px 0;
            position: fixed;
            bottom: 0;
        }

        .footer .social-media a {
            color: #adb5bd;
            margin: 0 10px;
            text-decoration: none;
        }

        .footer .social-media a:hover {
            color: #fff;
        }
    </style>
</head>
<body>

    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <div class="logo">
            <h2>TravelApp</h2>
        </div>
        <nav class="menu">
            <ul>
                <li><a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="#"><i class="fas fa-map-signs"></i> Trip Planning</a></li>
                <li><a href="#"><i class="fas fa-wallet"></i> Budget Planning</a></li>
                <li><a href="#"><i class="fas fa-user-cog"></i> Account Management</a></li>
                <li><a href="#"><i class="fas fa-cogs"></i> Settings</a></li>
                <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </nav>
        <div class="sidebar-toggle">
            <i class="fas fa-angle-double-left"></i>
        </div>
    </aside>

    <!-- Top Navigation Bar -->
    <header class="top-nav">
        <div class="search-bar">
            <input type="text" placeholder="Search...">
            <button><i class="fas fa-search"></i></button>
        </div>
        <div class="nav-icons">
            <a href="#"><i class="fas fa-bell"></i></a>
            <a href="#" class="profile-icon">
                <img src="profile.jpg" alt="Profile">
                <i class="fas fa-caret-down"></i>
            </a>
            <a href="#"><i class="fas fa-moon"></i></a>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="content">
        <h1>Welcome to TravelApp</h1>
        <p>Plan your trips, manage your budget, and more!</p>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 TravelApp. All rights reserved.</p>
        <div class="social-media">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
    </footer>

</body>
</html>
