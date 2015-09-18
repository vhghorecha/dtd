<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Orders Received:</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table id="v_ord_rec" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Order id</th>
                        <th>Customer</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Item type</th>
                        <th>Item name</th>
                        <th>Company name</th>
                        <th>Phone</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                </table>
                <a href="<?=site_url('vendor/download')?>" class="btn btn-primary pull-right">Download</a>
            </div>
            <!-- /.col-lg-12 -->
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Daily Statistics
                        </div>
                        <div class="panel-body">
                            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>No. of Order</th>
                                    <th>Charge amount</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th colspan="2">Total</th>
                                    <th>XXXX</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer">

                        </div>
                    </div>
                </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->