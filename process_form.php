<?php
session_start();

// Function to validate and sanitize input data
function validateInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form inputs
    $name = validateInput($_POST["name"]);
    $email = validateInput($_POST["email"]);
    $password = validateInput($_POST["password"]);
    $confirmPassword = validateInput($_POST["confirmPassword"]);
    $dob = validateInput($_POST["dob"]);
    $gender = validateInput($_POST["gender"]);
    $age_confirmation = validateInput($_POST["age"]);

    // Array to store validation errors
    $errors = [];

    // Basic validation checks
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match";
    }
    if (empty($dob)) {
        $errors[] = "Date of birth is required";
    }
    if (empty($gender)) {
        $errors[] = "Gender is required";
    }
    if (empty($age_confirmation) || $age_confirmation !== 'yes') {
        $errors[] = "Please confirm if you are 18+";
    }

    // If no validation errors, proceed with database insertion
    if (empty($errors)) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Database connection details
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

        // Prepare INSERT statement using prepared statement
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, dob, gender, age) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $email, $hashedPassword, $dob, $gender, $age_confirmation);

        // Execute the statement
        if ($stmt->execute()) {
            // Registration successful, set session and redirect to login page
            $_SESSION['user_email'] = $email;
            header("Location: login.html");
            exit();
        } else {
            // Display error message if execution fails
            echo "Error: " . $stmt->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>