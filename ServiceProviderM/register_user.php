<?php
include('connection.php'); 

if (isset($_POST['register'])){
    $uname = $_POST['username'];
    $uemail = $_POST['email'];
    $pwd = $_POST['password'];
    $conPwd = $_POST['confirm_password'];
    $role = trim($_POST['role'] ?? '');
    $terms_accepted = isset($_POST['terms']);

    // Check if username already exists
    $select_query = "SELECT * FROM `user` WHERE username='$uname'";
    $result = mysqli_query($con, $select_query);
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<script>alert('Username already exists!'); window.location.href = 'page-register.html';</script>";
        exit; // Stop further execution if username exists
    }
else if($pwd!=$conPwd){
    echo "<script>alert('Password does not match!'); window.location.href = 'page-register.html';</script>";
}
else{
    
    // Proceed with user registration if username is unique
    $insert_query = "INSERT INTO `user` (username, password) VALUES ('$uname', '$pwd')";
    $sql_execute = mysqli_query($con, $insert_query);
    
    if ($sql_execute) {
        header("Location: page-register.html");
        echo "<script>alert('User created successfully. Welcome $uname')</script>";
        exit; 
    } else {
        die(mysqli_error($con)); 
    }
}}

