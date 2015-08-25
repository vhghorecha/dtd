<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Change Password</h1>
            </div>

            <?php echo form_open('vendor/change_pwd', array(
                'id' => 'frmchangepwd',
                'role' => 'form'
            ));?>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?php if(!empty($msg)) {
                        echo '<div class="alert';
                        if (!empty($error)) {
                            echo ' alert-danger';
                        } else {
                            echo ' alert-success';
                        }
                        echo ' fade in">' . $msg . "</div>";
                    }
                    ?>
                    <div class="form-group">
                        <label>Old Password*</label>
                        <input class="form-control" placeholder="Enter Old Password" type="password" id="oldpwd" name="oldpwd" autofocus>
                    </div>
                    <div class="form-group">
                        <label>New Password*</label>
                        <input class="form-control" placeholder="Enter New Password" type="password" id="newpwd" name="newpwd">
                    </div>
                    <div class="form-group">
                        <label>Cofirm Password*</label>
                        <input class="form-control" placeholder="Re-type New Password" type="password" id="confirmpwd" name="confirmpwd">
                    </div>

                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="btnChange" id="btnChange" value="Change">
                        </div>
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


