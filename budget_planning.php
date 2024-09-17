<?php
require 'db_connect.php'; 

// Handle budget form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_budget'])) {
    $user_id = 1; // Replace with dynamic user ID
    $trip_name = $_POST['trip_name'];
    $total_budget = $_POST['total_budget'];

    $stmt = $conn->prepare("INSERT INTO budgets (user_id, trip_name, total_budget) VALUES (?, ?, ?)");
    $stmt->bind_param("isd", $user_id, $trip_name, $total_budget);

    if ($stmt->execute()) {
        echo "<script>alert('Budget added successfully!');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Handle expense form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_expense'])) {
    $budget_id = $_POST['budget_id'];
    $expense_name = $_POST['expense_name'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];

    $stmt = $conn->prepare("INSERT INTO expenses (budget_id, expense_name, amount, date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isds", $budget_id, $expense_name, $amount, $date);

    if ($stmt->execute()) {
        echo "<script>alert('Expense added successfully!');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Handle budget update form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_budget'])) {
    $budget_id = $_POST['budget_id'];
    $additional_amount = $_POST['additional_amount'];

    $stmt = $conn->prepare("UPDATE budgets SET total_budget = total_budget + ? WHERE id = ?");
    $stmt->bind_param("di", $additional_amount, $budget_id);

    if ($stmt->execute()) {
        echo "<script>alert('Budget updated successfully!');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Handle budget delete form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_budget'])) {
    $budget_id = $_POST['budget_id'];

    // Delete expenses related to this budget
    $conn->query("DELETE FROM expenses WHERE budget_id = $budget_id");

    // Delete the budget
    $stmt = $conn->prepare("DELETE FROM budgets WHERE id = ?");
    $stmt->bind_param("i", $budget_id);

    if ($stmt->execute()) {
        echo "<script>alert('Budget deleted successfully!');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Handle expense delete form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_expense'])) {
    $expense_id = $_POST['expense_id'];

    $stmt = $conn->prepare("DELETE FROM expenses WHERE id = ?");
    $stmt->bind_param("i", $expense_id);

    if ($stmt->execute()) {
        echo "<script>alert('Expense deleted successfully!');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Planning & Expense Tracking</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
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
        .card {
            margin-bottom: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
        .table {
            margin-bottom: 0;
        }
        .table-bordered {
            border: none;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #dee2e6;
        }
        .update-budget-form {
            margin-bottom: 20px;
        }
        .hidden-btn {
            display: none;
        }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="logo">GO SERENDIP</div>
        <nav class="menu">
            <ul>
                <li><a href="user_page.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                <li><a href="trip_planning.php"><i class="fas fa-route"></i><span>Trip Planning</span></a></li>
                <li><a href="budget_planning.php"><i class="fas fa-dollar-sign"></i><span>Budget Plans</span></a></li>
                <li><a href="ai_chatbot.php"><i class="fas fa-robot"></i><span>AI Chat Bot</span></a></li>
                <li><a href="message_requests.php"><i class="fas fa-envelope-open-text"></i><span>Message Request</span></a></li>
                <li><a href="settings.php"><i class="fas fa-cog"></i><span>Settings</span></a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
            </ul>
        </nav>
        <div class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="fas fa-chevron-left"></i>
        </div>
    </div>

    <div class="container" style="margin-left: 250px;">
        <h1 class="text-center my-4">Budget Planning & Expense Tracking</h1>

        <!-- Row for Add Budget and Budgets Overview -->
        <div class="row">
            <!-- Add Budget Form -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Add New Budget
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="trip_name">Trip Name:</label>
                                <input type="text" id="trip_name" name="trip_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="total_budget">Total Budget:</label>
                                <input type="number" id="total_budget" name="total_budget" step="0.01" class="form-control" required>
                            </div>
                            <button type="submit" name="add_budget" class="btn btn-primary">Add Budget</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Budget Overview -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Budgets Overview
                    </div>
                    <div class="card-body">
                        <?php
                        $result = $conn->query("SELECT * FROM budgets");
                        if ($result->num_rows > 0) {
                            echo '<table class="table table-bordered">';
                            echo '<thead><tr><th>ID</th><th>Trip Name</th><th>Total Budget</th><th>Balance</th><th>Actions</th></tr></thead>';
                            echo '<tbody>';
                            while ($row = $result->fetch_assoc()) {
                                $budget_id = $row['id'];
                                
                                // Calculate total expenses for this budget
                                $expense_result = $conn->query("SELECT SUM(amount) AS total_expenses FROM expenses WHERE budget_id = $budget_id");
                                $expense_row = $expense_result->fetch_assoc();
                                $total_expenses = $expense_row['total_expenses'] ?: 0;
                                $balance = $row['total_budget'] - $total_expenses;

                                echo '<tr>';
                                echo '<td>' . $row['id'] . '</td>';
                                echo '<td>' . $row['trip_name'] . '</td>';
                                echo '<td>' . $row['total_budget'] . '</td>';
                                echo '<td>' . number_format($balance, 2) . '</td>';
                                echo '<td>';
                                echo '<form action="" method="POST" class="d-inline">';
                                echo '<input type="hidden" name="budget_id" value="' . $row['id'] . '">';
                                echo '<button type="submit" name="update_budget" class="btn btn-warning">Update</button>';
                                echo '</form>';
                                echo '<form action="" method="POST" class="d-inline">';
                                echo '<input type="hidden" name="budget_id" value="' . $row['id'] . '">';
                                echo '<button type="submit" name="delete_budget" class="btn btn-danger">Delete</button>';
                                echo '</form>';
                                echo '</td>';
                                echo '</tr>';
                            }
                            echo '</tbody>';
                            echo '</table>';
                        } else {
                            echo '<p>No budgets found.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row for Add Expense and Expenses Overview -->
        <div class="row">
            <!-- Add Expense Form -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Add New Expense
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="budget_id">Budget ID:</label>
                                <input type="number" id="budget_id" name="budget_id" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="expense_name">Expense Name:</label>
                                <input type="text" id="expense_name" name="expense_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount:</label>
                                <input type="number" id="amount" name="amount" step="0.01" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="date">Date:</label>
                                <input type="date" id="date" name="date" class="form-control" required>
                            </div>
                            <button type="submit" name="add_expense" class="btn btn-primary">Add Expense</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Expense Overview -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Expenses Overview
                    </div>
                    <div class="card-body">
                        <?php
                        $result = $conn->query("SELECT id, budget_id, expense_name, amount, date FROM expenses");
                        if ($result->num_rows > 0) {
                            echo '<table class="table table-bordered">';
                            echo '<thead><tr><th>ID</th><th>Budget ID</th><th>Expense Name</th><th>Amount</th><th>Date</th><th>Actions</th></tr></thead>';
                            echo '<tbody>';
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $row['id'] . '</td>';
                                echo '<td>' . $row['budget_id'] . '</td>';
                                echo '<td>' . $row['expense_name'] . '</td>';
                                echo '<td>' . $row['amount'] . '</td>';
                                echo '<td>' . $row['date'] . '</td>';
                                echo '<td>';
                                echo '<form action="" method="POST" class="d-inline">';
                                echo '<input type="hidden" name="expense_id" value="' . $row['id'] . '">';
                                echo '<button type="submit" name="delete_expense" class="btn btn-danger">Delete</button>';
                                echo '</form>';
                                echo '</td>';
                                echo '</tr>';
                            }
                            echo '</tbody>';
                            echo '</table>';
                        } else {
                            echo '<p>No expenses found.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
        }
    </script>
</body>
</html>
