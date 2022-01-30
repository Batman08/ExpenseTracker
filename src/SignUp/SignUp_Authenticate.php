<?php 
    session_start();
    include("../MasterPages/DatabaseHelpers.php");

    $p_Username =  $_POST["txtSignUpUsername"];
    $p_Password =  $_POST["txtSignUpPassword"];
    $loginDetails = GetUserLoginDetails($p_Username);


    if ($p_Username != $loginDetails["Username"]){
        SaveUserLoginDetails($p_Username, $p_Password);
        $submissionValue = "success";
    }
    else {
        // show error message
        $submissionValue = "failed";
    }

    header("Location: /SignUp/SignUp.php?SavedDetails=" . $submissionValue);
?>