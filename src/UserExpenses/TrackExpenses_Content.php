        <div class="row" style="padding-bottom: 60px;">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fas fa-plus-circle"></i> Add Expense</h3>
                    </div>
                    <div class="card-body">
                        <form action='Login_Authenticate.php' method='POST'>

                            <!-- Date -->
                            <div class="row padBottom10">
                                <div class="col-md-3">
                                    <label for="txtDate"><i class="fas fa-calendar-day fa-fw"></i> Date:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" name="txtDate" required>
                                </div>
                            </div>

                            <!--  Item -->
                            <div class="row padBottom10">
                                <div class="col-md-3">
                                    <label for="txtItem"><i class="fas fa-tag"></i> Item</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="txtItem"
                                        placeholder="Enter Item" maxlength="256" required>
                                </div>
                            </div>

                            <!--  Cost -->
                            <div class="row padBottom10">
                                <div class="col-md-3">
                                    <label for="txtCost"><i class="fas fa-pound-sign"></i> Cost</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="number" step=0.01 class="form-control" name="txtCost"
                                        placeholder="Enter Cost of Item" required>
                                </div>
                            </div>

                            <!-- Payment Type -->
                            <div class="row padBottom10">
                                <div class="col-md-3">
                                    <label for="ddlPaymentType"><i class="fas fa-money-check"></i> Payment Type:</label>
                                </div>
                                <div class="col-md-9">
                                    <select name="ddlPaymentType" class="form-select" aria-label="select user" required>
                                        <option value="">-- Select Payment Type --</option>
                                        <option value=""></option>
                                        <option value=""></option>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: 20px;">
                                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-plus-circle"></i> Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>