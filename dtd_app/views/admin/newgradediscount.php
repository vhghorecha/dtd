       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">New Grade Discount</h1>
                    </div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <?php if (!empty($error)) { ?>
                                <div class="alert alert-danger fade in"><?= $error; ?></div>
                            <?php } ?>
                            <?php if (!empty($message)) { ?>
                                <div class="alert alert-success fade in"><?= $message; ?></div>
                            <?php } ?>
                            <?php echo form_open(current_url(), array(
                                'id' => 'frmaddgrade',
                                'role' => 'form'
                            )); ?>
                            <div class="form-group required">
                                <label>From Date</label>
                                <input class="form-control datepicker" placeholder="Click to Select From Date" name="frmdate" id="frmdate" required>
                            </div>
                            <div class="form-group required">
                                <label>To Date</label>
                                <input class="form-control datepicker" placeholder="Click to Select To Date" name="todate" id="todate" required>
                            </div>
                            <div class="form-group required">
                                <label>No. of Orders</label>
                                <input class="form-control" placeholder="Enter Item Price" name="nooforders" id="nooforders" required>
                            </div>
                            <div class="form-group required">
                                <label>Grade Name</label>
                                <?PHP
                                    $attributes = 'class="form-control" name="gradename" required autofocus';
                                    echo form_dropdown('gradename',$grades,set_value('gradename'),$attributes);
                                ?>
                            </div>
							<div class="form-group required">
                                <label>Discount</label>
                                <input class="form-control" placeholder="Enter Discount" name="discount" id="discount" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" href="<?=site_url('admin/newgradediscount')?>" class="btn btn-primary" name="btnSave" id="btnSave" value="save">Save</button>
                                <a href="<?=site_url('admin/price')?>"><button type="button" class="btn btn-primary" name="btnBack" id="btnBack" value="Back">Back</button></a>
                            </div>
						</div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    
