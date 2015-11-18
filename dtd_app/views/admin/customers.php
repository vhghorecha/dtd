<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Customer List:</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">

                        </div>
                        <div class="panel-body">
                            <table id="a_customers" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Telephone No</th>
                                        <th>Compnay Name</th>
                                        <th>Representive Name</th>
                                        <th>Website</th>
                                        <th>Staff Name</th>
                                        <th>Staff Telephone</th>
                                        <th>Balance</th>
                                        <th class="all">Area Code</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Telephone No</th>
                                    <th>Compnay Name</th>
                                    <th>Representive Name</th>
                                    <th>Website</th>
                                    <th>Staff Name</th>
                                    <th>Staff Telephone</th>
                                    <th>Balance</th>
                                    <th class="all">Area Code</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="panel-footer">

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<div class="modal fade" role="dialog" id="pop_up_user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header alert alert-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Update User</h4>
            </div>
            <div class="modal-body">
                <div id="update_res"></div>
                <input type="hidden" id="up_userid"/>
                <input type="text" id="up_areacode" name="up_areacode" placeholder="Enter Area Code" />
                <input type="button" id="btn_up_code" name="btn_up_code" value="Update"/>
            </div>
        </div>
    </div>
</div>