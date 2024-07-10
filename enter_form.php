<?php
session_start(); // Start the session

// Validate Email
if (empty($_POST['loginEmail'])) {
    $loginErrors['email'] = "Email is required";
} else {
    $loginEmail = test_input($_POST['loginEmail']);
    if (!filter_var($loginEmail, FILTER_VALIDATE_EMAIL)) {
        $loginErrors['email'] = "Invalid email format";
    }
}

// Validate Password
if (empty($_POST['loginPassword'])) {
    $loginErrors['password'] = "Password is required";
} else {
    $loginPassword = test_input($_POST['loginPassword']);
    // Check if password is at least 8 characters long and contains a mix of letters, numbers, and special characters
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $loginPassword)) {
        $loginErrors['password'] = "Invalid password";
    }
}

// If there are no validation errors, proceed with checking credentials
if (empty($loginErrors)) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dashboard_form";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $loginEmail, $loginPassword);

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Set session variables
        $_SESSION['user'] = $loginEmail;

        // Redirect to dashboard.html after successful login
        header("Location: dashboard.html");
        exit();
    } else {
        echo "Invalid email or password";
    }

    $stmt->close();
    $conn->close();
}

// Function to sanitize and validate input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>