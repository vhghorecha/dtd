       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Vendor Price</h1>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php if (!empty($error)) { ?>
                            <div class="alert alert-danger fade in"><?= $error; ?></div>
                        <?php } ?>
                        <?php if (!empty($message)) { ?>
                            <div class="alert alert-success fade in"><?= $message; ?></div>
                        <?php } ?>
                        <?php echo form_open(current_url(), array(
                            'id' => 'frmvendorprice',
                            'role' => 'form'
                        )); ?>
                        <div class="form-group required">
                            <label>Vendor Name</label>
                            <?PHP
                                $attributes = 'class="form-control" id="vendname" name="vendname" required autofocus';
                                echo form_dropdown('vendname',$vendors,set_value('vendname'),$attributes);
                            ?>
                        </div>
                        <div class="form-group required">
                            <label>Item Type</label>
                            <?PHP
                                $attributes = 'class="form-control" id="itemtype" name="itemtype" required';
                                echo form_dropdown('itemtype',$itemtypes,set_value('itemtype'),$attributes);
                            ?>
                        </div>
                        <div class="form-group required">
                            <label>Price</label>
                            <input class="form-control" placeholder="Enter Amount" id="price" name="price" required>
                        </div>

                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <button type="submit" href="<?=site_url('admin/vendorprice')?>" class="btn btn-primary" name="btnSave" id="btnSave" value="save">Save</button>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    
