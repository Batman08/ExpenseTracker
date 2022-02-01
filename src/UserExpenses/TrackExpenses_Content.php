        <?php
        session_start();
        echo $_SESSION["username"];
        echo $_SESSION["userId"];
        $allUserExpenses = GetAllUserExpenses($_SESSION['userId']);
        ?>

        <div class="row" style="padding-bottom: 60px;">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fas fa-plus-circle"></i> Add Expense</h3>
                    </div>
                    <div class="card-body">
                        <form id="formAddExpense" method="POST">

                            <!-- Date -->
                            <div class="row padBottom10">
                                <div class="col-md-3">
                                    <label for="txtDate"><i class="fas fa-calendar-day fa-fw"></i> Date:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" id="txtDate" name="txtDate" required>
                                </div>
                            </div>

                            <!--  Item -->
                            <div class="row padBottom10">
                                <div class="col-md-3">
                                    <label for="txtItem"><i class="fas fa-tag"></i> Item</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="txtItem" name="txtItem" placeholder="Enter Item" maxlength="256" required>
                                </div>
                            </div>

                            <!--  Cost -->
                            <div class="row padBottom10">
                                <div class="col-md-3">
                                    <label for="txtCost"><i class="fas fa-pound-sign"></i> Cost</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="number" step=0.01 class="form-control" id="txtCost" name="txtCost" placeholder="Enter Cost of Item" required>
                                </div>
                            </div>

                            <!-- Payment Type -->
                            <div class="row padBottom10">
                                <div class="col-md-3">
                                    <label for="ddlPaymentType"><i class="fas fa-money-check"></i> Payment Type:</label>
                                </div>
                                <div class="col-md-9">
                                    <select id="ddlPaymentType" name="ddlPaymentType" class="form-select" aria-label="select user" required>
                                        <option selected disabled>-- Select Payment Type --</option>
                                        <option value="CreditCard">Credit Card</option>
                                        <option value="DebitCard">Debit Card</option>
                                        <option value="Cash">Cash</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: 20px;">
                                <button type="button" onclick="processAddExpenseForm()" class="btn btn-primary btn-block"><i class="fas fa-plus-circle"></i> Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- <button type="button" onclick="deleteRow()" class="btn btn-danger">Remove Item</button> -->


        <div class="row">
            <div>
                <table class="table table-striped table-hover">
                    <colgroup></colgroup>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Item</th>
                            <th scope="col">Cost</th>
                            <th scope="col">Payment Type</th>
                        </tr>
                    </thead>
                    <tbody id="tableTrackExpense"></tbody>
                </table>
            </div>
        </div>