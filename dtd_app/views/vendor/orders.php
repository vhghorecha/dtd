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
                        <th>Address</th>
                        <th>Zipcode</th>
                        <th>Phone</th>
                        <th>Item type</th>
                        <th>Item name</th>
                        <th>Status</th>

                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Date</th>
                        <th>Order id</th>
                        <th>Customer</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Zipcode</th>
                        <th>Phone</th>
                        <th>Item type</th>
                        <th>Item name</th>
                        <th>Status</th>
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
<?php $this->load->view('scripts'); ?>


    <script>
        $(document).ready(function(){
            var table = $('#v_ord_rec').dataTable( {
                "sDom": '<"top"pl>rt<"bottom"><"clear">',
                "aaSorting": [[1, "desc"]],
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                },
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "<?=site_url('ajax/v_orders');?>",
                "responsive" : true,
                "columns": [
                    { "data": "ord_date" },
                    { "data": "order_id" },
                    { "data": "user_name" },
                    { "data": "order_recipient" },
                    { "data": "order_address" },
                    { "data": "order_zipcode" },
                    { "data": "order_telno" },
                    { "data": "type_name" },
                    { "data": "order_itemname" },
                    { "data": "order_status" }

                ]
            } );

            // Setup - add a text input to each footer cell
            $('#v_ord_rec tfoot th').each( function () {
                //var title = $('#example thead th').eq( $(this).index() ).text();
                if($(this).index() != 0 ){
                    $(this).html( txtsearch );
                }else{
                    $(this).html( datesearch );
                }
            } );

            var v_ord_d = $('#v_ord_d').dataTable( {
                "bProcessing": true,
                "responsive" : true,
            } );

            // Setup - add a text input to each footer cell
            $('#v_ord_d tfoot th').each( function () {
                //var title = $('#example thead th').eq( $(this).index() ).text();
                if($(this).index() == 0){
                    $(this).html( datesearch );
                }

                if($(this).index() == 1){
                    $(this).html( txtsearch );
                }
            } );

            v_ord_d.DataTable().columns().every( function () {
                var that = this;
                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );

            var v_ord_m = $('#v_ord_m').dataTable( {
                "bProcessing": true,
                "responsive" : true,
            } );

            $('#v_ord_m tfoot th').each( function () {
                //var title = $('#example thead th').eq( $(this).index() ).text();
                if($(this).index() == 0 || $(this).index() == 1 ){
                    $(this).html( txtsearch );
                }
            } );

            v_ord_m.DataTable().columns().every( function () {
                var that = this;
                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );

            $('.mdatepicker').change(function(){
                $('#frmorders').submit();
            });

            $('#daypicker').change(function(){
                $('#frmorders').submit();
            });
        })


    </script>

