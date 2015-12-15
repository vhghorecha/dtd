       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <?php echo form_open(current_url(), array(
                    'id' => 'frmvendorpay',
                    'role' => 'form'
                )); ?>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Vendor Payment</h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>Delivered Orders</h3>
                            <table id="a_ven_pay" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Order id</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Customer</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Item type</th>
                                    <th>Item name</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Order id</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Customer</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Item type</th>
                                    <th>Item name</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <?php if (!empty($error)) { ?>
                            <div class="alert alert-danger fade in"><?= $error; ?></div>
                        <?php } ?>
                        <?php if (!empty($message)) { ?>
                            <div class="alert alert-success fade in"><?= $message; ?></div>
                        <?php } ?>
                        <div class="form-group  required">
                            <label>Vendor Name</label>
                            <?PHP
                                $attributes = 'class="form-control" id="vendname" name="vendname" required autofocus';
                                echo form_dropdown('vendname',$vendors,set_value('vendname'),$attributes);
                            ?>
                        </div>
                        <div class="form-group required">
                            <label>Date of Payment</label>
                            <input class="form-control datepicker" placeholder="Click to Select Date" name="paydate" required>
                        </div>
                        <div class="form-group  required">
                            <label>Amount</label>
                            <input type="number" class="form-control" placeholder="Enter Amount" id="payamount" name="payamount" required value="0" readonly>
                        </div>
                        <div class="form-group  ">
                            <label>Transaction Reference</label>
                            <input class="form-control" placeholder="Enter Transaction Reference Number" name="payreference" >
                        </div>
                        <div class="form-group  ">
                            <label>Bank A/c. Number</label>
                            <input class="form-control" placeholder="Enter Bank A/c. Number" name="paybankacno" id="paybankacno" >
                        </div>
                        <div class="form-group  ">
                            <label>Bank Name</label>
                            <input class="form-control" placeholder="Enter Bank Name" name="paybankname" id="paybankname" >
                        </div>
                        <div class="form-group">
                            <button type="submit" href="<?=site_url('admin/payment')?>" class="btn btn-primary" name="btnSave" id="btnSave" value="save">Save</button>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Daily Payments to Vendors
                            </div>
                            <div class="panel-body">
                                <table id="a_daily_payments" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Vendor Name</th>
                                        <th>Amount</th>
                                        <th>Transaction No.</th>
                                        <th>Bank Name</th>
                                        <th>Edit/Delete</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>Vendor Name</th>
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
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    
