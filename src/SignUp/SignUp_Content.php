<?php if ($_GET['SavedDetails'] == "success") { ?>
    <div class="alert alert-success" role="alert">
        <i class="fas fa-check fa-lg"></i>
        Successfully created account.
    </div>
<?php } elseif ($_GET['SavedDetails'] == "failed") { ?>
    <div class="alert alert-danger" role="alert">
        <i class="fas fa-times fa-lg"></i>
        Account with this Username already exist, pleast try a different one.
    </div>
<?php } ?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-user-plus"></i> Sign Up</h3>
            </div>
            <div class="card-body">
                <form action='SignUp_Authenticate.php' method='POST'>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" name="txtSignUpUsername" placeholder="Enter Username" maxlength="30" required>
                    </div>
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="username">Password:</label>
                        <input type="password" class="form-control" name="txtSignUpPassword" placeholder="Enter Password" maxlength="50" required>
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-lock"></i> Create Account</button>
                    </div>
                    <div class="form-text">Already have an account? <a href="/Login/Login.php" class="link-primary">Log In</a></div>
                </form>
            </div>
        </div>
    </div>
</div>