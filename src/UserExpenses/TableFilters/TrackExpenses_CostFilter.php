<?php
session_start();
include("../../MasterPages/DatabaseHelpers.php");
$p_FilterCost = $_POST["CostFilter"];
$costFilterExpenses = GetFilteredCostExpenses($_SESSION['userId'], $p_FilterCost);
?>

<?php foreach ($costFilterExpenses as $expense) { ?>
    <?php include("TrackExpenses_TableBody.php"); ?>
<?php } ?>