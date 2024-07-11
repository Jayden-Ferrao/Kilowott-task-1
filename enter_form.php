<?php
session_start();

function validateInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = validateInput($_POST["loginEmail"]);
    $password = validateInput($_POST["loginPassword"]);

    $errors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }

    if (empty($errors)) {
        // Database connection
        $conn = new mysqli("localhost", "root", "", "dashboard_form");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the email exists in the database
        $sql = "SELECT password FROM users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_email'] = $email;
                header("Location: dashboard.html");
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "Invalid email.";
        }

        $conn->close();
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>