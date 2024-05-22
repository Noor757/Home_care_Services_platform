<?php
include 'connection.php'; // Include your database connection file

session_start();
$user_id = $_SESSION['user_id']; // Get the user ID from the session
$userID = $_SESSION['userID'];
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Retrieve form data
 //   $user_id = $_POST['user_id'];
    $user_name = mysqli_real_escape_string($con, $_POST['user_name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $mobile_number = mysqli_real_escape_string($con, $_POST['mobile_number']);
    $Location = mysqli_real_escape_string($con, $_POST['Location']);

    // Update profile in the database
    $sql = "UPDATE service_p SET 
            user_name = '$user_name',
            email = '$email',
            mobile_number = '$mobile_number',
            Location = '$Location'
            WHERE user_id = '$user_id'";

    if (mysqli_query($con, $sql)) {
        echo "Profile updated successfully";
        header("Location: settings.php"); 
        exit();
    } else {
        echo "Error updating Profile: " . mysqli_error($con);
    }
}


// Delete profile from the database
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
 //   $serviceId = $_POST['service_id'];

    $sql = "DELETE FROM service_p WHERE user_id='$user_id'";

    if ($con->query($sql) === TRUE) {
        echo "Profile deleted successfully.";
        header("Location: login.php"); 
        exit();
    } else {
        echo "Error deleting profile: " . $con->error;
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>CareSwift</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <link rel="shortcut icon" type="image/x-icon" href="imgs/theme/logo.jpeg" />
    <link href="css/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="screen-overlay"></div>
    <aside class="navbar-aside" id="offcanvas_aside">
        <div class="aside-top">
            <a class="brand-wrap">
                <img src="imgs/theme/logo.jpeg" class="logo" alt="CareSwift" />
            </a>
            <div>
                <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i></button>
            </div>
        </div>
        <nav>
            <ul class="menu-aside">
                <li class="menu-item ">
                    <a class="menu-link" href="dashboard.php">
                        <i class="icon material-icons md-home"></i>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <li class="menu-item ">
                    <a class="menu-link" href="services.php">
                        <i class="icon material-icons md-shopping_bag"></i>
                        <span class="text">Services</span>
                    </a>

                </li>
                <li>
                    
                </li>

                <li class="menu-item">
                    <a class="menu-link" href="reviews.php">
                        <i class="icon material-icons md-comment"></i>
                        <span class="text">Reviews</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="settings.php">
                        <i class="icon material-icons md-comment"></i>
                        <span class="text">Settings</span>
                    </a>
                </li>

            </ul>
           
            <br />
            <br />
        </nav>
    </aside>
    <main class="main-wrap">
        <header class="main-header navbar">
            <div class="col-search">
                <form class="searchform">
                    <div class="input-group">
                        <input list="search_terms" type="text" class="form-control" placeholder="Search term" />
                        <button class="btn btn-light bg" type="button"><i class="material-icons md-search"></i></button>
                    </div>
                    <datalist id="search_terms">
                        <option value="Services"></option>
                        <option value="New Requests"></option>
                        <option value="Settings"></option>

                    </datalist>
                </form>
            </div>
            <div class="col-nav">
                <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"><i class="material-icons md-apps"></i></button>
                <ul class="nav">
                   
                    <li class="nav-item">
                        <a class="nav-link btn-icon darkmode" href="#"> <i class="material-icons md-nights_stay"></i> </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="requestfullscreen nav-link btn-icon"><i class="material-icons md-cast"></i></a>
                    </li>
                   
                    <li class="dropdown nav-item">
                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false"> <img class="img-xs rounded-circle" src="imgs/people/avatar-2.png" alt="User" /></a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                            
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="login.php"><i class="material-icons md-exit_to_app"></i>Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </header>
        <section class="content-main">
            <div class="content-header">
                <div>
                    <h2 class="content-title card-title">Profile Settings</h2>
                  
                <div class="card">
                    <div class="card-body">
                        <div class="row gx-5">
                           
                            <div class="col-lg-9">
                                <section class="content-body p-xl-4">
                                    <form id="update-form" method="POST">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="row gx-3">
                                               
                                                    <div class="col-6 mb-3">
                                                        <label class="form-label">Name</label>
                                                        <input class="form-control" type="text" name="user_name" placeholder="Type here" />
                                                    </div>
                                                    <!-- col .// -->
                                                    
                                                    <!-- col .// -->
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Email</label>
                                                        <input class="form-control" type="email" name="email" placeholder="example@mail.com" />
                                                    </div>
                                                    <!-- col .// -->
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Phone</label>
                                                        <input class="form-control" type="tel" name="mobile_number" placeholder="+1234567890" />
                                                    </div>
                                                    <!-- col .// -->
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Location</label>
                                                        <input class="form-control" type="text" name="Location" placeholder="Type here" />
                                                    </div>
                                                    <!-- col .// -->
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Birthday</label>
                                                        <input class="form-control" type="date" />
                                                    </div>
                                                    <!-- col .// -->
                                                </div>
                                                <!-- row.// -->
                                            </div>
                                            <!-- col.// -->
                                         
                                            <!-- col.// -->
                                        </div>
                                        <!-- row.// -->
                                        <br />
                                        <div class="mb-4">
                            <button type="submit" name="update" class="btn btn-primary">Save Changes</button>
                        </div>
                                    </form>
                                    <hr class="my-5" />
                                    <div class="row" style="max-width: 920px">
                                        <div class="col-md">
                                            <article class="box mb-3 bg-light">
                                                <a class="btn float-end btn-light btn-sm rounded font-md" href="changepassword.php">Change</a>
                                                <h6>Password</h6>
                                                <small class="text-muted d-block" style="width: 70%">You can reset or change your password by clicking here</small>
                                            </article>
                                        </div>
                                        <!-- col.// -->
                                        <div class="col-md">
                                            <article class="box mb-3 bg-light">
                                            <form id="delete-form" method="POST">
                              
                                <button type="submit" name="delete" class="btn float-end btn btn-sm font-sm btn-light rounded">Deactivate</button>
                            </form>
                                               
                               
                                                <h6>Remove account</h6>
                                                <small class="text-muted d-block" style="width: 70%">Once you delete your account, there is no going back.</small>
                                            </article>
                                        </div>
                                        <!-- col.// -->
                                    </div>
                                    <!-- row.// -->
                                </section>
                                <!-- content-body .// -->
                            </div>
                            <!-- col.// -->
                        </div>
                        <!-- row.// -->
                    </div>
                    <!-- card body end// -->
                </div>
                <!-- card end// -->
        </section>
        <!-- content-main end// -->
        <footer class="main-footer font-xs">
            <div class="row pb-30 pt-15">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    &copy; CareSwift - A Swift Path to Better Health .
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end">All rights reserved</div>
                </div>
            </div>
        </footer>
    </main>
    <script src="js/vendors/jquery-3.6.0.min.js"></script>
    <script src="js/vendors/bootstrap.bundle.min.js"></script>
    <script src="js/vendors/select2.min.js"></script>
    <script src="js/vendors/perfect-scrollbar.js"></script>
    <script src="js/vendors/jquery.fullscreen.min.js"></script>
    <script src="js/vendors/chart.js"></script>
    <!-- Main Script -->
    <script src="js/main.js" type="text/javascript"></script>
    <script src="js/custom-chart.js" type="text/javascript"></script>
   
</body>
</html>