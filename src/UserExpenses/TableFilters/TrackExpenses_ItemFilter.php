<?php
session_start();
include("../../MasterPages/DatabaseHelpers.php");
$p_FilterItem = $_POST["ItemFilter"];
$itemFilterExpenses = GetFilteredItemExpenses($_SESSION['userId'], $p_FilterItem);
?>

<?php foreach ($itemFilterExpenses as $expense) { ?>
    <?php include("TrackExpenses_TableBody.php"); ?>
<?php } ?>