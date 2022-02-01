<?php
session_start();
include("../MasterPages/DatabaseHelpers.php");
$allUserExpenses = GetAllUserExpenses($_SESSION['userId']);
?>

<?php foreach ($allUserExpenses as $expense) { ?>
    <tr>
        <td><?= $expense['RowNum'] ?></td>
        <td><?= $expense['Date'] ?></td>
        <td><?= $expense['Name'] ?></td>
        <td><?= $expense['Amount'] ?></td>
        <td><?= $expense['PaymentType'] ?></td>
    </tr>
<?php } ?>