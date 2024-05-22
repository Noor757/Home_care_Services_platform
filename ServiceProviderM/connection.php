<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "service_provider_db";

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Continue with the rest of your code
?>
