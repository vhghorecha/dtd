<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Vendor Payment</h1>
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
                    <label>Vendor Name</label>
                    <?=$user_name;?>
                </div>
                <div class="form-group required">
                    <label>Date of payment</label>
                    <input class="form-control datepicker" placeholder="Click to Select Date" name="paymentdate" id="paymentdate" value="<?=$pay_date;?>" required>
                </div>
                <div class="form-group required">
                    <label>Amount</label>
                    <?=$pay_amount;?>
                </div>
                <div class="form-group ">
                    <label>Transaction Reference</label>
                    <input class="form-control" placeholder="Enter Transaction Reference Number" name="depreference" id="depreference" value="<?=$pay_transno;?>">
                </div>

                <div class="form-group ">
                    <label>Bank Name</label>
                    <input class="form-control" placeholder="Enter Bank Name" name="depbank" id="depbank" value="<?=$pay_bankname;?>">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="btnPayment" id="btnPayment" value="Update">Update</button>
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
<?php $this->load->view("scripts"); ?>