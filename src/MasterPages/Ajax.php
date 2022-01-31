<script>
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
                 console.log(status);
             }
        });
    }
</script>