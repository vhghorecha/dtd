<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">New Item Pricing</h1>
            </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?php if (!empty($error)) { ?>
                        <div class="alert alert-danger fade in"><?= $error; ?></div>
                    <?php } ?>
                    <?php if (!empty($message)) { ?>
                        <div class="alert alert-success fade in"><?= $message; ?></div>
                    <?php } ?>
                    <?php echo form_open(current_url(), array(
                        'id' => 'frmadditem',
                        'role' => 'form'
                    )); ?>
                    <div class="form-group required">
                        <label>Item Type Name</label>
                        <?PHP
                            $attributes = 'class="form-control" name="itemtype" required autofocus';
                            echo form_dropdown('itemtype',$itemtypes,set_value('itemtype'),$attributes);
                        ?>
                    </div>
                    <div class="form-group required">
                        <label>Price</label>
                        <input class="form-control" placeholder="Enter Item Price" name="itemprice" id="itemprice" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" href="<?=site_url('admin/newitemprice')?>" class="btn btn-primary" name="btnSave" id="btnSave" value="save">Save</button>
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
<?php $this->load->view("scripts"); ?>