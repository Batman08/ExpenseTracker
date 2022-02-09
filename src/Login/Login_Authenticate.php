<?php 
    session_start();

    include("../MasterPages/DatabaseHelpers.php");

    $username =  $_POST["Username"];
    $password =  $_POST["Password"];
    $loginDetails = GetUserLoginDetails($username);
    
    if(isset($loginDetails['Username'])){
        $_SESSION["username"] = $username;
        $_SESSION["userId"] = GetUserId($username);
        
        echo json_encode($loginDetails);
    }
