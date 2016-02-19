<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Order</h1>
            </div>

            <?php if(!empty($error)) { ?>
                <div class="col-xs-12"><div class="alert alert-danger fade in"><?=$error;?></div></div>
            <?php } ?>
            <?php
            if(!empty($msg)){
                echo '<div class="col-xs-12"><div class="alert alert-success fade in">'.$msg.'</div></div>';
            }
            ?>
            <?php echo form_open('customer/editorder/' . $order['order_id'], array(
                'id' => 'frmupdate_order',
                'role' => 'form'
            ));?>

            <div class="col-xs-12">


                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Recipient Name*</label>
                        <input class="form-control" placeholder="Enter Name" name="recname" id="recname" value="<?=$order['order_recipient'];?>" autofocus>
                    </div>
                    <!-- <div class="form-group">
                        <label>Zip Code*</label>
                        <input class="form-control" placeholder="Enter ZipCode" name="zipcode">
                    </div> -->
                    <div class="form-group">
                        <label>Recipient Address*</label>
                        <textarea class="form-control" placeholder="Enter Address" rows="3" name="address" id="address"><?=$order['order_address'];?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input class="form-control" placeholder="Enter Mobile Number" name="mobile" id="mobile" value="<?=$order['order_mobno'];?>">
                    </div>
                    <div class="form-group">
                        <label>Telephone Number</label>
                        <input type="text" class="form-control" placeholder="Enter Telephone Number" name="telephone" id="telephone" value="<?=$order['order_telno'];?>">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                    <div class="form-group">
                        <label>Date</label>
                        <input class="form-control datepicker" placeholder="Click to Select Date" name="oda" id="oda" value="<?=$order['order_date'];?>" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label>Item Type</label>
                        <input class="form-control" placeholder="" name="itemtype" id="itemtype" value="<?=$order['type_name'];?>" readonly>
                    </div>


                    <div class="form-group">
                        <label>Item Name</label>
                        <input class="form-control" placeholder="Enter Item Name" name="itemname" id="itemname" value="<?=$order['order_itemname'];?>">
                    </div>
                    <div class="form-group">
                        <label>Item Description</label>
                        <textarea class="form-control" placeholder="Description" rows="3" name="itemdesc" id="itemdesc"><?=$order['order_desc'];?></textarea>
                    </div>


                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Memo</label>
                        <textarea class="form-control" placeholder="Memo" rows="3" name="itemmemo" id="itemmemo"><?=$order['order_memo'];?></textarea>
                    </div>
                </div>


                <div class="col-lg-12">

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="btnUpdateOrder" id="btnUpdateOrder" value="Update Order">
                        </div>

                </div>
                <input type="hidden" name="order_id" value=" <?=$order['order_id'];?>">
                </form>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

    
