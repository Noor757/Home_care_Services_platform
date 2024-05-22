<?php
// Always start the session at the top of the script before any output
session_start();
include 'connection.php';

// Check if the session variable is set
if (!isset($_SESSION['user_id']) || !isset($_SESSION['userID'])) {
    // Handle the case where the user is not logged in (redirect or show an error)
    die("User not logged in.");
}
$userID = $_SESSION["userID"];
$user_id = $_SESSION['user_id']; // Assuming the user ID is stored in the session


// Delete service from the database
if (isset($_POST['delete'])) {
    $serviceId = $_POST['service_id'];

    $sql = "DELETE FROM userservices WHERE service_id='$serviceId'";

    if ($con->query($sql) === TRUE) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $con->error;
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
<style>
    .action-buttons {
    display: flex;
    gap: 10px; /* Adjust spacing as needed */
}
</style>
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
                <li class="menu-item active">
                    <a class="menu-link" href="services.php">
                        <i class="icon material-icons md-shopping_bag"></i>
                        <span class="text">Services</span>
                    </a>
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
                <br />
                <br />
            </ul>
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
                    <h2 class="content-title card-title">Services List</h2>
                    <p>Manage your services.</p>
                </div>
                <div>
                    <a href="newservice.php" class="btn btn-primary btn-sm rounded">Create new</a>
                </div>
            </div>
            <div class="card mb-4">
                <header class="card-header">
                    <div class="row align-items-center">
                        <div class="col col-check flex-grow-0">
                            
                        </div>
                       
                        <form action="" method="get">
    <div class="col-md-2 col-6">
        <select class="form-select" name="status" onchange="this.form.submit()">
            <option value="" selected>Status</option>
            <option value="Active">Active</option>
            <option value="Disabled">Disabled</option>
            <option value="Archived">Archived</option>
            <option value="Show all">Show all</option>
        </select>
    </div>
</form>

                    </div>
                </header>
                <!-- card-header end// -->
                <div class="card-body">
                    <?php
                    
                    $sql = "SELECT  all_services.service_id, all_services.service_name, all_services.service_price, all_services.service_status, all_services.service_description, all_services.service_location
                            FROM userservices
                            JOIN service_p ON userservices.user_id = service_p.user_id
                            JOIN all_services ON userservices.service_id = all_services.service_id
                            WHERE userservices.user_id = ?";
                   // $row_count = mysqli_num_rows($con->query("$sql"));
                    if ($stmt = $con->prepare($sql)) {
                        $stmt->bind_param("i", $user_id);
                        $stmt->execute();
                        $stmt->bind_result($service_id, $service_name, $service_price, $service_status, $service_description, $service_location);

                        while ($stmt->fetch()) {
                            echo '<article class="itemlist">
                          
                        <div class="row align-items-center">
                          
                            <div class="col-lg-4 col-sm-4 col-8 flex-grow-1 col-name">
                                <a class="itemside" href="#">
                                <div class="col-lg-1 col-sm-2 col-4 col-price">  <span>' . htmlspecialchars($service_id) . '</span></div>
                                    <div class="info">
                                    <h6 class="mb-0">' . htmlspecialchars($service_name) . '</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-1 col-sm-2 col-4 col-price">  <span>' . htmlspecialchars($service_price) . '</span></div>
                            <div class="col-lg-1 col-sm-2 col-4 col-status">
                            <span>' . htmlspecialchars($service_status) . '</span>
                            </div>
                            <div class="col-lg-1 col-sm-2 col-4 col-loc">
                            <span>' . htmlspecialchars($service_location) . '</span>
                            </div>
                            <div class="col-lg-4 col-sm-2 col-4 col-loc">
                            <span>' . htmlspecialchars($service_description) . '</span>
                            </div>
                            <div class="action-buttons">
                            <a href="editservice.php" class="btn btn-sm font-sm rounded btn-brand">
                                <i class="material-icons md-edit"></i> Edit
                            </a>
                            <form id="delete-form" method="post">
                                <input type="hidden" name="service_id" value=' . htmlspecialchars($service_id) . '>
                                <button type="submit" name="delete" class="btn btn-sm font-sm btn-light rounded">
                                    <i class="material-icons md-delete_forever"></i> Delete
                                </button>
                            </form>
                        </div>
                        
                        </div>   
                                </article>';
                        }
                        $stmt->close();
                    } else {
                        echo "Error: " . $con->error;
                    }

                    $con->close();
                    ?>
                </div>
                <!-- card-body end// -->
            </div>
            <!-- card end// -->
        </section>
    </main>
    <script src="js/vendors/jquery-3.6.0.min.js"></script>
    <script src="js/vendors/bootstrap.bundle.min.js"></script>
    <script src="js/vendors/select2.min.js"></script>
    <script src="js/vendors/perfect-scrollbar.js"></script>
    <script src="js/vendors/jquery.fullscreen.min.js"></script>
    <script src="js/main.js?v=1.0" type="text/javascript"></script>
</body>
</html>
