<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Your Orders:</h1>
            </div>
        </div>
        <div class="row" >
            <div class="col-lg-12">
                <div id="cbo_items" class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
                <div id="cbo_status"  class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table id="c_orders" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Sr.no</th>
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
                        <th>Sr.no</th>
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
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Daily Order by Status (Last 15 Days Only)
                </div>
                <div class="panel-body">
                    <table id="example" class="table table-striped table-bordered dttable" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Pending</th>
                            <th>InProcess</th>
                            <th>Delivered</th>
                            <th>Returned</th>
                            <th>Total</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach($today as $t) { ?>
                            <tr>
                                <td><?=$t['ord_date']; ?></td>
                                <td><?=$t['pending']; ?></td>
                                <td><?=$t['processing']; ?></td>
                                <td><?=$t['delivered']; ?></td>
                                <td><?=$t['returned']; ?></td>
                                <td><?=$t['total']; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th><?=array_sum(array_column($today,'pending')); ?></th>
                                <th><?=array_sum(array_column($today,'processing')); ?></th>
                                <th><?=array_sum(array_column($today,'delivered')); ?></th>
                                <th><?=array_sum(array_column($today,'returned')); ?></th>
                                <th><?=array_sum(array_column($today,'total')); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Daily Order by Item (Last 15 Days Only)
                </div>
                <div class="panel-body">
                    <table id="example" class="table table-striped table-bordered dttable" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Month</th>
                            <th>Delivered</th>
                            <?php foreach($item_types as $it) { ?>
                                <th><?=$it->type_name;?></th>
                            <?php } ?>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach($today_bi as $t) { ?>
                            <tr>
                                <td><?=$t['date']; ?></td>
                                <td><?=$t['delivered']; ?></td>
                                <?php foreach($item_types as $it) { ?>
                                    <td><?=$t[$it->type_name];?></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        </tbody>

                        <tfoot>
                        <tr>
                            <th>Total</th>
                            <th><?=array_sum(array_column($today_bi,'delivered')); ?></th>
                            <?php foreach($item_types as $it) { ?>
                                <th><?=array_sum(array_column($today_bi,$it->type_name));?></th>
                            <?php } ?>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="panel-footer">

                </div>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Monthly Order
                </div>
                <div class="panel-body">
                    <table id="example" class="table table-striped table-bordered dttable" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Month</th>
                            <th>Delivered</th>
                            <?php foreach($item_types as $it) { ?>
                                <th><?=$it->type_name;?></th>
                            <?php } ?>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach($month as $t) { ?>
                            <tr>
                                <td><?=$t['month']; ?></td>
                                <td><?=$t['delivered']; ?></td>
                                <?php foreach($item_types as $it) { ?>
                                    <td><?=$t[$it->type_name];?></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        </tbody>

                        <tfoot>
                        <tr>
                            <th>Total</th>
                            <th><?=array_sum(array_column($month,'delivered')); ?></th>
                            <?php foreach($item_types as $it) { ?>
                                <th><?=array_sum(array_column($month,$it->type_name));?></th>
                            <?php } ?>
                        </tr>
                        </tfoot>
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
            var items = $.parseJSON('<?=$items;?>');
            var status_val = $.parseJSON('<?=$status_val;?>');

            table = $('#c_orders').dataTable( {
                "sDom": '<"top"pl>rt<"bottom"><"clear">',
                "aaSorting": [[1, "desc"]],
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                },
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "<?=site_url('ajax/c_orders');?>",
                "sPaginationType": "listbox",
                "responsive" : true,
                "columns": [
                    { "data": null },
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

                "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    var index = iDisplayIndex +1;
                    $('td:eq(0)',nRow).html(index);
                    return nRow;
                },

                "initComplete": function(settings, json) {
                    this.api().columns(4).every( function () {
                        var column = this;
                        var select = $('<select><option value="">Search Item</option></select>')
                            .appendTo( $('#cbo_items').empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search( val  )
                                    .draw();
                            } );

                        $.each( items, function( index, value ){
                            select.append( '<option value="'+value.type_name+'">'+value.type_name+'</option>' )
                        } );
                    } );


                    this.api().columns(6).every( function () {
                        var column = this;
                        var select = $('<select><option value="">Search Status</option></select>')
                            .appendTo( $('#cbo_status').empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search( val  )
                                    .draw();
                            } );

                        $.each( status_val, function( index, value ){
                            select.append( '<option value="'+value.order_status+'">'+value.order_status+'</option>' )
                        } );
                    } );


                },
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
        });

    </script>