<?php
session_start();
include("../MasterPages/DatabaseHelpers.php");
$allUserExpenses = GetAllUserExpenses($_SESSION['userId']);
?>

<?php foreach ($allUserExpenses as $expense) { ?>
    <?php include("TableFilters/TrackExpenses_TableBody.php"); ?>
<?php } ?>