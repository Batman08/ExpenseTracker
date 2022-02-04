<?php
session_start();
include("../MasterPages/DatabaseHelpers.php");

$p_UserId = $_SESSION["userId"];
$p_UpdateId = $_POST["HiddenData"];
$p_Item = $_POST["Item"];
$p_PaymentType = $_POST["PaymentType"];
$p_Date = $_POST["Date"];
$p_Cost = $_POST["Cost"];

UpdateUserExpense($p_UserId, $p_UpdateId, $p_Item, $p_PaymentType, $p_Date, $p_Cost);
?>