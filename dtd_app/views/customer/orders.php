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
                        <th>Modify</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Recipient Name</th>
                        <th>Mobile No</th>
                        <th>Parcel Type</th>
                        <th>Status</th>
                        <th>Modify</th>
                    </tr>
                    </tfoot>
                </table>
                <a href="<?=site_url('customer/import_order')?>" class="btn btn-primary pull-right">Import Orders</a>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Daily Processing:</h3>
            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th rowspan="2">Date</th>
                    <th rowspan="2">Type</th>
                    <th colspan="2"><center>Order Requested</center></th>
                </tr>
                <tr>
                    <th>Numbers</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <?PHP $totNum=0; $totAmt=0;?>

                <tbody>
                <?php foreach($daily as $order){?>
                    <tr>
                        <td><?php echo $order['date']; ?></td>
                        <td><?php echo $order['type_name']; ?></td>
                        <td><center><?php echo $order['subtotal'];
                                $totNum += 0 + $order['subtotal'];
                                ?></center></td>
                        <td><center><?php echo callback_format_amount($order['subamount']);
                                $totAmt += 0 + $order['subamount'];
                                ?></center></td>
                    </tr>
                <?php }?>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="2"><center>Total</center></th>
                    <th><center><?PHP echo $totNum;?></center></th>
                    <th><center><?PHP echo callback_format_amount($totAmt);?></center></th>
                </tr>
                </tfoot>

            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
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
                            <td><?php echo callback_format_amount($today['sum']); ?></td>

                        </tr>

                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">

                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
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

                            <td><?php echo callback_format_amount($month['amount']); ?></td>

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

    
