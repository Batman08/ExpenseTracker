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

    function editUserExpense(rowId) {
        $('#hiddenData').val(rowId);

        var editeData = {
            EditeData: rowId
        };

        $.post(
            "TrackExpenses_Edit.php",
            editeData,
            function(data, status) {
                var userExpenseId = JSON.parse(data);
                $('#txtEditDate').val(userExpenseId.Date);
                $('#txtEditItem').val(userExpenseId.Name);
                $('#txtEditCost').val(userExpenseId.Amount);
                $('#ddlEditPaymentType').val(userExpenseId.PaymentType);
                console.log(status);
            }
        );

        $('#editStaticBackdrop').modal("show");
    }

    function updateEditedUserExpense(){
        var updateData = {
            Date: $("#txtEditDate").val(),
            Item: $("#txtEditItem").val(),
            Cost: $("#txtEditCost").val(),
            PaymentType: $("#ddlEditPaymentType").val(),
            HiddenData: $("#hiddenData").val()
        };

        $.post(
            "TrackExpenses_Update.php",
            updateData,
            function(data, status){
                console.log(status);
                displayData();
            }
        );
    }
</script>