       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Edit Vendor Price</h1>
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
                            <input class="form-control" placeholder="Vendor Name" id="vendname" name="vendname" value="<?=$edit['user_name']; ?>" readonly>
                        </div>
                        <div class="form-group required">
                            <label>Item Type</label>
                            <input class="form-control" placeholder="Vendor Name" id="itemtype" name="itemtype" value="<?=$edit['type_name']; ?>" readonly>
                        </div>
                        <div class="form-group required">
                            <label>Price</label>
                            <input class="form-control" placeholder="Enter Amount" id="price" name="price" value="<?=$edit['gp_price']; ?>" required>
                        </div>
                        <input type="hidden" name="vpid" value="<?=$edit['vp_id'];?>">

                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <button type="submit" href="<?=site_url('admin/editvendorprice')?>" class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update">Update</button>
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

    
