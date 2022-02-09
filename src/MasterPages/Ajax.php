<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    var path = window.location.pathname;
    var page = path.split("/").pop();
    window.onload = function() {
        if (page == "TrackExpenses.php") {
            displayData();
        }
    }

    function processLoginForm(e) {
        if (e.preventDefault) e.preventDefault();

        var loginDataToServer = {
            Username: $("#txtUsername").val(),
            Pasword: $("#txtPassword").val()
        };

        $.ajax({
            type: 'POST',
            url: 'Login_Authenticate.php',
            data: loginDataToServer,
            success: function(data, status) {

                var userLogin = null;

                try {
                    userLogin = JSON.parse(data);
                } catch (error) {
                    console.log("Username does not exist in system: " + error);
                }

                document.getElementById("formLogin").reset();
                console.log(status);

                //change alerts to show error message on screen
                if (userLogin !== null && loginDataToServer.Username === userLogin.Username && loginDataToServer.Pasword === userLogin.Password) {
                    window.location.href = "../UserExpenses/TrackExpenses.php";
                } else {
                    alert("Ooops, something has gone wrong, please login again");
                }

                // console.log(userLogin);
                // console.log(userLogin.Username);
                // console.log(userLogin.Password);
                // console.log(loginDataToServer.Username);
                // console.log(loginDataToServer.Pasword);
            }
        });
    }

    function displayError(resultHtml) {
        var divContactUsResult = document.getElementById('divContactUsResult');
        divContactUsResult.innerHTML = resultHtml;
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

    function processAddExpenseForm(e) {
        if (e.preventDefault) e.preventDefault();

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
                $('#addStaticBackdrop').modal('hide');
                document.getElementById("formAddExpense").reset();
                displayData();
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

    function updateEditedUserExpense(e) {
        if (e.preventDefault) e.preventDefault();


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
                $('#editStaticBackdrop').modal('hide');
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


    if (page == "Login.php") {
        document.getElementById('formLogin').addEventListener("submit", processLoginForm);
    } else if (page == "TrackExpenses.php") {
        document.getElementById('formAddExpense').addEventListener("submit", processAddExpenseForm);
        document.getElementById('formEditExpense').addEventListener("submit", updateEditedUserExpense);
    }
</script>