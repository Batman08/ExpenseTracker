<?php 
    session_start();

    include("../MasterPages/DatabaseHelpers.php");

    $username =  $_POST["txtUsername"];
    $password =  $_POST["txtPassword"];
    $loginDetails = GetUserLoginDetails($username);

    

    if ($username == $loginDetails["Username"] && $password ==  $loginDetails["Password"]){
        $_SESSION["username"] = $username;
        $_SESSION["userId"] = GetUserId($username);

        header("Location: ../UserExpenses/TrackExpenses.php");
    }
    else {
        header("Location: ../Login/Login.php");
    }
?>