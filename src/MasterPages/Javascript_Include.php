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

                loginForm.reset();
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
        var divLoginMessage = document.querySelector('#divLoginMessage');
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

                signUpForm.reset();
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
        var divSignUpMessage = document.querySelector('#divSignUpMessage');
        divSignUpMessage.innerHTML = resultHtml;
    }

    var count = 4;

    function countDown() {
        var timer = document.querySelector("#divRedirectMessage");
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
                addExpenseForm.reset();
                checkWhatDataToDisplay();
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
                checkWhatDataToDisplay();
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
                checkWhatDataToDisplay();
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
        var signUpBtn = document.querySelector("#btnCreateAccount");

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

    var dateFilter = document.querySelector('#dateFilter');
    var itemFilter = document.querySelector('#txtItemFilter');
    var costFilter = document.querySelector('#txtCostFilter');
    var paymentFilter = document.querySelector('#ddlPaymentFilter');

    function filtersVisibility(dateVis, itemVis, costVis, paymentVis) {
        dateFilter.style.display = dateVis;
        itemFilter.style.display = itemVis;
        costFilter.style.display = costVis;
        paymentFilter.style.display = paymentVis;
    }

    function disableFilterInputsOnLoad() {
        filtersVisibility('none', 'none', 'none', 'none')
    }


    var currentSelectedValue = "";

    function checkFilterOption() {
        // alert(selectedValue);
        var ddlFilterTable = document.querySelector('#ddlFilterTable');
        var selectedValue = ddlFilterTable.value;

        currentSelectedValue = selectedValue;

        if (selectedValue === "Date") {
            filtersVisibility("block", "none", "none", "none");
        } else if (selectedValue === "Item") {
            filtersVisibility("none", "block", "none", "none");
        } else if (selectedValue === "Cost") {
            filtersVisibility("none", "none", "block", "none");
        } else if (selectedValue === "PaymentType") {
            filtersVisibility("none", "none", "none", "block");
        } else {
            filtersVisibility("none", "none", "none", "none");
        }
    }

    function itemTableFilter() {
        var itemFilterData = {
            ItemFilter: itemFilter.value,
        };

        // alert(itemFilterData.ItemFilter);

        $.ajax({
            type: 'POST',
            url: '../UserExpenses/TableFilters/TrackExpenses_ItemFilter.php',
            data: itemFilterData,
            success: function(data, status) {
                console.log(status);
                $('#tableTrackExpense').html(data);
                console.log(status);
            },
            error: function(status) {
                console.log(status);
            }

        });
    }

    function costTableFilter() {
        var costFilterData = {
            CostFilter: costFilter.value,
        };

        $.ajax({
            type: 'POST',
            url: '../UserExpenses/TableFilters/TrackExpenses_CostFilter.php',
            data: costFilterData,
            success: function(data, status) {
                console.log(status);
                $('#tableTrackExpense').html(data);
                console.log(status);
            },
            error: function(status) {
                console.log(status);
            }

        });

        if (costFilter.value === "") {
            displayData();
        }
    }

    function checkWhatDataToDisplay() {
        if (currentSelectedValue === "Date") {
            // dateTableFilter();
        } else if (currentSelectedValue === "Item") {
            itemTableFilter();
        } else if (currentSelectedValue === "Cost") {
            costTableFilter();
        } else if (currentSelectedValue === "PaymentType") {
            // paymentTypeTableFilter();
        } else {
            displayData();
        }
    }


    //login
    var loginForm = document.querySelector('#formLogin');

    //sign up
    var signUpForm = document.querySelector('#formSignUp');
    var signUpUsernameField = document.querySelector('#txtSignUpUsername');
    var signUpPasswordField = document.querySelector('#txtSignUpPassword');

    //track expenses
    var addExpenseForm = document.querySelector('#formAddExpense');
    var editExpenseForm = document.querySelector('#formEditExpense');
    var processFilterBtn = document.querySelector('#btnProcessFilter');
    var filterTableDDL = document.querySelector('#ddlFilterTable')


    if (page == "Login.php") {
        loginForm.addEventListener("submit", processLoginForm);
    } else if (page == "SignUp.php") {
        signUpForm.addEventListener("submit", processSignUpForm);
        signUpUsernameField.addEventListener("keypress", checkSignUpFields);
        signUpPasswordField.addEventListener("keypress", checkSignUpFields);
        signUpUsernameField.addEventListener("keyup", checkSignUpFields);
        signUpPasswordField.addEventListener("keyup", checkSignUpFields);
    } else if (page == "TrackExpenses.php") {
        disableFilterInputsOnLoad();
        addExpenseForm.addEventListener("submit", processAddExpenseForm);
        editExpenseForm.addEventListener("submit", updateEditedUserExpense);
        //processFilterBtn.addEventListener("click", checkFilterOption);
        filterTableDDL.addEventListener("click", checkFilterOption);
        itemFilter.addEventListener("keyup", itemTableFilter);
        costFilter.addEventListener("keyup", costTableFilter);
    }
</script>