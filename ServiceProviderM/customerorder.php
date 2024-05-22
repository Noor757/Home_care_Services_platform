<?php
include 'connection.php'; // Include your database connection file

session_start();

$customer_id = $_SESSION['userID']; // Get the customer ID from the session
$provider_id = $_SESSION['user_id']; // Get the provider ID from the session

// Fetch available services from the database
$sql = "SELECT service_id, service_name 
        FROM all_services"; 
$result = $con->query($sql);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['service_id']) && isset($_POST['payment_method'])) {
        $service_id = $_POST['service_id'];
        $payment_method = $_POST['payment_method'];

        // Fetch the service details
        $sql = "SELECT service_name, service_price FROM all_services WHERE service_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $service_id);
        $stmt->execute();
        $stmt->bind_result($service_name, $service_price);
        $stmt->fetch();
        $stmt->close();

        // Fetch customer name
    /*    $sql = "SELECT username FROM user_data WHERE userID = $customer_id";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
        $stmt->bind_result($username);
        $stmt->fetch();
        $stmt->close();
        if (!$username) {
            echo "Error: Customer name not found.";
        exit(); // Exit the script or handle the error accordingly
} 

        // Fetch provider name
    /*   $sql = "SELECT user_name FROM service_p WHERE user_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $provider_id);
        $stmt->execute();
        $stmt->bind_result($provider_name);
        $stmt->fetch();
        $stmt->close(); */

        // Insert the order details into the orders table
        $sql = "INSERT INTO orders (service_name, date, total_price, order_status, payment_status, payment_method) 
                VALUES (?, NOW(), ?, 'Pending', 'Pending', ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sss", $service_name, $service_price, $payment_method);
        $stmt->execute();
        $stmt->close();
        // Check if customer name is fetched successfully
       

        // Redirect to order confirmation page or dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Please select a service and payment method.";
    }
}

// Close the database connection
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>CareSwift</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="We provide all homecare services." />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="imgs/theme/logo.jpeg" />
    <link href="css/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <main>
        <section class="content-main mt-80 mb-80">
            <div class="card mx-auto card-login">
                <div class="card-body">
                    <h4 class="card-title mb-4">Order a Service</h4>
                    <form method="post">
                        <div class="mb-3">
                            <select class="form-control" name="service_id" required>
                                <option value="">Select Service</option>
                                <?php
                                // Populate dropdown with available services
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['service_id'] . "'>" . $row['service_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <select class="form-control" name="payment_method" required>
                                <option value="">Select Payment Method</option>
                                <option value="PayPal">PayPal</option>
                                <option value="MasterCard">MasterCard</option>
                                <option value="JazzCash">JazzCash</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary w-100">Place Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <script src="js/vendors/jquery-3.6.0.min.js"></script>
    <script src="js/vendors/bootstrap.bundle.min.js"></script>
    <script src="js/vendors/jquery.fullscreen.min.js"></script>
    <script src="js/main.js" type="text/javascript"></script>
</body>
</html>
