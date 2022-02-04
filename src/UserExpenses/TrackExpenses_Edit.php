<?php
session_start();
include("../MasterPages/DatabaseHelpers.php");
$p_UserId = $_SESSION['userId'];
$p_EditId = $_POST['EditeData'];
$userRowExpense = GetUserRowExpense($p_UserId, $p_EditId)[0];

echo json_encode($userRowExpense);
?>