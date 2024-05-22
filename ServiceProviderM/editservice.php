<?php
include 'connection.php'; // Include your database connection file

session_start();
$user_id = $_SESSION['user_id']; // Get the user ID from the session

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $service_id = $_POST['service_id'];
    $price = mysqli_real_escape_string($con, $_POST['service_price']);
    $status = mysqli_real_escape_string($con, $_POST['service_status']);
    $location = mysqli_real_escape_string($con, $_POST['service_location']);

    // Update service in the database
    $sql = "UPDATE all_services SET 
            service_price = '$price',
            service_status = '$status',
            service_location = '$location'
            WHERE service_id = '$service_id'";

    if (mysqli_query($con, $sql)) {
        echo "Service updated successfully";
        header("Location: services.php"); // Redirect to services.php after update
        exit();
    } else {
        echo "Error updating service: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>CareSwift</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="We provide all homecare services." />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en-us" />
    <meta property="og:title" content="CareSwift - A Swift Path to better Health" />
    <meta property="og:site_name" content="CareSwift" />
    <meta property="og:description" content="We provide all homecare services." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://nest.apexcode.info/" />
    <meta property="og:image" content="imgs/theme/logo.jpeg" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="CareSwift" />
    <meta name="twitter:description" content="We provide all homecare services." />

    <link rel="shortcut icon" type="image/x-icon" href="imgs/theme/logo.jpeg" />
    <link href="css/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <main>
        <header class="main-header style-2 navbar">
            <div class="col-brand">
                <a href="/" class="brand-wrap">
                    <img src="imgs/theme/logo.jpeg" class="logo" alt="CareSwift" />
                </a>
            </div>
            <!-- Navbar omitted for brevity -->
        </header>
        <section class="content-main mt-80 mb-80">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 m-auto text-center">
                </div>
            </div>
            <div class="card mx-auto card-login">
                <div class="card-body">
                    <h4 class="card-title mb-4">Edit Service</h4>
                    <form method="post">
                        <!-- Include service ID for identification -->
                        <input class="form-control"  name="service_id" placeholder="Service id" type="text" required />
                      
                        <div class="mb-3">
                            <input class="form-control" name="service_price" placeholder="Price" type="text" required />
                        </div>
                        <div class="mb-3">
                            <input class="form-control" name="service_location" placeholder="Location" type="text"  required />
                        </div>
                        <div class="mb-3">
                            <input class="form-control" name="service_status" placeholder="Status" type="text"  required />
                        </div>
                      
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <footer class="main-footer text-center">
            <p class="font-xs">
                <script>
                    document.write(new Date().getFullYear());
                </script>
                &copy; CareSwift - All rights reserved.
            </p>
        </footer>
    </main>
    <script src="js/vendors/jquery-3.6.0.min.js"></script>
    <script src="js/vendors/bootstrap.bundle.min.js"></script>
    <script src="js/vendors/jquery.fullscreen.min.js"></script>
    <!-- Main Script -->
    <script src="js/main.js" type="text/javascript"></script>
</body>
</html>
