<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Item Price</h1>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?php if (!empty($error)) { ?>
                    <div class="alert alert-danger fade in"><?= $error; ?></div>
                <?php } ?>
                <?php if (!empty($message)) { ?>
                    <div class="alert alert-success fade in"><?= $message; ?></div>
                <?php } ?>
                <?php echo form_open(current_url(), array(
                    'id' => 'frmitemprice',
                    'role' => 'form'
                )); ?>
                <div class="form-group required">
                    <label>Item Type</label>
                    <input class="form-control" placeholder="Enter Price" name="itemtype" value='<?php echo $type_name; ?>' id="itemtype" readonly>
                </div>
                <div class="form-group required">
                    <label>Price</label>
                    <input class="form-control" placeholder="Enter Price" name="price" id="price" value='<?php echo $gi_price; ?>' required>
                </div>
                <input type="hidden" name="giid" value='<?php echo $gi_id; ?>'>
                <div class="form-group">
                    <button type="submit" href="<?=site_url('admin/item')?>" class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update">Update</button>
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


