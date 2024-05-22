<?php
include('connection.php');

if (isset($_POST['login'])) {
    $uname = trim($_POST['username']);
    $pwd = trim($_POST['password']);

    // Input validation
    if (empty($uname) || empty($pwd)) {
        echo "<script>alert('Both fields are required!'); window.location.href = 'page-login.html';</script>";
        exit;
    }

    // Prepare and execute the SQL query
    $select_query = "SELECT * FROM `user` WHERE username = '$uname'";
    $result = mysqli_query($con, $select_query);

    if ($result) {
        $row_count = mysqli_num_rows($result);
        if ($row_count > 0) {
            $row_data = mysqli_fetch_assoc($result);
            if (password_verify($pwd, $row_data['password'])) {
                // Successful login
                echo "<script>alert('Login Successful. Welcome $uname'); window.location.href = 'index.html';</script>";
                exit;
            } else {
                // Invalid password
                echo "<script>alert('Invalid username or password'); window.location.href = 'page-login.html';</script>";
                exit;
            }
        } else {
            // Username not found
            echo "<script>alert('Invalid username or password'); window.location.href = 'page-login.html';</script>";
            exit;
        }
    } else {
        // Query error
        die("Query Failed: " . mysqli_error($con));
    }
}
