<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-sign-in-alt"></i> Login</h3>
            </div>
            <div class="card-body">
                <form action='Login_Authenticate.php' method='POST'>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" name="txtUsername" placeholder="Enter Username" maxlength="256" required>
                    </div>
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="username">Password:</label>
                        <input type="password" class="form-control" name="txtPassword" placeholder="Enter Password" maxlength="256" required>
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>