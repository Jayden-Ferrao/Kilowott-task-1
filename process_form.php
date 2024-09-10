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

// Validate Image Upload
if (!empty($_FILES['profileImage']['name'])) {
    $target_dir = "./Kilowott-task-1/uploads";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $fileName = basename($_FILES["profileImage"]["name"]);
    $fileName = preg_replace("/[^a-zA-Z0-9.-_]/", "", $fileName);
    $target_file = $target_dir . $fileName;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["profileImage"]["tmp_name"]);
    
    // Check if the file is an actual image
    if ($check === false) {
        $errors['profileImage'] = "File is not an image.";
    }

    // Check file size (limit to 2MB)
    if ($_FILES["profileImage"]["size"] > 2000000) {
        $errors['profileImage'] = "Sorry, your file is too large. Maximum allowed size is 2MB.";
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ["jpg", "jpeg", "png"])) {
        $errors['profileImage'] = "Sorry, only JPG, JPEG, and PNG files are allowed.";
    }

    // Check if there were no errors and upload the file
    if (empty($errors['profileImage'])) {
        if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
            echo "File uploaded successfully: " . htmlspecialchars($target_file);
        } else {
            $errors['profileImage'] = "Sorry, there was an error uploading your file.";
        }
    }
} else {
    $errors['profileImage'] = "Profile image is required.";
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
        die("Connection failed: " . $conn->connect_error);
    }

    // Encrypt the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, dob, gender, profile_image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $hashed_password, $dob, $gender, $target_file);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to login.html after successful insertion
        echo "<script>alert('Form submitted successfully by $name!'); window.location.href='login.html';</script>";
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
        echo $error . "<br>";
    }
}
?>