<?php
session_start();
header('Content-Type: application/json');

function validateInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$response = [
    'success' => false,
    'message' => ''
];

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
            $response['message'] = "Connection failed: " . $conn->connect_error;
            echo json_encode($response);
            exit();
        }

        // Check if the email exists in the database
        $sql = "SELECT password FROM users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_email'] = $email;
                $response['success'] = true;
                $response['message'] = "Login successful";
                echo json_encode($response);
                exit();
            } else {
                $response['message'] = "Invalid password.";
            }
        } else {
            $response['message'] = "Invalid email.";
        }

        $conn->close();
    } else {
        $response['message'] = implode("\n", $errors);
    }
}

echo json_encode($response);
?>