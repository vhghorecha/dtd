       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Customer Money Deposit</h1>
                    </div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
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
                                    $attributes = 'class="form-control" name="custname" required autofocus';
                                    echo form_dropdown('custname',$customers,set_value('custname'),$attributes);
                                ?>
                            </div>
							<div class="form-group required">
                                <label>Date of Deposit</label>
                                <input class="form-control datepicker" placeholder="Click to Select Date" name="depositdate" required>
                            </div>
							<div class="form-group required">
                                <label>Amount</label>
                                <input class="form-control" placeholder="Enter Amount" name="depamount" autofocus required>
                            </div>
							<div class="form-group required">
                                <label>Transaction Reference</label>
                                <input class="form-control" placeholder="Enter Transaction Reference Number" name="depreference" required>
                            </div>
							
							<div class="form-group required">
                                <label>Bank Name</label>
                                <input class="form-control" placeholder="Enter Bank Name" name="depbank" required>
                            </div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <!--daily deposit report -->
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<button type="submit" href="<?=site_url('admin/deposit')?>" class="btn btn-primary" name="btnDeposit" id="btnDeposit" value="Deposit">Deposit</button>
							</div>
						</div>
					</form>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    
