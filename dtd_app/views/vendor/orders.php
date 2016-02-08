<?php $attributes = array('id' => 'frmorders');
    echo form_open('',$attributes);
?>
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
                        <th>Status</th>
                        <th>Company Name</th>
                        <th>Representive Name</th>

                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Date</th>
                        <th>Order id</th>
                        <th>Customer</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Item type</th>
                        <th>Item name</th>
                        <th>Status</th>
                        <th>Company Name</th>
                        <th>Representive Name</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Today's Order
                    </div>
                    <div class="panel-body">
                        <div class="form-inline text-center">
                            <label>Day:</label>
                            <input type="text" id="daypicker" name="day" class="form-control datepicker" placeholder="Date" value="<?=set_value('day',date('d/m/Y'));?>"/>
                        </div>
                        <table id="v_ord_d" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th rowspan="2">Date</th>
                                    <th rowspan="2">Customer</th>
                                    <th colspan="4"><center>Order Received</center></th>
                                </tr>
                                <tr>
                                    <th>No. of Delivered</th>
                                    <th>No. of Processing</th>
                                    <th>No. of Pending</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <?PHP $totDeliverd=0; $totProcessing=0; $totPending=0; $grandTotal=0; ?>

                            <tbody>
                                <?php foreach($daily as $order){?>
                                <tr>
                                    <td><?php echo $order['date']; ?></td>
                                    <td><?php echo $order['cust_name']; ?></td>
                                    <td><center><?php if($order['delivered']!=""){
                                                        echo $order['delivered'];
                                                        $totDeliverd += 0 + $order['delivered'];
                                                      } else echo "0";?></center></td>
                                    <td><center><?php if($order['processing']!="") {
                                                echo $order['processing'];
                                                $totProcessing += 0 + $order['processing'];
                                            }else echo "0";?></center></td>
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
                                <th></th>
                                <th></th>
                                <th><center><?PHP echo $totDeliverd;?></center></th>
                                <th><center><?PHP echo $totProcessing;?></center></th>
                                <th><center><?PHP echo $totPending;?></center></th>
                                <th><center><?PHP echo $grandTotal;?></center></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Monthly Order
                    </div>
                    <div class="panel-body">
                        <div class="form-inline text-center">
                            <label>Month:</label>
                            <input type="text" name="month" class="form-control mdatepicker" size="7" placeholder="Month" value="<?=set_value('month',date('Y-m'));?>"/>
                        </div>
                        <table id="v_ord_m" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th rowspan="2">Month</th>
                                <th rowspan="2">Customer</th>
                                <th colspan="4"><center>Order Received</center></th>
                            </tr>
                            <tr>
                                <th>No. of Delivered</th>
                                <th>No. of Processing</th>
                                <th>No. of Pending</th>
                                <th>Sub Total</th>
                            </tr>
                            </thead>
                            <?PHP $totDeliverd=0; $totProcessing=0; $totPending=0; $grandTotal=0; ?>
                            <tbody>
                            <?php foreach($monthly as $order){?>
                                <tr>
                                    <td><?php echo $order['date']; ?></td>
                                    <td><?php echo $order['cust_name']; ?></td>
                                    <td><center><?php if($order['delivered']!=""){
                                                echo $order['delivered'];
                                                $totDeliverd += 0 + $order['delivered'];
                                            } else echo "0";?></center></td>
                                    <td><center><?php if($order['processing']!="") {
                                                echo $order['processing'];
                                                $totProcessing += 0 + $order['processing'];
                                            }else echo "0";?></center></td>
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
                                <th><center></center></th>
                                <th><center></center></th>
                                <th><center><?PHP echo $totDeliverd;?></center></th>
                                <th><center><?PHP echo $totProcessing;?></center></th>
                                <th><center><?PHP echo $totPending;?></center></th>
                                <th><center><?PHP echo $grandTotal;?></center></th>
                            </tr>
                            </tfoot>
                        </table>
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
<?php echo form_close();?>