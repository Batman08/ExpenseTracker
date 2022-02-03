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
        <td>
            <button type="button" onclick="editUserExpense(<?= $expense['RowNum'] ?>)" class="btn btn-secondary"><i class="fas fa-edit"></i></button>
            <button type="button" onclick="deleteUserExpense(<?= $expense['RowNum'] ?>)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
        </td>
        </tr>
<?php } ?>