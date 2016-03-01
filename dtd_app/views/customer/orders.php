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
                        <th>Tracking Code</th>
                        <th>Status</th>
                        <th>Modify</th>
                        <th class="none">Reason</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Recipient Name</th>
                        <th>Mobile No</th>
                        <th>Parcel Type</th>
                        <th>Tracking Code</th>
                        <th>Status</th>
                        <th>Modify</th>
                        <th class="none">Reason</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <?php /*<div class="row">
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
    </div>*/?>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Today's Order
                </div>
                <div class="panel-body">
                    <div class="form-inline text-center">
                        <label>Day:</label>
                        <input type="text" id="daypicker" class="form-control datepicker" placeholder="Date" value="<?=date('d/m/Y');?>"/>
                    </div>
                    <table id="example" class="table dttable table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>No. of Order</th>
                            <th>Charge</th>

                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td id="daycount"><?php echo $today['count']; ?></td>
                            <td id="daysum"><?php echo $today['sum']; ?></td>

                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Monthly Order
                </div>
                <div class="panel-body">
                    <div class="form-inline text-center">
                        <label>Month:</label>
                        <input type="text" class="form-control mdatepicker" size="7" placeholder="Month" value="<?=date('Y-m');?>"/>
                    </div>
                    <table id="example" class="table dttable table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Total Order</th>
                            <th>Delivered</th>
                            <th>Pending</th>

                            <th>Charge</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td id="tmonthcount"><?php echo $month['monthcount']; ?></td>
                            <td id="tdeliver"><?php echo $month['deliver']; ?></td>
                            <td id="tpending"><?php echo $month['pending']; ?></td>
                            <td id="tamount"><?php echo $month['amount']; ?></td>
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
<?php $this->load->view('scripts'); ?>

    <script>
        var table;
        $(document).ready(function(){
            table = $('#c_orders').dataTable( {
                "sDom": '<"top"pl>rt<"bottom"><"clear">',
                "aaSorting": [[0, "desc"]],
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                },
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "<?=site_url('ajax/c_orders');?>",
                "responsive" : true,
                "columns": [
                    { "data": "order_id" },
                    { "data": "order_date" },
                    { "data": "order_recipient" },
                    { "data": "order_telno" },
                    { "data": "type_name" },
                    { "data": "order_updatecode" },
                    { "data": "order_status" },
                    { "data" : "modify"},
                    { "data" : "vendor_reason"},
                ],
            } );

            // Setup - add a text input to each footer cell
            $('#c_orders tfoot th').each( function () {
                //var title = $('#example thead th').eq( $(this).index() ).text();
                if($(this).index() != 1 ){
                    $(this).html( txtsearch );
                }else{
                    $(this).html( datesearch );
                }

            } );

            $('.mdatepicker').change(function(){
                $.ajax({
                    type:'POST',
                    url: '<?=site_url("ajax/c_monthly");?>',
                    dataType: 'json',
                    data: {month : $(this).val()},
                    success:function(data, textStatus, jqXHR){
                        $('#tmonthcount').html(data.monthcount);
                        $('#tdeliver').html(data.deliver);
                        $('#tpending').html(data.pending);
                        $('#tamount').html(data.amount);
                    }
                });
            });

            $('#daypicker').change(function(){
                $.ajax({
                    type:'POST',
                    url: '<?=site_url("ajax/c_today");?>',
                    dataType: 'json',
                    data: {day : $(this).val()},
                    success:function(data, textStatus, jqXHR){
                        $('#daycount').html(data.count);
                        $('#daysum').html(data.sum);
                    }
                });
            });

        });

    </script>