<?php
session_start();
include("../MasterPages/DatabaseHelpers.php");
$p_UserId = $_SESSION['userId'];
$p_UpdateId = $_POST['UpdateData'];
$userRowExpense = GetUserRowExpense($p_UserId, $p_UpdateId)[0];

echo json_encode($userRowExpense);
?>