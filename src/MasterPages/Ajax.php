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

                if (userLogin !== null && loginDataToServer.Username === userLogin.Username && loginDataToServer.Pasword === userLogin.Password) {
                    window.location.href = "../UserExpenses/TrackExpenses.php";
                } else {
                    resultHtml = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Incorrect username and/or password, please try again.</div>';
                    displayLoginErrorMsg(resultHtml)
                }
            }
        });
    }

    function displayLoginErrorMsg(resultHtml) {
        var divLoginMessage = document.getElementById('divLoginMessage');
        divLoginMessage.innerHTML = resultHtml;
    }

    function processSignUpForm(e) {
        if (e.preventDefault) e.preventDefault();

        var signUpDataToServer = {
            SignUpUsername: $("#txtSignUpUsername").val(),
            SignUpPassword: $("#txtSignUpPassword").val()
        };

        $.ajax({
            type: 'POST',
            url: 'SignUp_Authenticate.php',
            data: signUpDataToServer,
            success: function(data, status) {

                var userSignUp = null;

                try {
                    userSignUp = JSON.parse(data);
                } catch (error) {
                    console.log("Something went wrong with sign up: " + error);
                }

                document.getElementById("formSignUp").reset();
                console.log(status);
                console.log(userSignUp);

                if (userSignUp === "success") {
                    resultHtml = '<div class="alert alert-success" role="alert"><i class="fas fa-check"></i> Successfully created account.</div>';
                    displaySignUpMessage(resultHtml);
                    countDown();
                } else if (userSignUp === "failed") {
                    resultHtml = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Account with this username already exists, pleast try a different one.</div>';
                    displaySignUpMessage(resultHtml);
                }
            }
        });
    }

    function displaySignUpMessage(resultHtml) {
        var divSignUpMessage = document.getElementById('divSignUpMessage');
        divSignUpMessage.innerHTML = resultHtml;
    }

    var count = 4;

    function countDown() {
        var timer = document.getElementById("divRedirectMessage");
        if (count > 0) {
            count--;
            timer.innerHTML = "This page will redirect in " + count + " seconds.";
            setTimeout("countDown()", 1000);
        } else {
            window.location.href = "../Login/Login.php";
        }
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
            },

            success: function() {
                window.location.href = "/Login/Login.php";
            }
        });
    }

    String.prototype.getWhitespaceCount = function() {
        return this.split(" ").length - 1
    }

    function checkSignUpFields() {
        var resultHtml = '';
        var usernameFieldValue = $("#txtSignUpUsername").val();
        var passwordFieldValue = $("#txtSignUpPassword").val();
        var usernameBlankSpaces = usernameFieldValue.getWhitespaceCount();
        var passwordBlankSpaces = passwordFieldValue.getWhitespaceCount();
        var signUpBtn = document.getElementById("btnCreateAccount");

        if (usernameBlankSpaces > 0 && passwordBlankSpaces > 0) {
            signUpBtn.disabled = true;
            resultHtml = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Username and password should not contain any spaces</div>';
        } else if (usernameBlankSpaces > 0) {
            signUpBtn.disabled = true;
            resultHtml = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Username should not contain any spaces</div>';
        } else if (passwordBlankSpaces > 0) {
            signUpBtn.disabled = true;
            resultHtml = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Password should not contain any spaces</div>';
        } else {
            signUpBtn.disabled = false;
            resultHtml = '';
        }
        displaySignUpMessage(resultHtml);
    }


    var loginForm = document.getElementById('formLogin');
    var signUpForm = document.getElementById('formSignUp');
    var signUpUsernameField = document.getElementById('txtSignUpUsername');
    var signUpPasswordField = document.getElementById('txtSignUpPassword');

    if (page == "Login.php") {
        loginForm.addEventListener("submit", processLoginForm);
    } else if (page == "SignUp.php") {
        signUpForm.addEventListener("submit", processSignUpForm);
        signUpUsernameField.addEventListener("keypress", checkSignUpFields);
        signUpPasswordField.addEventListener("keypress", checkSignUpFields);
        signUpUsernameField.addEventListener("keyup", checkSignUpFields);
        signUpPasswordField.addEventListener("keyup", checkSignUpFields);
        //keyup
    } else if (page == "TrackExpenses.php") {
        document.getElementById('formAddExpense').addEventListener("submit", processAddExpenseForm);
        document.getElementById('formEditExpense').addEventListener("submit", updateEditedUserExpense);
    }
</script>