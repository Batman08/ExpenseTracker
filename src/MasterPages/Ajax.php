<script>
    window.onload = function(){
        displayData();
    }

    function displayData(){
        var displayData = {DisplayData: "true"};

        $.ajax({
            type: 'POST',
            url: "TrackExpenses_Display.php",
            data: displayData,
            success:function(data, status){
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
             success:function(data, status){
                 displayData();
                 document. getElementById("formAddExpense"). reset();
                 console.log(status);
             }
        });
    }

    function deleteUserExpense(rowId){
        var deleteData = {DeleteData: rowId};

        $.ajax({
            type: 'POST',
            url: 'TrackExpenses_Delete.php',
            data: deleteData,
             success:function(data, status){
                 displayData();
                 console.log(status);
             }
        });
    }
</script>