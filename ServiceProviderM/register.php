<?php
session_start();
include("connection.php");
include("functions.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mobilenumber = $_POST['mobile_number'];
    $confirm_password = $_POST['confirm_password'];
    $location = $_POST['location'];

    // Simple validation
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password) || empty($mobilenumber) || empty($location)) {
        $error = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Hash the password
     //   $hashed_password = password_hash($password, PASSWORD_DEFAULT);
     $hashed_password = $password;

        // Check if username or email already exists
        $query = "SELECT * FROM service_p WHERE user_name = '$username' OR email = '$email' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $error = "Username or email already exists.";
        } else {
            $userid = random_int(1,100);
            // Insert new user into the database
            $query = "INSERT INTO service_p (user_id, user_name, password, email, mobile_number, location) VALUES ('$userid', '$username', '$hashed_password',  '$email', '$mobilenumber', '$location')";
            if (mysqli_query($con, $query)) {
                $_SESSION['user_id'] = mysqli_insert_id($con);
                header("Location: dashboard.php");
                exit;
            } else {
                $error = "Error: " . mysqli_error($con);
            }
        }
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
<h4 class="card-title mb-4">Create an Account</h4>
<form method="post">
<input type="hidden" name="csrfmiddlewaretoken" value="0ADj76FFRqL2skoCZ0gPjcF3DnOH7gjcH5X0WW6mEWaN8vjDNOpLq4JIGQM4GPMv">
<div class="mb-3">
<label class="form-label">Username</label>
<input id="user_name" class="form-control" placeholder="Your Username" name="user_name" maxlength="149" type="text" required />
<small id="hint_id_username" class="form-text text-muted">usernames can't contain spaces, only letters and numbers.</small>
</div>
<div class="mb-3">
<label class="form-label">Email</label>
<input id = "email" class="form-control" placeholder="Your email" name="email" type="text" required />
</div>

<div class="mb-3">
<label class="form-label">Phone</label>
<div class="row gx-2">

<div class="col-12"><input id="mobile_number" class="form-control" placeholder="Phone" name="mobile_number" type="number" required /></div>
</div>
</div>
<div class="mb-3">
<label class="form-label">Location</label>
<input id="location" class="form-control" placeholder="Location" name="location" type="text" required />
</div>

<div class="mb-3">
<label class="form-label">Create password</label>
<input id="password" class="form-control" placeholder="Password" name="password" type="password" required />
</div>

<div class="mb-3">
<label class="form-label">Confirm password</label>
<input id="confirm_password" class="form-control" placeholder="Password" name="confirm_password" type="password" required />
</div>

<div class="mb-3">
<p class="small text-center text-muted">By signing up, you confirm that you’ve read and accepted our User Notice and Privacy Policy.</p>
</div>

<div class="mb-4">
        <input id="Button" type="submit" class="btn btn-primary w-100" style="padding-left: 124px;" value ="Register">
</div>

</form>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
                    <p class="text-center mb-2">Already have an account? <a href="login.php">Sign in now</a></p>
</div>
</div>
</section>
<footer class="main-footer text-center">
<p class="font-xs">
<script>
                        document.write(new Date().getFullYear());
                    </script>
&copy; CareSwift - All rights reserved .
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