       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Customer Money Deposit</h1>
                    </div>
                    <div class="col-xs-12">
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
                        <div class="form-group">
                            <label>Customer Name</label>
                            <?=$user_name;?>
                        </div>
                        <div class="form-group required">
                            <label>Date of Deposit</label>
                            <input class="form-control datepicker" placeholder="Click to Select Date" name="depositdate" id="depositdate" value="<?=$dep_date;?>" required>
                        </div>
                        <div class="form-group required">
                            <label>Amount</label>
                            <?=$dep_amount;?>
                        </div>
                        <div class="form-group ">
                            <label>Transaction Reference</label>
                            <input class="form-control" placeholder="Enter Transaction Reference Number" name="depreference" id="depreference" value="<?=$dep_transno;?>">
                        </div>

                        <div class="form-group ">
                            <label>Bank Name</label>
                            <input class="form-control" placeholder="Enter Bank Name" name="depbank" id="depbank" value="<?=$dep_bankname;?>">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="btnDeposit" id="btnDeposit" value="Update">Update</button>
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