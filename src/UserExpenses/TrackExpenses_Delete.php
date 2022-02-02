<?php 
session_start();
$p_UserId = $_SESSION["userId"];
$p_RowId = $_POST["DeleteData"];

include("../MasterPages/DatabaseHelpers.php");

DeleteUserExpense($p_UserId, $p_RowId);
?>