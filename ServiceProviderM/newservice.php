<?php
include 'connection.php'; // Include your database connection file

session_start();
$user_id = $_SESSION['user_id']; // Get the user ID from the session
$userID = $_SESSION['userID'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a service ID is selected
    if (isset($_POST['service_id'])) {
        $service_id = $_POST['service_id'];
        
        // Insert the selected service ID and user ID into the userservices table
        $sql = "INSERT INTO userservices (user_id, service_id) VALUES (?, ?)";
        
        if ($stmt = $con->prepare($sql)) {
            $stmt->bind_param("ii", $user_id, $service_id);
            $stmt->execute();
            $stmt->close();
            // Redirect to dashboard or any other page after adding the service
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error: " . $con->error;
        }
    } else {
        // Handle case where no service is selected
        echo "Please select a service.";
    }
}

// Fetch available services from the database
$sql = "SELECT service_id, service_name FROM all_services";
$result = $con->query($sql);

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
                    <h4 class="card-title mb-4">Add New Service</h4>
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
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
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
