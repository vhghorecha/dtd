<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Profile</h1>
            </div>
        </div>
        <?php if(isset($error) && !empty($error)) { ?>
            <div class="alert alert-danger fade in"><?=$error;?></div>
        <?php } ?>
        <?php if(isset($errorb) && !empty($errorb)) { ?>
            <div class="alert alert-danger fade in"><?=$errorb;?></div>
        <?php } ?>
        <?php echo form_open('customer/profile', array(
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
                                    <td>Name</td>
                                    <td><input required class="form-control" value="<? echo $profile['user_name']; ?>" name="username" id="username"></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><? echo $profile['user_email']; ?></td>
                                </tr>
                                <tr>
                                    <td>Telephone Number</td>
                                    <td><input required class="form-control" value="<? echo $profile['user_tel']; ?>" name="usertel" id="usertel"></td>
                                </tr>
                                <tr>
                                    <td>Company Name</td>
                                    <td><input required  class="form-control" value="<? echo $profile['user_comp']; ?>" name="usercomp" id="usercomp"></td>
                                </tr>
                                <tr>
                                    <td>Representive Name</td>
                                    <td><input required class="form-control" value="<? echo $profile['user_rep']; ?>" name="userrep" id="userrep"></td>
                                </tr>
                                <tr>
                                    <td>Website</td>
                                    <td><input  class="form-control" value="<? echo $profile['user_site']; ?>" name="usersite" id="usersite"></td>
                                </tr>
                                <tr>
                                    <td>Staff Name</td>
                                    <td><input  class="form-control" value="<? echo $profile['user_staffname']; ?>" name="userstaff" id="userstaff"></td>
                                </tr>
                                <tr>
                                    <td>Staff Telephone No</td>
                                    <td><input  class="form-control" value="<? echo $profile['user_stafftel']; ?>" name="userstafftel" id="userstafftel"></td>
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
            <?php if(isset($errorc) && !empty($errorc)) { ?>
                <div class="alert alert-danger fade in"><?=$errorc;?></div>
            <?php } ?>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Company Information
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
                                    <td><input required class="form-control" value="<? echo $profile['user_sercomp']; ?>" name="sercomp" id="sercomp"></td>
                                </tr>
                                <tr>
                                    <td>Registration No.</td>
                                    <td><input  class="form-control" value="<? echo $profile['user_lob']; ?>" name="lob" id="lob"></td>
                                </tr>
                                <tr>
                                    <td>Line of Business</td>
                                    <td><input  class="form-control" value="<? echo $profile['user_regno']; ?>" name="regno" id="regno"></td>
                                </tr>
                                <tr>
                                    <td>Mailing Address</td>
                                    <td><input required class="form-control" value="<? echo $profile['user_add']; ?>" name="useradd" id="useradd"></td>
                                </tr>
                                <tr>
                                    <td>Zip Code</td>
                                    <td><input required class="form-control" value="<? echo $profile['user_zipcode']; ?>" name="userzip" id="userzip"></td>
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
            <?php if(isset($errorp) && !empty($errorp)) { ?>
                <div class="alert alert-danger fade in"><?=$errorp;?></div>
            <?php } ?>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Change Password
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Old Password*</label>
                                <input required class="form-control" placeholder="Enter Old Password" type="password" id="oldpwd" name="oldpwd">
                            </div>
                            <div class="form-group">
                                <label>New Password*</label>
                                <input required class="form-control" placeholder="Enter New Password" type="password" id="newpwd" name="newpwd">
                            </div>
                            <div class="form-group">
                                <label>Cofirm Password*</label>
                                    <input required class="form-control" placeholder="Re-type New Password" type="password" id="confirmpwd" name="confirmpwd">
                            </div>

                        </div>
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
                        Vendor Information
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td><?=$profile['vendor_name'];?></td><td><?=$profile['vendor_email'];?></td>
                                </tr>
                                <tr>
                                    <td><?=$profile['vendor_tel'];?></td><td><?=$profile['vendor_rep'];?></td>
                                </tr>
                                <tr>
                                    <td><?=$profile['vendor_add'];?></td><td><?=$profile['vendor_zipcode'];?></td>
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
                                <tbody>
                                <tr>
                                    <textarea class="form-control"rows="3" name="usermemo" id="usermemo"><? echo $profile['user_memo']; ?></textarea>
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
        </form>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

    
