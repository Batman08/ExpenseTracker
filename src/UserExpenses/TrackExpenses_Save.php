<?php 
session_start();

$p_UserId = $_SESSION["userId"];
$p_Item = $_POST["Item"];
$p_PaymentType = $_POST["PaymentType"];
$p_Date = $_POST["Date"];
$p_Cost = $_POST["Cost"];


    include("../MasterPages/DatabaseHelpers.php");

     SaveUserExpense($p_UserId, $p_Item, $p_PaymentType, $p_Date, $p_Cost);
?>