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
                    <a class="nav-link rounded-pill mr-3" href="#"><i class="fas fa-bell"></i> Notifications</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link rounded-pill dropdown-toggle" href="#" id="profileDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i>
                        <?php if (isset($_SESSION['user_name'])): ?>
                            <span class="ml-2"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                        <?php endif; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href=""><i class="fas fa-cog"></i> Settings</a>
                        <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Cards Section -->
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Card 1</h5>
                        <p class="card-text">Some quick example text to build on the card title.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Card 2</h5>
                        <p class="card-text">Some quick example text to build on the card title.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Card 3</h5>
                        <p class="card-text">Some quick example text to build on the card title.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Card 4</h5>
                        <p class="card-text">Some quick example text to build on the card title.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Chart Section -->
            <div class="col-lg-8 col-md-12 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Feedback Section -->
            <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Feedback Reviews</h5>
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
            <!-- To-Do List Section -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">To-Do List</h5>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <input type="checkbox" class="mr-2"> Task 1
                            </li>
                            <li class="list-group-item">
                                <input type="checkbox" class="mr-2"> Task 2
                            </li>
                            <li class="list-group-item">
                                <input type="checkbox" class="mr-2"> Task 3
                            </li>
                            <li class="list-group-item">
                                <input type="checkbox" class="mr-2"> Task 4
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Another Section for Additional Content -->
            <div class="col-lg-8 col-md-6 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Additional Content</h5>
                        <p>Here you can add any additional content you need for your dashboard.</p>
                    </div>
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