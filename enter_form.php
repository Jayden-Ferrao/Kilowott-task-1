<?php
session_start();

// Function to validate and sanitize input data
function validateInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form inputs
    $email = validateInput($_POST["loginEmail"]);
    $password = validateInput($_POST["loginPassword"]);

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $db_password = ""; 
    $dbname = "dashboard_form";

    // Create connection
    $conn = new mysqli($servername, $username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SELECT statement using prepared statement
    $stmt = $conn->prepare("SELECT email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows == 1) {
        // Bind result variables
        $stmt->bind_result($db_email, $db_password);
        $stmt->fetch();

        // Verify hashed password
        if (password_verify($password, $db_password)) {
            // Password correct, set session and redirect
            $_SESSION['user_email'] = $email;
            // Redirect to dashboard.html
            echo "<script>alert('Logged in succesfully!'); window.location.href='dashboard.html';</script>";
            exit;
        } else {
            // Incorrect password
            echo "<script>alert('Incorrect password!'); window.location.href='login.html';</script>";
        }
    } else {
        // User not found
        echo "<script>alert('User not found!'); window.location.href='login.html';</script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>