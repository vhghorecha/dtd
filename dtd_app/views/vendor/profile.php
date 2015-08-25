<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Profile</h1>
            </div>
        </div>
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
                                    <td><?= $user_name; ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?= $user_email; ?></td>
                                </tr>
                                <tr>
                                    <td>Contact No</td>
                                    <td><?= $user_mob; ?></td>
                                </tr>
                                <tr>
                                    <td>Mailing Address</td>
                                    <td><?= $user_add; ?></td>
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
                                    <td><?= $vendor_comp; ?></td>
                                </tr>
                                <tr>
                                    <td>Office HQ1</td>
                                    <td><?= $vendor_hq1; ?></td>
                                </tr>
                                <tr>
                                    <td>Office HQ2</td>
                                    <td><?= $vendor_hq2; ?></td>
                                </tr>
                                <tr>
                                    <td>Office HQ3</td>
                                    <td><?= $vendor_hq3; ?></td>
                                </tr>
                                <tr>
                                    <td>Site URL</td>
                                    <td><?= $user_site; ?></td>
                                </tr>
                                <tr>
                                    <td>Tax Registration Number</td>
                                    <td><?= $vendor_taxno; ?></td>
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
                                        <td><?=$user_memo;?></td>
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
                <input type="submit" value="Edit Profile" class="btn btn-primary" name="btnEditProfile" id="btnEditProfile" />
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

    
