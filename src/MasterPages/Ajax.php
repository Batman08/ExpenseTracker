<script>
    window.onload = function() {
        displayData();
    }

    function displayData() {
        var displayData = {
            DisplayData: "true"
        };

        $.ajax({
            type: 'POST',
            url: "TrackExpenses_Display.php",
            data: displayData,
            success: function(data, status) {
                $('#tableTrackExpense').html(data);
            }
        });
    }

    function processAddExpenseForm() {
        var dataToServer = {
            Date: $("#txtDate").val(),
            Item: $("#txtItem").val(),
            Cost: $("#txtCost").val(),
            PaymentType: $("#ddlPaymentType").val()
        };

        $.ajax({
            type: 'POST',
            url: 'TrackExpenses_Save.php',
            data: dataToServer,
            success: function(data, status) {
                displayData();
                document.getElementById("formAddExpense").reset();
                console.log(status);
            }
        });
    }

    function deleteUserExpense(rowId) {
        var deleteData = {
            DeleteData: rowId
        };

        $.ajax({
            type: 'POST',
            url: 'TrackExpenses_Delete.php',
            data: deleteData,
            success: function(data, status) {
                displayData();
                console.log(status);
            }
        });
    }

    function editUserExpense(updateId) {
        $('#hiddenData').val(updateId);

        var updateData = {
            UpdateData: updateId
        };

        $.post(
            "TrackExpenses_Edit.php",
            updateData,
            function(data, status) {
                var userId = JSON.parse(data);
                $('#txtEditDate').val(userId.Date);
                $('#txtEditItem').val(userId.Name);
                $('#txtEditCost').val(userId.Amount);
                $('#ddlEditPaymentType').val(userId.PaymentType);
                console.log(status);
            }
        );

        $('#editStaticBackdrop').modal("show");
    }
</script>