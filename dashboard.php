<?php
session_set_cookie_params(0, '/', '', false, true);
session_start();
// Check if user is not logged in
if (!isset($_SESSION['user_name'])) {
    // Redirect to login page or display message
    echo "<script>
            alert('Please log in to continue.');
            window.location.href = 'login.html'; // Redirect to the login page
          </script>";
    exit(); // Stop further execution
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Layout</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style2.css">
    <style>
        .navbar {
            margin-bottom: 20px; 
        }

        .container-fluid {
            padding-top: 20px; 
        }

        .center-search {
            display: flex;
            justify-content: center;
        }

        .input-group {
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>

<body>
    <!-- Loading Spinner -->
    <div class="spinner-container">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
     </div>

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="center-search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search...">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link rounded-pill mr-3" href=""><i class="fas fa-bell"></i> Notifications</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link rounded-pill dropdown-toggle" href="" id="profileDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i>
                        <?php if (isset($_SESSION['user_name'])): ?>
                            <span class="ml-2"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                        <?php endif; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="">
    <?php
    if (isset($_SESSION['profile_image'])) {
        echo '<img src="' . $_SESSION['profile_image'] . '" alt="Profile Image" style="width: 40px; height: 30px; border-radius: 50%; margin-right: 10px;">';
    } else {
        echo '<img src="default-image.png" alt="Default Image" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px;">';
    }
    ?>
    Profile
</a>
                    <a class="dropdown-item" href=""><i class="fas fa-cog"></i> Settings</a>
                    <a class="dropdown-item" href="logout.php" style="color: red;"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Cards Section -->
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4 d-flex">
                <div class="card flex-fill" style="background: linear-gradient(to right, #f4c17f, #bbf762);">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-concierge-bell"></i> Services</h5>
                        <p class="card-text">Manage your services effectively and efficiently.</p>
                        <h6 class="card-info">Number of Services: 100</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4 d-flex">
                <div class="card flex-fill" style="background: linear-gradient(to right, #6fb7f6, #5bf2fa);">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-shopping-cart"></i> Orders</h5>
                        <p class="card-text">Keep track of all your orders in one place.</p>
                        <h6 class="card-info">Number of Orders: 200</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4 d-flex">
                <div class="card flex-fill" style="background: linear-gradient(to right, #72f19d, #73f3db);">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-users"></i> Customers</h5>
                        <p class="card-text">Manage your customer information and interactions.</p>
                        <h6 class="card-info">Number of Customers: 350</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4 d-flex">
                <div class="card flex-fill" style="background: linear-gradient(to right, #eef899, #f8a2e4);">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-chart-line"></i> Reports</h5>
                        <p class="card-text">Generate detailed reports and analytics.</p>
                        <h6 class="card-info">Number of Reports: 50</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="container-fluid">
    <div class="row">
        <!-- Notifications Section -->
        <div class="col-lg-4 col-md-12 col-sm-12 mb-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-bell"></i> Recent Activity</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><i class="fas fa-user-plus"></i> New user registered</li>
                        <li class="list-group-item"><i class="fas fa-shipping-fast"></i> Order #1234 has been shipped</li>
                        <li class="list-group-item"><i class="fas fa-comment-dots"></i> New feedback received</li>
                        <li class="list-group-item"><i class="fas fa-tools"></i> System maintenance scheduled</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- To-Do List Section -->
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-tasks"></i> To-Do List</h5>
                            <ul class="list-group" id="todo-list">
                                <li class="list-group-item">
                                    <input type="checkbox" class="mr-2"> Task 1
                                    <button class="btn btn-danger btn-sm float-right delete-task"><i class="fas fa-trash-alt"></i></button>
                                </li>
                                <li class="list-group-item">
                                    <input type="checkbox" class="mr-2"> Task 2
                                    <button class="btn btn-danger btn-sm float-right delete-task"><i class="fas fa-trash-alt"></i></button>
                                </li>
                                <li class="list-group-item">
                                    <input type="checkbox" class="mr-2"> Task 3
                                    <button class="btn btn-danger btn-sm float-right delete-task"><i class="fas fa-trash-alt"></i></button>
                                </li>
                                <li class="list-group-item">
                                    <input type="checkbox" class="mr-2"> Task 4
                                    <button class="btn btn-danger btn-sm float-right delete-task"><i class="fas fa-trash-alt"></i></button>
                                </li>
                            </ul>
                            <div class="input-group mt-3">
                                <input type="text" class="form-control" id="new-task" placeholder="Add new task">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" id="add-task"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

     <!-- Feedback Section -->
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-comments"></i> Feedback Reviews</h5>
                    <div class="testimonial-slider">
                        <div class="testimonial-card">
                            <p class="font-weight-bold">John Doe</p>
                            <p>"This is the best service I have ever used. Highly recommend to everyone!"</p>
                        </div>
                        <div class="testimonial-card">
                            <p class="font-weight-bold">Jane Smith</p>
                            <p>"Fantastic experience from start to finish. Exceptional quality!"</p>
                        </div>
                        <div class="testimonial-card">
                            <p class="font-weight-bold">Tim Cook</p>
                            <p>"A game-changer for our business. Outstanding results!"</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Line Graph -->
        <div class="col-lg-6 col-md-12 col-sm-12 mb-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-chart-line"></i> Current Sales</h5>
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
        <!-- Bar Graph -->
        <div class="col-lg-6 col-md-12 col-sm-12 mb-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-chart-bar"></i> Active Users</h5>
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Script JS/Jquery -->
    <script src="chart.js"></script>
    <script src="index2.js"></script>
</body>
</html>