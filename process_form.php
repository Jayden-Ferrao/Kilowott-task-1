<?php
session_start();

function validateInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = validateInput($_POST["name"]);
    $email = validateInput($_POST["email"]);
    $password = validateInput($_POST["password"]);
    $confirmPassword = validateInput($_POST["confirmPassword"]);
    $dob = validateInput($_POST["dob"]);
    $gender = validateInput($_POST["gender"]);
    $age_confirmation = validateInput($_POST["age"]);
    $terms = isset($_POST["terms"]) ? true : false;

    $errors = [];

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
    if (empty($age_confirmation)) {
        $errors[] = "Please confirm if you are 18+";
    }
    if (!$terms) {
        $errors[] = "You must agree to the terms and conditions";
    }

    if (empty($errors)) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Database connection
        $conn = new mysqli("localhost", "root", "", "dashboard_form");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert new user data into the database
        $sql = "INSERT INTO users (name, email, password, dob, gender, age) VALUES ('$name', '$email', '$hashedPassword', '$dob', '$gender', '$age_confirmation')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['user_email'] = $email;
            header("Location: login.html");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>