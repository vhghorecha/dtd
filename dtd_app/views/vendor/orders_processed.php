<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Orders Processed:</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th>Parcel Type</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>View</th>
                    </tr>
                    </thead>

                    <tfoot>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th>Parcel Type</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>View</th>
                    </tr>
                    </tfoot>

                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>20-07-2015</td>
                        <td>Hardik</td>
                        <td>A</td>
                        <td>$100</td>
                        <td><font color="red">Delivered</font></td>
                        <th><a href="<?=site_url('vendor/view_order');?>"><i class="fa fa-dashboard fa-fw">View</a></th>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>20-07-2015</td>
                        <td>Hardik</td>
                        <td>B</td>
                        <td>$100</td>
                        <td><font color="red">Delivered</font></td>
                        <th><a href="<?=site_url('vendor/view_order');?>"><i class="fa fa-dashboard fa-fw">View</a></th>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->