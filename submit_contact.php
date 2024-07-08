<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact_form_db";

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
    // Redirect to thank you page
    header("Location: thankyou.html");
    exit();
} else {
    
    echo "Error: " . $sql . "<br>" . $stmt->error;
}

$stmt->close(); 
$conn->close();
?>