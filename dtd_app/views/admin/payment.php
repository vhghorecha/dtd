       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Vendor Payment</h1>
                    </div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <?php if (!empty($error)) { ?>
                                <div class="alert alert-danger fade in"><?= $error; ?></div>
                            <?php } ?>
                            <?php if (!empty($message)) { ?>
                                <div class="alert alert-success fade in"><?= $message; ?></div>
                            <?php } ?>
                            <?php echo form_open(current_url(), array(
                                'id' => 'frmvendorpay',
                                'role' => 'form'
                            )); ?>
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
                                <input class="form-control" placeholder="Enter Amount" name="payamount" autofocus required>
                            </div>
							<div class="form-group  required">
                                <label>Transaction Reference</label>
                                <input class="form-control" placeholder="Enter Transaction Reference Number" name="payreference" required>
                            </div>
                            <div class="form-group  required">
                                <label>Bank A/c. Number</label>
                                <input class="form-control" placeholder="Enter Bank A/c. Number" name="paybankacno" id="paybankacno" required>
                            </div>
							<div class="form-group  required">
                                <label>Bank Name</label>
                                <input class="form-control" placeholder="Enter Bank Name" name="paybankname" id="paybankname" required>
                            </div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<button type="submit" href="<?=site_url('admin/payment')?>" class="btn btn-primary" name="btnSave" id="btnSave" value="save">Save</button>
							</div>
						</div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    
