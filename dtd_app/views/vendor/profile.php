<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Profile</h1>
            </div>
        </div>
        <?php if(!empty($error)) { ?>
            <div class="alert alert-danger fade in"><?=$error;?></div>
        <?php } ?>
        <?php echo form_open('vendor/profile', array(
            'id' => 'frmprofile',
            'role' => 'form'
        ));?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Basic Information
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Description</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Vendor Name</td>
                                    <td><input class="form-control" value="<? echo $profile['user_name']; ?>" name="username" id="username"></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><? echo $profile['user_email']; ?></td>
                                </tr>
                                <tr>
                                    <td>Contact No</td>
                                    <td><input class="form-control" value="<? echo $profile['user_mob']; ?>" name="usermob" id="usermob"></td>
                                </tr>
                                <tr>
                                    <td>Mailing Address</td>
                                    <td><input class="form-control" value="<? echo $profile['user_add']; ?>" name="useradd" id="useradd"></td>
                                </tr>
                                <tr>
                                    <td>Zip Code</td>
                                    <td><input class="form-control" value="<? echo $profile['user_zipcode']; ?>" name="userzip" id="userzip"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-6 -->
        </div>

        <!-- /.col-lg-12 -->
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Address
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Description</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Company Name</td>
                                    <td><input class="form-control" value="<? echo $profile['vendor_comp']; ?>" name="compname" id="compname"></td>
                                </tr>
                                <tr>
                                    <td>Office HQ1</td>
                                    <td><input class="form-control" value="<? echo $profile['vendor_hq1']; ?>" name="hq1" id="hq1"></td>
                                </tr>
                                <tr>
                                    <td>Office HQ2</td>
                                    <td><input class="form-control" value="<? echo $profile['vendor_hq2']; ?>" name="hq2" id="hq2"></td>
                                </tr>
                                <tr>
                                    <td>Office HQ3</td>
                                    <td><input class="form-control" value="<? echo $profile['vendor_hq3']; ?>" name="hq3" id="hq3"></td>
                                </tr>
                                <tr>
                                    <td>Site URL</td>
                                    <td><input class="form-control" value="<? echo $profile['user_site']; ?>" name="usersite" id="usersite"></td>
                                </tr>
                                <tr>
                                    <td>Tax Registration Number</td>
                                    <td><? echo $profile['vendor_taxno']; ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Memo
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Memo</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input class="form-control" value="<? echo $profile['user_memo']; ?>" name="umemo" id="umemo"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-lg-12">
            <div class="form-group">
                <input type="submit" value="Update Profile" class="btn btn-primary" name="btnEditProfile" id="btnEditProfile" />
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

    
