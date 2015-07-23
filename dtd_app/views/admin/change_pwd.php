<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Change Password</h1>
            </div>
            <form role="form">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Old Password*</label>
                        <input class="form-control" placeholder="Enter Old Password" name="oldpwd" autofocus>
                    </div>
                    <div class="form-group">
                        <label>New Password*</label>
                        <input class="form-control" placeholder="Enter New Password" name="newpwd">
                    </div>
                    <div class="form-group">
                        <label>Cofirm Password*</label>
                        <input class="form-control" placeholder="Re-type New Password" name="confirmpwd">
                    </div>

                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <button type="submit" href="<?= site_url('customer/change_pwd') ?>" class="btn btn-primary">
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


