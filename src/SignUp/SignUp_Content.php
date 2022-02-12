<div class="row">
    <div class="col-md-6 mx-auto">
        <div id="divSignUpMessage"></div>
        <div id="divRedirectMessage" class="text-secondary"></div>
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-user-plus"></i> Sign Up</h3>
            </div>
            <div class="card-body">
                <form id='formSignUp' method='POST'>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="txtSignUpUsername" name="txtSignUpUsername" placeholder="Enter Username" maxlength="30" autocomplete="false"  required>
                    </div>
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="username">Password:</label>
                        <input type="password" class="form-control" id="txtSignUpPassword" name="txtSignUpPassword" placeholder="Enter Password" maxlength="50" required>
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