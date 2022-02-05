<script>
    // var path = window.location.pathname;
    // var page = path.split("/").pop();

    // if (page == "TrackExpenses.php") {
    //     window.history.forward();
    // }
    // if (page == "Login.php") {
    //     // alert("login page");
    // } else if (page == "TrackExpenses.php") {
    //     window.history.forward(); 
    //     // alert("track expenses page");
    // }

    window.onload = function() {
        displayData();
    }

    function displayData() {
        $.ajax({
            type: 'POST',
            url: "../UserExpenses/TrackExpenses_Display.php",
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

    function updateEditedUserExpense() {
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
            function(data, status) {
                console.log(status);
                displayData();
            }
        );
    }

    function logoutUser() {
        $.ajax({
            type: 'POST',
            url: '../Login/Logout.php',
            error: function(xhr, statusText, err, data) {
                console.log(data);
                // alert("logout failed " + xhr.status);
            },

            success: function() {
                // alert("Logout successful");
                window.location.href = "/Login/Login.php";
            }
        });
    }
</script>