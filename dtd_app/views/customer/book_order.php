<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Delivery Request</h1>
            </div>

            <?php if(!empty($error)) { ?>
                <div class="alert alert-danger fade in"><?=$error;?></div>
            <?php } ?>
            <?php echo form_open('customer/book_order', array(
                'id' => 'frmbook_order',
                'role' => 'form'
            ));?>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Recipient Name*</label>
                        <input class="form-control" placeholder="Enter Name" name="recname" id="recname" autofocus>
                    </div>
                    <!-- <div class="form-group">
                        <label>Zip Code*</label>
                        <input class="form-control" placeholder="Enter ZipCode" name="zipcode">
                    </div> -->
                    <div class="form-group">
                        <label>Recipient Address*</label>
                        <textarea class="form-control" placeholder="Enter Address" rows="3" name="address" id="address"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input class="form-control" placeholder="Enter Mobile Number" name="mobile" id="mobile">
                    </div>
                    <div class="form-group">
                        <label>Telephone Number</label>
                        <input class="form-control" placeholder="Enter Telephone Number" name="telephone" id="telephone">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">




                    <div class="form-group">
                        <label>Date</label>
                        <input class="form-control datepicker" placeholder="Click to Select Date" name="oda" id="oda" value="<?php echo date('d-m-Y'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Item Type</label>
                        <?php
                        $attributes = 'class = "form-control" id = "item_type" name="item_type" ';
                        echo form_dropdown('item_type',$item_type,set_value('item_type'),$attributes);?>
                    </div>


                    <div class="form-group">
                        <label>Item Name</label>
                        <input class="form-control" placeholder="Enter Item Name" name="itemname" id="itemname">
                    </div>
                    <div class="form-group">
                        <label>Item Description</label>
                        <textarea class="form-control" placeholder="Description" rows="3" name="itemdesc" id="itemdesc"></textarea>
                    </div>


                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Memo</label>
                        <textarea class="form-control" placeholder="Memo" rows="3" name="itemmemo" id="itemmemo"></textarea>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="btnOrder" id="btnOrder" value="Book Order">
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

    
