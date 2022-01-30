<?php 
    include("../MasterPages/DatabaseHelpers.php");

    $p_Username =  $_POST["txtSignUpUsername"];
    $p_Password =  $_POST["txtSignUpPassword"];
    $loginDetails = GetUserLoginDetails($p_Username);


    if ($p_Username != $loginDetails["Username"]){
        SaveUserLoginDetails($p_Username, $p_Password);
        $_SESSION["savedDetails"] = "success";
    }
    else {
        // show error message using session variable
        $_SESSION["savedDetails"] = "failed";
    }

    header("Location: /SignUp/SignUp.php?SavedDetails=" . $_SESSION["savedDetails"]);
?>