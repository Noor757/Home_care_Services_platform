<?php
session_start();
include("connection.php");
include("functions.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Example validation (replace with actual validation logic)
    $query = "SELECT * FROM service_p WHERE email = '$email' AND password = '$password' LIMIT 1";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user_data['user_id'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid email or password";
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
<h4 class="card-title mb-4">Sign in</h4>
<form method="post" >
<input type="hidden" name="csrfmiddlewaretoken" value="Y2HLoEfwBQFYzPwnqM4zfJPy29DOH8g8Fx1sduGdom4Jf0roeAdvmBTd5CBbgHJr">
<div class="mb-3">
<input class="form-control" name="email"  placeholder=" email" type="text" />
</div>

<div class="mb-3">
<input class="form-control" name="password" placeholder="Password" type="password" />
</div>

<div class="mb-3">
                          
<label class="form-check">
<input type="checkbox" class="form-check-input" checked />
<span class="form-check-label">Remember</span>
</label>
</div>

<div class="mb-4">
        <input id="button" type="submit" style="padding-left: 124px;" class="btn btn-primary w-100" value = "Login">
</div>

</form>
<?php if (isset($error)) echo "<p>$error</p>"; ?>
                    <div class="d-grid gap-3 mb-4">
                      
                    </div>
                    <p class="text-center mb-4">Don't have account? <a href="register.php">Sign up</a></p>
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