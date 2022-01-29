<?php 
    include("../MasterPages/DatabaseHelpers.php");

    $username =  $_POST["txtUsername"];
    $password =  $_POST["txtPassword"];
    $loginDetails = GetUserLoginDetails($username);

    if ($username == $loginDetails["Username"] && $password ==  $loginDetails["Password"]){
        header("Location: ../UserExpenses/TrackExpenses.php");
    }
    else {
        header("Location: ../Login/Login.php");
    }
?>