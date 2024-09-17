<?php
session_start();
require 'db_connect.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Do not hash the password
    $privacy = $_POST['privacy'];
    $role = 'user'; // Default role for new registrations

    // Check if the username already exists
    $checkStmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $checkStmt->bind_param("s", $username);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        echo "Error: Username already taken.";
    } else {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, privacy, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $email, $password, $privacy, $role);

        // Execute the statement
        if ($stmt->execute()) {
            // Set session variables
            $_SESSION['username'] = $username;
            $_SESSION['privacy'] = $privacy;
            $_SESSION['role'] = $role;

            // Redirect to user page after successful registration
            header("Location: login.php");
            exit(); // Always exit after a redirect
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Close the check statement
    $checkStmt->close();
    $conn->close();
}
?>
