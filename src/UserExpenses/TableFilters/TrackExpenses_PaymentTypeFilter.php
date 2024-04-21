<?php
session_start();
include("../../MasterPages/DatabaseHelpers.php");
$p_FilterPaymentType = $_POST["PaymentTypeFilter"];
$paymentTypeFilterExpenses = GetFilteredPaymentTypeExpenses($_SESSION['userId'], $p_FilterPaymentType);
?>

<?php foreach ($paymentTypeFilterExpenses as $expense) { ?>
    <?php include("TrackExpenses_TableBody.php"); ?>
<?php } ?>