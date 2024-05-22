<?php
session_start();
include("connection.php");
include("functions.php");

// Check if the session variable is set
if (!isset($_SESSION['user_id']) || !isset($_SESSION['userID']) ) {
    // Handle the case where the user is not logged in (redirect or show an error)
    die("User not logged in.");
}
$userID = $_SESSION['userID'];
$user_id = $_SESSION['user_id']; // Assuming the user ID is stored in the session


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $orderID = $_POST['order_id'];
  

    // Update service in the database
    $sql = "UPDATE orders SET 
            order_status = 'Accepted'
            WHERE order_id = '$orderID'";
    if (mysqli_query($con, $sql)) {
        echo "Status updated successfully";
        header("Location: dashboard.php"); // Redirect to services.php after update
        exit();
    } else {
        echo "Error updating status: " . mysqli_error($con);
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
                <li class="menu-item active">
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
                    <h2 class="content-title card-title">Dashboard</h2>
                    <p>View you whole bookings here</p>
                </div>
                <div>
                    <a href="#" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Create report</a>
                </div>
            </div>
           
            <?php

        $sql = "SELECT  experience, bookings, services_count, monthly_earning
        FROM service_p
        WHERE user_id = ?";

if ($stmt = $con->prepare($sql)) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($experience, $bookings, $services_count, $monthly_earning);

    while ($stmt->fetch()) {
        echo ' <div class="row">

                <div class="col-lg-3">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-primary material-icons md-monetization_on"></i></span>
                            <div class="text">
                                <h6 class="mb-1 card-title">Experience</h6>
                                <span>' . htmlspecialchars($experience) . '</span>
                                <span class="text-sm">Since you got your first order </span>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <span class="icon icon-sm rounded-circle bg-success-light"><i class="text-success material-icons md-local_shipping"></i></span>
                            <div class="text">
                                <h6 class="mb-1 card-title">Bookings</h6>
                                <span>' . htmlspecialchars($bookings) . '</span>
                                <span class="text-sm"> Excluding pending bookings </span>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <span class="icon icon-sm rounded-circle bg-warning-light"><i class="text-warning material-icons md-qr_code"></i></span>
                            <div class="text">
                                <h6 class="mb-1 card-title">Services</h6>
                                <span>' . htmlspecialchars($services_count) . '</span>
                                <span class="text-sm"> In 10 Services </span>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info material-icons md-shopping_basket"></i></span>
                            <div class="text">
                                <h6 class="mb-1 card-title">Monthly Earning</h6>
                                <span>' . htmlspecialchars($monthly_earning) . '</span>
                                <span class="text-sm"> Based in your local time. </span>
                            </div>
                        </article>
                    </div>
                </div>
            </div>';
        }
    //    $stmt->close();
    } else {
        echo "Error: " . $con->error;
    }

   // $con->close();
    ?>
            <div class="row">
                <div class="col-xl-8 col-lg-12">
                    <div class="card mb-4">
                        <article class="card-body">
                            <h5 class="card-title">Sale statistics</h5>
                            <img src="imgs/theme/chart1.PNG" alt="stats" height="120px" />
                        </article>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="card mb-4">


                            <?php
                    
                    $sql = "SELECT  order_id, service_name, total_price, order_status
                            FROM orders";
                            
                   // $row_count = mysqli_num_rows($con->query("$sql"));
                    if ($stmt = $con->prepare($sql)) {
                      //  $stmt->bind_param("i", $user_id);
                        $stmt->execute();
                        $stmt->bind_result($order_id, $order_name, $total_price, $order_status);

                        while ($stmt->fetch()) {
                            echo '<article class="card-body">
                                    <h5 class="card-title">New Requests</h5>
                                    <div class="new-member-list">
                                        <div class="d-flex align-items-center justify-content-between mb-4">
                                            <div class="d-flex align-items-center">
                                                <img src="imgs/people/avatar-4.png" alt="" class="avatar" />
                                                <div>
                                                    <h6>' . htmlspecialchars($order_name) . '</h6>
                                                    <p class="text-muted font-xs">' . htmlspecialchars($total_price) . '</p>
                                                    <p class="text-muted font-xs">' . htmlspecialchars($order_status) . '</p>
                                                </div>
                                            </div>
                                            <form id="delete-form" method="post">
                                <input type="hidden" name="order_id" value=' . htmlspecialchars($order_id) . '>
                                <button type="submit" name="delete" class="btn btn-sm font-sm btn-light rounded">
                                   Accept
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
                        </div>
                        <div class="col-lg-7">
                            <div class="card mb-4">
                                <article class="card-body">
                                    <h5 class="card-title">Recent activities</h5>
                                    <ul class="verti-timeline list-unstyled font-sm">
                                        <li class="event-list">
                                            <div class="event-timeline-dot">
                                                <i class="material-icons md-play_circle_outline font-xxl"></i>
                                            </div>
                                            <div class="media">
                                                <div class="me-3">
                                                    <h6><span>Today</span> <i class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i></h6>
                                                </div>
                                                <div class="media-body">
                                                    <div>As a babysitter</div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="event-list active">
                                            <div class="event-timeline-dot">
                                                <i class="material-icons md-play_circle_outline font-xxl animation-fade-right"></i>
                                            </div>
                                            <div class="media">
                                                <div class="me-3">
                                                    <h6><span>17 May</span> <i class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i></h6>
                                                </div>
                                                <div class="media-body">
                                                    <div>Completed my service no 200th.</div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="event-list">
                                            <div class="event-timeline-dot">
                                                <i class="material-icons md-play_circle_outline font-xxl"></i>
                                            </div>
                                            <div class="media">
                                                <div class="me-3">
                                                    <h6><span>13 May</span> <i class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i></h6>
                                                </div>
                                                <div class="media-body">
                                                    <div>Started my service no 200th.</div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="event-list">
                                            <div class="event-timeline-dot">
                                                <i class="material-icons md-play_circle_outline font-xxl"></i>
                                            </div>
                                            <div class="media">
                                                <div class="me-3">
                                                    <h6><span>05 April</span> <i class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i></h6>
                                                </div>
                                                <div class="media-body">
                                                    <div>Came back after a break.</div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="event-list">
                                            <div class="event-timeline-dot">
                                                <i class="material-icons md-play_circle_outline font-xxl"></i>
                                            </div>
                                            <div class="media">
                                                <div class="me-3">
                                                    <h6><span>26 Mar</span> <i class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i></h6>
                                                </div>
                                                <div class="media-body">
                                                    <div>Added a new service.</div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-12">
                    <div class="card mb-4">
                        <article class="card-body">
                            <h5 class="card-title">Services based on Area</h5>
                            <img src="imgs/theme/chart2.PNG" alt="stats" height="217" />
                        </article>
                    </div>
                    <div class="card mb-4">
                        <article class="card-body">
                            <h5 class="card-title">Marketing Chanel</h5>
                            <span class="text-muted font-xs">Facebook</span>
                            <div class="progress mb-3">
                                <div class="progress-bar" role="progressbar" style="width: 15%">15%</div>
                            </div>
                            <span class="text-muted font-xs">Instagram</span>
                            <div class="progress mb-3">
                                <div class="progress-bar" role="progressbar" style="width: 65%">65%</div>
                            </div>
                            <span class="text-muted font-xs">Google</span>
                            <div class="progress mb-3">
                                <div class="progress-bar" role="progressbar" style="width: 51%">51%</div>
                            </div>
                            <span class="text-muted font-xs">Twitter</span>
                            <div class="progress mb-3">
                                <div class="progress-bar" role="progressbar" style="width: 80%">80%</div>
                            </div>
                            <span class="text-muted font-xs">Other</span>
                            <div class="progress mb-3">
                                <div class="progress-bar" role="progressbar" style="width: 80%">80%</div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <header class="card-header">
                    <h4 class="card-title">Latest orders</h4>
                    <div class="row align-items-center">
                        <div class="col-md-3 col-12 me-auto mb-md-0 mb-3">
                           
                        </div>
                     
                        <div class="col-md-2 col-6">
                            <div class="custom_select">
                                <select class="form-select select-nice">
                                    <option selected>Status</option>
                                    <option>All</option>
                                    <option>Paid</option>
                                    <option>Pending</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="text-center">
                                            <div class="form-check align-middle">
                                                <input class="form-check-input" type="checkbox" id="transactionCheck01" />
                                                <label class="form-check-label" for="transactionCheck01"></label>
                                            </div>
                                        </th>
                                        <th class="align-middle" scope="col">Order ID</th>
                                        <th class="align-middle" scope="col">Customer Name</th>
                                        <th class="align-middle" scope="col">Date</th>
                                        <th class="align-middle" scope="col">Total</th>
                                        <th class="align-middle" scope="col">Payment Status</th>
                                        <th class="align-middle" scope="col">Payment Method</th>
                                        <th class="align-middle" scope="col">View Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="transactionCheck02" />
                                                <label class="form-check-label" for="transactionCheck02"></label>
                                            </div>
                                        </td>
                                        <td><a href="#" class="fw-bold">#SK2540</a></td>
                                        <td>Neal Matthews</td>
                                        <td>07 Oct, 2021</td>
                                        <td>$400</td>
                                        <td>
                                            <span class="badge badge-pill badge-soft-success">Paid</span>
                                        </td>
                                        <td><i class="material-icons md-payment font-xxl text-muted mr-5"></i> Mastercard</td>
                                        <td>
                                            <a href="#" class="btn btn-xs"> View details</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="transactionCheck03" />
                                                <label class="form-check-label" for="transactionCheck03"></label>
                                            </div>
                                        </td>
                                        <td><a href="#" class="fw-bold">#SK2541</a></td>
                                        <td>Jamal Burnett</td>
                                        <td>07 Oct, 2021</td>
                                        <td>$380</td>
                                        <td>
                                            <span class="badge badge-pill badge-soft-danger">Pending</span>
                                        </td>
                                        <td><i class="material-icons md-payment font-xxl text-muted mr-5"></i> Visa</td>
                                        <td>
                                            <a href="#" class="btn btn-xs"> View details</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="transactionCheck04" />
                                                <label class="form-check-label" for="transactionCheck04"></label>
                                            </div>
                                        </td>
                                        <td><a href="#" class="fw-bold">#SK2542</a></td>
                                        <td>Juan Mitchell</td>
                                        <td>06 Oct, 2021</td>
                                        <td>$384</td>
                                        <td>
                                            <span class="badge badge-pill badge-soft-success">Paid</span>
                                        </td>
                                        <td><i class="material-icons md-payment font-xxl text-muted mr-5"></i> Paypal</td>
                                        <td>
                                            <a href="#" class="btn btn-xs"> View details</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="transactionCheck05" />
                                                <label class="form-check-label" for="transactionCheck05"></label>
                                            </div>
                                        </td>
                                        <td><a href="#" class="fw-bold">#SK2543</a></td>
                                        <td>Barry Dick</td>
                                        <td>05 Oct, 2021</td>
                                        <td>$412</td>
                                        <td>
                                            <span class="badge badge-pill badge-soft-success">Paid</span>
                                        </td>
                                        <td><i class="material-icons md-payment font-xxl text-muted mr-5"></i> Mastercard</td>
                                        <td>
                                            <a href="#" class="btn btn-xs"> View details</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="transactionCheck06" />
                                                <label class="form-check-label" for="transactionCheck06"></label>
                                            </div>
                                        </td>
                                        <td><a href="#" class="fw-bold">#SK2544</a></td>
                                        <td>Ronald Taylor</td>
                                        <td>04 Oct, 2021</td>
                                        <td>$404</td>
                                        <td>
                                            <span class="badge badge-pill badge-soft-warning">Refund</span>
                                        </td>
                                        <td><i class="material-icons md-payment font-xxl text-muted mr-5"></i> Visa</td>
                                        <td>
                                            <a href="#" class="btn btn-xs"> View details</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="transactionCheck07" />
                                                <label class="form-check-label" for="transactionCheck07"></label>
                                            </div>
                                        </td>
                                        <td><a href="#" class="fw-bold">#SK2545</a></td>
                                        <td>Jacob Hunter</td>
                                        <td>04 Oct, 2021</td>
                                        <td>$392</td>
                                        <td>
                                            <span class="badge badge-pill badge-soft-success">Paid</span>
                                        </td>
                                        <td><i class="material-icons md-payment font-xxl text-muted mr-5"></i> Paypal</td>
                                        <td>
                                            <a href="#" class="btn btn-xs"> View details</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- table-responsive end// -->
                </div>
            </div>
            <div class="pagination-area mt-30 mb-50">
                <nav aria-label="Page navigation example">
                  
                </nav>
            </div>
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