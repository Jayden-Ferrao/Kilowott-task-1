<?php
session_start();
$errors = []; // Array to store validation errors

// Function to sanitize and validate input data
function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Validate Name
if (empty($_POST['name'])) {
    $errors['name'] = "Name is required";
} else {
    $name = test_input($_POST['name']);
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $errors['name'] = "Only letters and white space allowed";
    }
}

// Validate Email
if (empty($_POST['email'])) {
    $errors['email'] = "Email is required";
} else {
    $email = test_input($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }
}

// Validate Password
if (empty($_POST['password'])) {
    $errors['password'] = "Password is required";
} else {
    $password = test_input($_POST['password']);
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
        $errors['password'] = "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character";
    }
}

// Validate Confirm Password
if (empty($_POST['confirmPassword'])) {
    $errors['confirmPassword'] = "Confirm Password is required";
} else {
    $confirmPassword = test_input($_POST['confirmPassword']);
    if ($password !== $confirmPassword) {
        $errors['confirmPassword'] = "Passwords do not match";
    }
}

// Validate Date of Birth
if (empty($_POST['dob'])) {
    $errors['dob'] = "Date of Birth is required";
} else {
    $dob = test_input($_POST['dob']);
    $dobDate = new DateTime($dob);
    $today = new DateTime();
    $age = $today->diff($dobDate)->y;
    if ($age < 18) {
        $errors['dob'] = "You must be at least 18 years old.";
    }
}

// Validate Gender
if (empty($_POST['gender'])) {
    $errors['gender'] = "Gender is required";
} else {
    $gender = test_input($_POST['gender']);
}

// Image validation and encoding for database storage
if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === 0) {
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    $fileType = mime_content_type($_FILES['profileImage']['tmp_name']);
    if (in_array($fileType, $allowedTypes)) {
        $profileImage = file_get_contents($_FILES['profileImage']['tmp_name']); // Store the image as binary
    } else {
        $errors['profileImage'] = "Please upload a valid image (JPEG, JPG, PNG, or GIF).";
    }
} else {
    $errors['profileImage'] = "Profile Image is required.";
}

// If there are no validation errors, proceed with database insertion
if (empty($errors)) {
    $servername = "localhost"; 
    $username = "root"; 
    $db_password = ""; // Renamed to avoid conflict with user password
    $dbname = "dashboard_form"; 

    // Create connection
    $conn = new mysqli($servername, $username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        echo "<script>alert('Connection failed: " . $conn->connect_error . "');</script>";
        exit();
    }

    // Encrypt the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

     // Prepare and bind
     $stmt = $conn->prepare("INSERT INTO users (name, email, password, dob, gender, profile_image, image_type) VALUES (?, ?, ?, ?, ?, ?, ?)");
     $stmt->bind_param("sssssss", $name, $email, $hashed_password, $dob, $gender, $profileImage, $fileType);
 
    // Execute the statement
    if ($stmt->execute()) {
        // Set session variables for logged in user
        $_SESSION['user_id'] = $conn->insert_id;

        // Retrieve and store profile image for session use
        $user_id = $_SESSION['user_id'];

        // Query to fetch the image and its type from the database
        $sql = "SELECT id, password, profile_image, image_type FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($user_id, $hashed_password, $profileImage, $imageType);
        $stmt->fetch();
        $stmt->close();

        // Check if image data exists
        if ($profileImage) {
            // Encode the binary image data to Base64 to display in HTML
            $_SESSION['profile_image'] = "data:$imageType;base64," . base64_encode($profileImage);
        } else {
            // Provide a default image if no profile image is found
            $_SESSION['profile_image'] = "default-image.png";  // Set a path to a default image
        }
        // Redirect to login.html after successful insertion
        echo "<script>alert('Form submitted successfully by " . htmlspecialchars($name) . "!'); window.location.href='login.html';</script>";
        exit();
    } else {
        echo "<script>alert('Unsuccessful submission, Please try again.');</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    foreach ($errors as $error) {
        echo "<script>alert('" . htmlspecialchars($error) . "');</script>";
    }
}
