       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Customer Money Deposit</h1>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <?php if (!empty($error)) { ?>
                                <div class="alert alert-danger fade in"><?= $error; ?></div>
                            <?php } ?>
                            <?php if (!empty($message)) { ?>
                                <div class="alert alert-success fade in"><?= $message; ?></div>
                            <?php } ?>
                            <?php echo form_open(current_url(), array(
                                'id' => 'frmdeposit',
                                'role' => 'form'
                            )); ?>
                        <div class="form-group  required">
                            <label>Customer Name</label>
                            <?PHP
                                $attributes = 'class="form-control" id="custname" name="custname" required autofocus';
                                echo form_dropdown('custname',$customers,set_value('custname'),$attributes);
                            ?>
                            <input type="hidden" name="hiddepid" id="hiddepid" value="0"/>
                        </div>
                        <div class="form-group required">
                            <label>Date of Deposit</label>
                            <input class="form-control datepicker" placeholder="Click to Select Date" name="depositdate" id="depositdate" required>
                        </div>
                        <div class="form-group required">
                            <label>Amount</label>
                            <input class="form-control" placeholder="Enter Amount" name="depamount"  id="depamount" required>
                        </div>
                        <div class="form-group ">
                            <label>Transaction Reference</label>
                            <input class="form-control" placeholder="Enter Transaction Reference Number" name="depreference" id="depreference">
                        </div>

                        <div class="form-group ">
                            <label>Bank Name</label>
                            <input class="form-control" placeholder="Enter Bank Name" name="depbank" id="depbank">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="btnDeposit" id="btnDeposit" value="Deposit">Deposit</button>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Daily Deposits from Customers
                            </div>
                            <div class="panel-body">
                                <table id="a_daily_deposits" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Customer Name</th>
                                        <th>Amount</th>
                                        <th>Transaction No.</th>
                                        <th>Bank Name</th>
                                        <th>Edit/Delete</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>Customer Name</th>
                                        <th>Amount</th>
                                        <th>Transaction No.</th>
                                        <th>Bank Name</th>
                                        <th>Edit/Delete</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="panel-footer">

                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
            </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->