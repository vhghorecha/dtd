<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Delivery Request</h1>
            </div>
            <form role="form">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Recipient Name*</label>
                        <input class="form-control" placeholder="Enter Name" name="recname" autofocus>
                    </div>
                    <!-- <div class="form-group">
                        <label>Zip Code*</label>
                        <input class="form-control" placeholder="Enter ZipCode" name="zipcode">
                    </div> -->
                    <div class="form-group">
                        <label>Recipient Address*</label>
                        <textarea class="form-control" placeholder="Enter Address" rows="3" name="address"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input class="form-control" placeholder="Enter Mobile Number" name="mobile">
                    </div>
                    <div class="form-group">
                        <label>Telephone Number</label>
                        <input class="form-control" placeholder="Enter Telephone Number" name="telephone">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">




                    <div class="form-group">
                        <label>Date</label>
                        <input class="form-control datepicker" placeholder="Click to Select Date" name="" value="<?php echo date('d-m-Y'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Item Type</label>
                        <select class="form-control" name="itemtype">
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Item Name</label>
                        <input class="form-control" placeholder="Enter Item Name" name="itemname">
                    </div>
                    <div class="form-group">
                        <label>Item Description</label>
                        <textarea class="form-control" placeholder="Description" rows="3" name="itemdesc"></textarea>
                    </div>


                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <button type="submit" href="<?= site_url('customer/confirm_order') ?>" class="btn btn-primary">
                            Save
                        </button>
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

    
