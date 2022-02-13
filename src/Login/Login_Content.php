<div class="row" style="margin-bottom: 50px;">
    <div class="col-md-6 mx-auto">
        <h1 class="display-4">Expense Tracker</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div id="divLoginMessage"></div>
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-sign-in-alt"></i> Login</h3>
            </div>
            <div class="card-body">
                <form id="formLogin" method='POST'>
                <div class="form-group" style="margin-top: 10px;">
                        <label for="username">Username:</label>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="txtUsername" name="txtUsername" placeholder="Enter Username" aria-describedby="basic-addon1" maxlength="256" required>
                    </div>

                    <div class="form-group" style="margin-top: 10px;">
                        <label for="username">Password:</label>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="txtPassword" placeholder="Enter Password" maxlength="256" aria-describedby="basic-addon1" required>
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> Login</button>
                    </div>
                    <div class="form-text">Don't have an account? <a href="/SignUp/SignUp.php" class="link-primary">Sign Up</a></div>
                </form>
            </div>
        </div>
    </div>
</div>