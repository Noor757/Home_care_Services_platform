<?php
function check_login($con){
    if(isset($_SESSION["user_id"])){
        $id = $_SESSION["user_id"];
        $query = "select * from service_p where user_id = '$id' limit 1";

        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result)> 0){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    elseif(isset($_SESSION["userID"])){
        $id = $_SESSION["userID"];
        $query = "select * from user_data where userID = '$id' limit 1";

        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result)> 0){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    //redirect to login
    header("Location: login.php");
    die;
}
?>