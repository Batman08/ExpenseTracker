        <?php
        session_start();
        // $allUserExpenses = GetAllUserExpenses($_SESSION['userId']);
        ?>

        <div class="row">
            <div class="col-sm-12">
                <h3><i class="fas fa-user"></i> <?= $_SESSION["username"] ?></h3>
            </div>
        </div>

        <!-- Button trigger Add modal -->
        <div class="form-group" style="margin-top: 20px;">
            <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#addStaticBackdrop"><i class="fas fa-plus-circle"></i> Add</button>
        </div>

        <br />

        <div class="row">
            <div>
                <table class="table table-striped table-hover">
                    <colgroup>
                        <col style="width: 5%;">
                        <col style="width: 15%;">
                        <col style="width: 20%;">
                        <col style="width: 15%;">
                        <col style="width: 20%;">
                        <col style="width: 10%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Item</th>
                            <th scope="col">Cost</th>
                            <th scope="col">Payment Type</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tableTrackExpense"></tbody>
                </table>
            </div>
        </div>

        <!-- Add Modal -->
        <div class="modal fade" id="addStaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-plus-circle fa-fw"></i> Add Expense</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formAddExpense" method="POST">

                            <!-- Date -->
                            <div class="row">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-day fa-fw"></i></span>
                                    <input type="date" class="form-control" id="txtDate" name="txtDate" required>
                                </div>
                            </div>

                            <!--  Item -->
                            <div class="row">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-tag fa-fw"></i></span>
                                    <input type="text" class="form-control" id="txtItem" name="txtItem" placeholder="Enter Item" maxlength="256" required>
                                </div>
                            </div>

                            <!--  Cost -->
                            <div class="row">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-pound-sign fa-fw"></i></span>
                                    <input type="number" step=0.01 class="form-control" id="txtCost" name="txtCost" placeholder="Enter Cost of Item" required>
                                </div>
                            </div>

                            <!-- Payment Type -->
                            <div class="row">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-money-check fa-fw"></i></span>
                                    <select id="ddlPaymentType" name="ddlPaymentType" class="form-select" aria-label="select user" required>
                                        <option selected disabled>-- Select Payment Type --</option>
                                        <option value="Credit Card">Credit Card</option>
                                        <option value="Debit Card">Debit Card</option>
                                        <option value="Cash">Cash</option>
                                    </select>
                                </div>
                            </div>
                            <hr />
                            <div style="float: right;">
                                <span style="padding-right: 5px;">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="far fa-times-circle fa-fw"></i> Close</button>
                                </span>
                                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-plus-circle fa-fw"></i> Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Edit Modal -->
        <div class="modal fade" id="editStaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-edit"></i> Edit Expense</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formEditExpense" method="POST">

                            <!-- Date -->
                            <div class="row">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-day fa-fw"></i></span>
                                    <input type="date" class="form-control" id="txtEditDate" name="txtEditDate" required>
                                </div>
                            </div>

                            <!--  Item -->
                            <div class="row">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-tag fa-fw"></i></span>
                                    <input type="text" class="form-control" id="txtEditItem" name="txtEditItem" placeholder="Enter Item" maxlength="256" required>
                                </div>
                            </div>

                            <!--  Cost -->
                            <div class="row">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-pound-sign fa-fw"></i></span>
                                    <input type="number" step=0.01 class="form-control" id="txtEditCost" name="txtEditCost" placeholder="Enter Cost of Item" required>
                                </div>
                            </div>

                            <!-- Payment Type -->
                            <div class="row">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-money-check fa-fw"></i></span>
                                    <select id="ddlEditPaymentType" name="ddlEditPaymentType" class="form-select" aria-label="select user" required>
                                        <option selected disabled>-- Select Payment Type --</option>
                                        <option value="Credit Card">Credit Card</option>
                                        <option value="Debit Card">Debit Card</option>
                                        <option value="Cash">Cash</option>
                                    </select>
                                </div>
                            </div>
                            <hr />
                            <div style="float: right;">
                                <span style="padding-right: 5px;">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="far fa-times-circle fa-fw"></i> Close</button>
                                </span>
                                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sync-alt fa-fw"></i> Update</button>
                            </div>
                            <input type="hidden" id="hiddenData">
                        </form>
                    </div>
                </div>
            </div>
        </div>