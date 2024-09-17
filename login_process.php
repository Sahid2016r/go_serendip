<?php
session_start();
require 'db_connect.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password']; // Plain text password

    // Ensure the database connection is established
    if ($conn === false) {
        die("Error: Could not connect to the database.");
    }

    // Prepare and execute the statement to check user credentials
    $stmt = $conn->prepare("SELECT username, password, role FROM users WHERE username = ?");
    
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($db_username, $db_password, $db_role);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        // Verify the password (plain text comparison)
        if ($password === $db_password) {
            // Set session variables
            $_SESSION['username'] = $db_username;
            $_SESSION['role'] = $db_role;

            // Redirect based on role
            if ($db_role == 'admin') {
                header("Location: home.php");
            } else {
                header("Location: user_page.php");
            }
            exit(); // Always exit after a redirect
        } else {
            echo "Error: Incorrect password.";
        }
    } else {
        echo "Error: Username not found.";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
