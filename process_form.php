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

// Validate Profile Image
if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === 0) {
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    $maxSize = 5 * 1024 * 1024; // 5 MB
    $file = $_FILES['profileImage'];

    // Check file size
    if ($file['size'] > $maxSize) {
        $errors['profileImage'] = "The image size must be less than 5 MB.";
    }

    // Check file type
    $fileType = mime_content_type($file['tmp_name']);
    if (!in_array($fileType, $allowedTypes)) {
        $errors['profileImage'] = "Please upload a valid image (JPEG, JPG, PNG, or GIF).";
    }

    // Move the file if no errors
    if (empty($errors['profileImage'])) {
        $targetDir = __DIR__ . "/uploads/"; 
        if (!is_dir($targetDir)) {
            if (!mkdir($targetDir, 0755, true)) {
                echo "<script>alert('Failed to create uploads directory: " . $targetDir . "');</script>"; // Debugging info
                exit();
            } else {
                echo "<script>alert('Uploads directory created successfully.');</script>"; // Debugging info
            }
        } else {
            echo "<script>alert('Uploads directory already exists.');</script>"; // Debugging info
        }
        
        // Proceed with file upload if the directory is created successfully
        $uniqueFileName = uniqid() . "_" . basename($file['name']);
        $targetFile = $targetDir . $uniqueFileName;
        
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            echo "<script>alert('File uploaded successfully.');</script>"; // Debugging info
            $profileImagePath = $uniqueFileName; // Store the file name, not full path
        } else {
            echo "<script>alert('File upload failed.');</script>"; // Debugging info
            exit();
        }
    }
} else {
    $errors['profileImage'] = "Please upload a profile image.";
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
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, dob, gender, profile_image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $hashed_password, $dob, $gender, $profileImagePath);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to login.html after successful insertion
        echo "<script>alert('Form submitted successfully by " . htmlspecialchars($name) . "!'); window.location.href='login.html';</script>";
        exit();
    } else {
        // Display an error alert
        echo "<script>alert('Unsuccessful submission, Please try again.');</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    // Output errors for debugging
    foreach ($errors as $error) {
        echo "<script>alert('" . htmlspecialchars($error) . "');</script>";
    }
}
?>