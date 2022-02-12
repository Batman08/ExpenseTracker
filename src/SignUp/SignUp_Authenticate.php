<?php 
    session_start();
    include("../MasterPages/DatabaseHelpers.php");

    $p_Username =  $_POST["SignUpUsername"];
    $p_Password =  $_POST["SignUpPassword"];
    $loginDetails = GetUserLoginDetails($p_Username);

    $submissionValue = "";

    if ($p_Username != $loginDetails["Username"]){
        // show success message
        $submissionValue = "success";
        SaveUserLoginDetails($p_Username, $p_Password);
    }
    else if($p_Username == $loginDetails["Username"]){
        // show error message
        $submissionValue = "failed";
    }

    echo json_encode($submissionValue);
?>