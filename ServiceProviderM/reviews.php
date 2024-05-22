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

               
                <li class="menu-item active">
                    <a class="menu-link" href="reviews.php">
                        <i class="icon material-icons md-comment"></i>
                        <span class="text">Reviews</span>
                    </a>
                </li>
                <li class="menu-item ">
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
                    <h2 class="content-title card-title">Reviews</h2>

                    <p>See what customers say about you.</p>
                </div>
                <div>
                    <input type="text" placeholder="Search by name" class="form-control bg-white" />
                </div>
            </div>
            <div class="card mb-4">
                <header class="card-header">
                    <div class="row gx-3">
                      
                        <div class="col-lg-2 col-md-3 col-6">
                            <select class="form-select">
                                <option>Booked Service</option>
                                <option>Nanny</option>
                                <option>Gardener</option>
                                <option>Carpenter</option>
                                <option>Show all</option>
                            </select>
                        </div>
                       
                    </div>
                </header>
                <!-- card-header end// -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        
                                    </th>
                                    <th>#ID</th>
                                    <th>Booked Service</th>
                                    <th>Name</th>
                                    <th>Rating</th>
                                    <th>Date</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                      
                                    </td>
                                    <td>23</td>
                                    <td><b>Nanny</b></td>
                                    <td>Devon Lane</td>
                                    <td>
                                        <ul class="rating-stars">
                                            <li style="width: 60%" class="stars-active">
                                                <img src="imgs/icons/stars-active.svg" alt="stars" />
                                            </li>
                                            <li>
                                                <img src="imgs/icons/starts-disable.svg" alt="stars" />
                                            </li>
                                        </ul>
                                    </td>
                                    <td>10.03.2020</td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-md rounded font-sm">Detail</a>
                                       
                                        <!-- dropdown //end -->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                     
                                    </td>
                                    <td>24</td>
                                    <td><b>Mechanic</b></td>
                                    <td>Guy Hawkins</td>
                                    <td>
                                        <ul class="rating-stars">
                                            <li style="width: 80%" class="stars-active">
                                                <img src="imgs/icons/stars-active.svg" alt="stars" />
                                            </li>
                                            <li>
                                                <img src="imgs/icons/starts-disable.svg" alt="stars" />
                                            </li>
                                        </ul>
                                    </td>
                                    <td>04.12.2019</td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-md rounded font-sm">Detail</a>
                                       
                                        <!-- dropdown //end -->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                       
                                    </td>
                                    <td>25</td>
                                    <td><b>Electrician</b></td>
                                    <td>Steven John</td>
                                    <td>
                                        <ul class="rating-stars">
                                            <li style="width: 90%" class="stars-active">
                                                <img src="imgs/icons/stars-active.svg" alt="stars" />
                                            </li>
                                            <li>
                                                <img src="imgs/icons/starts-disable.svg" alt="stars" />
                                            </li>
                                        </ul>
                                    </td>
                                    <td>25.05.2020</td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-md rounded font-sm">Detail</a>
                                        
                                        <!-- dropdown //end -->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                       
                                    </td>
                                    <td>26</td>
                                    <td><b>Gardener</b></td>
                                    <td>Kristin Watson</td>
                                    <td>
                                        <ul class="rating-stars">
                                            <li style="width: 90%" class="stars-active">
                                                <img src="imgs/icons/stars-active.svg" alt="stars" />
                                            </li>
                                            <li>
                                                <img src="imgs/icons/starts-disable.svg" alt="stars" />
                                            </li>
                                        </ul>
                                    </td>
                                    <td>01.06.2020</td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-md rounded font-sm">Detail</a>
                                      
                                        <!-- dropdown //end -->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                      
                                    </td>
                                    <td>27</td>
                                    <td><b>Full House Cleaner</b></td>
                                    <td>Jane Cooper</td>
                                    <td>
                                        <ul class="rating-stars">
                                            <li style="width: 100%" class="stars-active">
                                                <img src="imgs/icons/stars-active.svg" alt="stars" />
                                            </li>
                                            <li>
                                                <img src="imgs/icons/starts-disable.svg" alt="stars" />
                                            </li>
                                        </ul>
                                    </td>
                                    <td>13.03.2020</td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-md rounded font-sm">Detail</a>
                                      
                                        <!-- dropdown //end -->
                                    </td>
                                </tr>
                             
                            </tbody>
                        </table>
                    </div>
                    <!-- table-responsive//end -->
                </div>
                <!-- card-body end// -->
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