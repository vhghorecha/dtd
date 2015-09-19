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
                                    <td><input class="form-control" value="<? echo $profile['user_name']; ?>" name="username" id="username"></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><? echo $profile['user_email']; ?></td>
                                </tr>
                                <tr>
                                    <td>Telephone Number</td>
                                    <td><input class="form-control" value="<? echo $profile['user_tel']; ?>" name="usertel" id="usertel"></td>
                                </tr>
                                <tr>
                                    <td>Mobile Number</td>
                                    <td><input class="form-control" value="<? echo $profile['user_mob']; ?>" name="usermob" id="usermob"></td>
                                </tr>
                                <tr>
                                    <td>Website</td>
                                    <td><input class="form-control" value="<? echo $profile['user_site']; ?>" name="usersite" id="usersite"></td>
                                </tr>
                                <tr>
                                    <td>Staff Name</td>
                                    <td><input class="form-control" value="<? echo $profile['user_staffname']; ?>" name="userstaff" id="userstaff"></td>
                                </tr>
                                <tr>
                                    <td>Staff Telephone No</td>
                                    <td><input class="form-control" value="<? echo $profile['user_stafftel']; ?>" name="userstafftel" id="userstafftel"></td>
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
                        Address Information
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

    
