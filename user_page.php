<?php
// Include database connection file
include 'db_connect.php';

// User's ID (this should be retrieved from session or login)
$user_id = 1; // Replace with session-based user ID

// Get user's trip budgets
$budget_sql = "SELECT id, trip_name, total_budget, created_at FROM budgets WHERE user_id = $user_id";
$budget_result = $conn->query($budget_sql);

// Get user's expenses
$expenses_sql = "SELECT e.budget_id, e.expense_name, e.amount, e.date 
                 FROM expenses e 
                 JOIN budgets b ON b.id = e.budget_id 
                 WHERE b.user_id = $user_id";
$expenses_result = $conn->query($expenses_sql);

// Get user's to-do list notes
$notes_sql = "SELECT note FROM notes WHERE user_id = $user_id";
$notes_result = $conn->query($notes_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            color: #333;
        }

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
            padding: 20px 0;
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

        .container {
            margin-left: 270px;
            padding: 30px;
        }

        .dashboard-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .dashboard-box {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: calc(50% - 10px);
        }

        .dashboard-box h2 {
            font-size: 20px;
            margin-bottom: 15px;
            color: #555;
            text-align: center;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }

        .dashboard-box table {
            width: 100%;
            border-collapse: collapse;
        }

        .dashboard-box th, .dashboard-box td {
            border: 1px solid #e5e5e5;
            padding: 10px;
            text-align: center;
        }

        .dashboard-box th {
            background-color: #00a8ff;
            color: white;
        }

        .dashboard-box td {
            background-color: #f9f9f9;
        }

        .note-box {
            background-color: #fffae6;
            border: 1px solid #f4e5a2;
            padding: 20px;
            border-radius: 5px;
            margin-top: 15px;
        }

        .calendar-box iframe {
            width: 100%;
            height: 350px;
            border: none;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-top: 10px;
        }

        button {
            background-color: #00a8ff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }

        button:hover {
            background-color: #007bb5;
        }

        @media (max-width: 768px) {
            .container {
                margin-left: 80px;
                padding: 15px;
            }

            .dashboard-box {
                width: 100%;
            }
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
        <div class="dashboard-grid">
            <!-- Trip Budgets -->
            <div class="dashboard-box">
                <h2>Your Trips & Budgets</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Trip Name</th>
                            <th>Total Budget</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($budget_result->num_rows > 0) {
                            while ($row = $budget_result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['trip_name']}</td>
                                        <td>{$row['total_budget']}</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2'>No trips found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Expenses -->
            <div class="dashboard-box">
                <h2>Your Expenses</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Expense Name</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($expenses_result->num_rows > 0) {
                            while ($row = $expenses_result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['expense_name']}</td>
                                        <td>{$row['amount']}</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2'>No expenses found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- To-Do List with Note Paper View -->
            <div class="dashboard-box">
                <h2>To-Do List</h2>
                <div class="note-box">
                    <h3>Your Notes</h3>
                    <ul>
                        <?php
                        if ($notes_result->num_rows > 0) {
                            while ($note = $notes_result->fetch_assoc()) {
                                echo "<li>{$note['note']}</li>";
                            }
                        } else {
                            echo "<li>No notes found.</li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <!-- Calendar -->
            <div class="dashboard-box calendar-box">
                <h2>Calendar</h2>
                <iframe src="https://calendar.google.com/calendar/embed?src=en.usa%23holiday%40group.v.calendar.google.com&ctz=America%2FNew_York"></iframe>
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
