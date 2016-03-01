<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Confirm Order</h1>
            </div>
            <div class="col-lg-12">
            <?php echo form_open(current_url(), array(
                'id' => 'frmregistration',
                'role' => 'form'
            )); ?>
            <fieldset>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Recipient Name*</label>
                        <input class="form-control" name="recname" id="recname" readonly>
                    </div>
                    <div class="form-group">
                        <label>Recipient Address*</label>
                        <textarea class="form-control" rows="3" name="address" id="address" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input class="form-control" name="mobile" id="mobile" readonly>
                    </div>
                    <div class="form-group">
                        <label>Telephone Number</label>
                        <input class="form-control" name="telephone" id="telephone" readonly>
                    </div>
                    <div class="form-group">
                        <label>Order Date</label>
                        <input class="form-control" name="oda" id="oda" readonly>
                    </div>
                    <div class="form-group">
                        <label>Order Date</label>
                        <input class="form-control" name="item_type" id="item_type" readonly>
                    </div>
                    <div class="form-group">
                        <label>Item Name</label>
                        <input class="form-control" name="itemname" id="itemname" readonly>
                    </div>
                    <div class="form-group">
                        <label>Item Description</label>
                        <textarea class="form-control" rows="3" name="itemdesc" id="itemdesc" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label>Memo</label>
                        <textarea class="form-control" rows="3" name="itemmemo" id="itemmemo" readonly></textarea>
                    </div>

                </div>
                </fieldset>

                </form>
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