<?php
header('Content-Type: application/json');
session_start(); // Start the session

$loginErrors = [];

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
}

// If there are no validation errors, proceed with checking credentials
if (empty($loginErrors)) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dashboard_form";
    
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
        exit();
    }

    // Prepare and bind
    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $loginEmail);

    // Execute the statement
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        if (password_verify($loginPassword, $hashed_password)) {
            // Set session variables
            $_SESSION['user'] = $loginEmail;
            echo json_encode(['success' => true, 'message' => 'Login successful']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Validation errors', 'errors' => $loginErrors]);
}

// Function to sanitize and validate input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>