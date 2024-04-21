<?php
function OpenConnection()
{
    $server = "localhost";
    $username = "root";
    $password = "Hoisaejfr^&o2";
    $database = "ExpenseTracker";

    $conn = new mysqli($server, $username, $password, $database);

    if ($conn === false) {
        die("ERROR: Could not connect. " . $conn->connect_error);
    }

    return $conn;
}

function CallDatabase($sql, $isDataReturned)
{
    try {
        $conn = OpenConnection();

        if ($isDataReturned) {
            $result = mysqli_query($conn, $sql);

            // we have data so store in variable then return

            while ($row = mysqli_fetch_array($result)) {
                $rows[] = $row;
            }

            mysqli_free_result($result); // free memory associated with result
            $conn->close();
            return $rows;
        } else {
            $result = mysqli_query($conn, $sql);
            $conn->close();
        }
    } catch (Exception $e) {
        $conn->close();
        echo "Error!" . $e->getMessage();
    }
}

function GetUserLoginDetails($p_Username)
{
    $details = CallDatabase("call spGetUserLoginDetails('$p_Username')", true);
    return $details[0];
}

function SaveUserLoginDetails($p_Username, $p_Password)
{
    return CallDatabase("call spSaveUserLoginDetails('$p_Username', '$p_Password')", false);
}

function GetUserId($p_Username)
{
    $userId = CallDatabase("call spGetUserId('$p_Username')", true);
    return $userId[0]['UserId'];
}

function SaveUserExpense($p_UserId, $p_Item, $p_PaymentType, $p_Date, $p_Cost)
{
    return CallDatabase("call spSaveUserExpense('$p_UserId', '$p_Item', '$p_PaymentType', '$p_Date', '$p_Cost')", false);
}

function GetAllUserExpenses($p_UserId)
{
    return CallDatabase("call spGetAllUserExpenses('$p_UserId')", true);
}

function DeleteUserExpense($p_UserId, $p_RowId)
{
    return CallDatabase("call spDeleteUserExpense('$p_UserId', '$p_RowId')", false);
}

function GetUserRowExpense($p_UserId, $p_RowId)
{
    return CallDatabase("call spGetUserRowExpense('$p_UserId', '$p_RowId')", true);
}


function UpdateUserExpense($p_UserId, $p_UpdateId, $p_Item, $p_PaymentType, $p_Date, $p_Cost)
{
    return CallDatabase("call spUpdateUserExpense('$p_UserId', '$p_UpdateId', '$p_Item', '$p_PaymentType', '$p_Date', '$p_Cost')", false);
}

function GetTotalUserExpenses($p_UserId)
{
    $total = CallDatabase("call spGetTotalUserExpenses('$p_UserId')", true);
    return $total[0]['TotalUserExpenses'];
}

function GetFilteredItemExpenses($p_UserId, $p_NameFilter)
{
    return CallDatabase("call spGetFilteredItemExpenses('$p_UserId', '$p_NameFilter')", true);
}

function GetFilteredCostExpenses($p_UserId, $p_CostFilter)
{
    return CallDatabase("call spGetFilteredCostExpenses('$p_UserId', '$p_CostFilter')", true);
}

function GetFilteredPaymentTypeExpenses($p_UserId, $p_PaymentTypeFilter)
{
    return CallDatabase("call spGetFilteredPaymentTypeExpenses('$p_UserId', '$p_PaymentTypeFilter')", true);
}