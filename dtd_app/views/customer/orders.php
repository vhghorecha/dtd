<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Your Orders:</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table id="c_orders" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Recipient Name</th>
                        <th>Mobile No</th>
                        <th>Parcel Type</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Today's Order
                </div>
                <div class="panel-body">
                    <table id="example" class="table dttable table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>No. of Order</th>
                            <th>Charge</th>

                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>No. of Order</th>
                            <th>Charge</th>
                        </tr>
                        </tfoot>

                        <tbody>
                        <tr>
                            <td><?php echo $today['count']; ?></td>
                            <td>$<?php echo $today['sum']; ?></td>

                        </tr>

                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Monthly Order
                </div>
                <div class="panel-body">
                    <table id="example" class="table dttable table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Total Order</th>
                            <th>Delivered</th>
                            <th>Pending</th>
                            <th>Charge</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>Total Order</th>
                            <th>Delivered</th>
                            <th>Pending</th>
                            <th>Charge</th>
                        </tr>
                        </tfoot>

                        <tbody>
                        <tr>
                            <td><?php echo $month['month-count']; ?></td>
                            <td><?php echo $month['deliver']; ?></td>
                            <td><?php echo $month['pending']; ?></td>
                            <td>$<?php echo $month['amount']; ?></td>

                        </tr>

                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">

                </div>
            </div>
        </div>
    </div>

    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

    
