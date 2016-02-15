<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Delivery Request</h1>
            </div>

            <?php if(!empty($error)) { ?>
                <div class="col-xs-12"><div class="alert alert-danger fade in"><?=$error;?></div></div>
            <?php } ?>
            <?php $msg = $this->session->flashdata('msg');
                if(!empty($msg)){
                    echo '<div class="col-xs-12">'.$msg.'</div>';
                }
            ?>
            <?php echo form_open($action, array(
                'id' => 'frmbook_order',
                'role' => 'form'
            ));?>
            <?php if($action == 'customer/cnf_order') { ?>
                <div class="col-xs-12">
                    <div class="panel panel-primary">

                        <div class="panel-heading">
                            Your Account Statistics
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="disabledSelect">Total Number of Order (Today)</label>
                                <input class="form-control" id="disabledInput" type="text" placeholder="" name="todayno" value="<?php echo $today['count']; ?>"
                                       disabled>
                            </div>
                            <div class="form-group">
                                <label for="disabledSelect">Total Charges (Today)</label>
                                <input class="form-control" id="disabledInput" type="text" placeholder="" name="todaycharge" value="<?php echo $today['sum']; ?>"
                                       disabled>
                            </div>
                            <div class="form-group">
                                <label for="disabledSelect">Total Number of Order (Current Month)</label>
                                <input class="form-control" id="disabledInput" type="text" placeholder="" name="monthlyno" value="<?php echo $month['monthcount']; ?>"
                                       disabled>
                            </div>
                            <div class="form-group">
                                <label for="disabledSelect">Total Charges (Current Month)</label>
                                <input class="form-control" id="disabledInput" type="text" placeholder="" name="monthlycharge" value="<?php echo $month['amount']; ?>"
                                       disabled>
                            </div>
                            <div class="form-group">
                                <label for="disabledSelect">Balance</label>
                                <input class="form-control" type="text" name="balance" id="balance" value="<?php echo $balance; ?>"
                                       readonly>
                            </div>
                            <div class="form-group">
                                <label for="disabledSelect">Current Order Charge</label>
                                <input class="form-control" type="text" name="currentcharge" id="currentcharge" value="<?php echo round($charge,2); ?>" readonly>
                            </div>
                        </div>
                        <div class="panel-footer">

                        </div>
                </div>
            <?php } ?>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Recipient Name*</label>
                        <input class="form-control" placeholder="Enter Name" name="recname" id="recname" value="<?=set_value('recname');?>" autofocus>
                    </div>
                    <!-- <div class="form-group">
                        <label>Zip Code*</label>
                        <input class="form-control" placeholder="Enter ZipCode" name="zipcode">
                    </div> -->
                    <div class="form-group">
                        <label>Recipient Address*</label>
                        <textarea class="form-control" placeholder="Enter Address" rows="3" name="address" id="address"><?=set_value('address');?></textarea>
                    </div>

                    <!--div class="form-group">
                        <label>Mobile Number</label>
                        <input class="form-control" placeholder="Enter Mobile Number" name="mobile" id="mobile" value="<?=set_value('mobile');?>">
                    </div-->
                    <div class="form-group">
                        <label>Telephone Number</label>
                        <input class="form-control" placeholder="Enter Telephone Number" name="telephone" id="telephone" value="<?=set_value('telephone');?>">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                    <div class="form-group">
                        <label>Date</label>
                        <input class="form-control" readonly="readonly" placeholder="Click to Select Date" name="oda" id="oda" value="<?php echo date('d-m-Y'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Item Type</label>
                        <?php
                        $attributes = 'class = "form-control" id = "item_type" name="item_type" ';
                        echo form_dropdown('item_type',$item_type,set_value('item_type'),$attributes);?>
                    </div>


                    <div class="form-group">
                        <label>Item Name</label>
                        <input class="form-control" placeholder="Enter Item Name" name="itemname" id="itemname" value="<?=set_value('itemname');?>">
                    </div>
                    <!--div class="form-group">
                        <label>Item Description</label>
                        <textarea class="form-control" placeholder="Description" rows="3" name="itemdesc" id="itemdesc">
                            <?=set_value('itemdesc');?>
                        </textarea>
                    </div-->


                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Memo</label>
                        <textarea class="form-control" placeholder="Memo" rows="3" name="itemmemo" id="itemmemo"><?=set_value('itemmemo');?></textarea>
                    </div>
                </div>


                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?php if($action == 'customer/cnf_order') { ?>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="btnCnfOrder" id="btnCnfOrder" value="Confirm Order">
                    </div>
                    <?php } else { ?>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="btnOrder" id="btnOrder" value="Book Order">
                        <a href="<?=site_url('customer/import_order')?>" class="btn btn-primary pull-right">Import Orders</a>
                    </div>
                    <?php } ?>
                </div>

            </form>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

    
