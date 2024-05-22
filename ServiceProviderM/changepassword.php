<?php
include 'connection.php'; // Include your database connection file

session_start();
$user_id = $_SESSION['user_id']; // Get the user ID from the session
$userID = $_SESSION['userID']; // Get the user ID from the session
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
 //   $user_id = $_POST['user_id'];
    $oldpassword = mysqli_real_escape_string($con, $_POST['old_password']);
    $newpassword = mysqli_real_escape_string($con, $_POST['new_password']);

    if ($newpassword != $oldpassword) {
    // Update profile in the database
    $sql = "UPDATE service_p SET 
            password = '$newpassword'
            WHERE user_id = '$user_id'";
    }

    if (mysqli_query($con, $sql)) {
        echo "Password updated successfully";
        header("Location: settings.php"); 
        exit();
    } else {
        echo "Error updating Password: " . mysqli_error($con);
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
    <meta property="og:image" content="~/imgs/theme/logo.jpeg" />
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
            <div class="col-nav">
                <ul class="nav">

                    <li class="nav-item">
                        <a class="nav-link btn-icon darkmode" href="#"> <i class="material-icons md-nights_stay"></i> </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="requestfullscreen nav-link btn-icon"><i class="material-icons md-cast"></i></a>
                    </li>

                </ul>
            </div>
        </header>
        <section class="content-main mt-80 mb-80">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 m-auto text-center">
                </div>
            </div>
            <div class="card mx-auto card-login">
                <div class="card-body">
                    <h4 class="card-title mb-4">Change Password</h4>
                    <form method="post">
                    <div class="mb-3">
                            <input class="form-control" name="old_password" value="" placeholder="Old Password" type="password" />
                        </div>
                        <div class="mb-3">
                            <input class="form-control" name="new_password" value="" placeholder="New Password" type="password" />
                        </div>

                       

                        <div class="mb-4">
                            <button type="submit" style="padding-left: 124px;" class="btn btn-primary w-100" href="login.html">Change Password</button>
                        </div>

                    </form>
                    <div class="d-grid gap-3 mb-4">
                        

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
