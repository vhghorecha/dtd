<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Your Orders</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h3>Daily Processing:</h3>
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th rowspan="2">Date</th>
                            <th rowspan="2">Customer</th>
                            <th colspan="3"><center>Order Received</center></th>
                        </tr>
                        <tr>
                            <th>No. of Delivered</th>
                            <th>No. of Pending</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <?PHP $totDeliverd=0; $totPending=0; $grandTotal=0; ?>

                    <tbody>
                        <?php foreach($daily as $order){?>
                        <tr>
                            <td><?php echo $order['date']; ?></td>
                            <td><?php echo $order['cust_name']; ?></td>
                            <td><center><?php if($order['delivered']!=""){
                                                echo $order['delivered'];
                                                $totDeliverd += 0 + $order['delivered'];
                                              } else echo "0";?></center></td>
                            <td><center><?php if($order['pending']!="") {
                                               echo $order['pending'];
                                                $totPending += 0 + $order['pending'];
                                              }else echo "0";?></center></td>
                            <td><center><?php echo $order['subtotal']; $grandTotal += 0 + $order['subtotal']; ?></center></td>
                        </tr>
                        <?php }?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="2"><center>Total</center></th>
                        <th><center><?PHP echo $totDeliverd;?></center></th>
                        <th><center><?PHP echo $totPending;?></center></th>
                        <th><center><?PHP echo $grandTotal;?></center></th>
                    </tr>
                    </tfoot>

                </table>
                <h3>Monthly Statistics:</h3>
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th rowspan="2">Month</th>
                        <th rowspan="2">Customer</th>
                        <th colspan="3"><center>Order Received</center></th>
                    </tr>
                    <tr>
                        <th>No. of Delivered</th>
                        <th>No. of Pending</th>
                        <th>Sub Total</th>
                    </tr>
                    </thead>
                    <?PHP $totDeliverd=0; $totPending=0; $grandTotal=0; ?>
                    <tbody>
                    <?php foreach($monthly as $order){?>
                        <tr>
                            <td><?php echo $order['date']; ?></td>
                            <td><?php echo $order['cust_name']; ?></td>
                            <td><center><?php if($order['delivered']!=""){
                                        echo $order['delivered'];
                                        $totDeliverd += 0 + $order['delivered'];
                                    } else echo "0";?></center></td>
                            <td><center><?php if($order['pending']!="") {
                                        echo $order['pending'];
                                        $totPending += 0 + $order['pending'];
                                    }else echo "0";?></center></td>
                            <td><center><?php echo $order['subtotal']; $grandTotal += 0 + $order['subtotal']; ?></center></td>
                        </tr>
                    <?php }?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="2"><center>Total</center></th>
                        <th><center><?PHP echo $totDeliverd;?></center></th>
                        <th><center><?PHP echo $totPending;?></center></th>
                        <th><center><?PHP echo $grandTotal;?></center></th>
                    </tr>
                    </tfoot>
                </table>

            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

    
