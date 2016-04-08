<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Customer Charges</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Daily Charges Summary
                    </div>
                    <div class="panel-body">
                        <table id="example" class="table table-striped table-bordered dttable" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Active Customer</th>
                                <th>Charge</th>
                                <?php foreach($item_types as $it) { ?>
                                    <th><?=$it->type_name;?></th>
                                <?php } ?>
                                <th>Returned</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach($today as $t) { ?>
                                <tr>
                                    <td><?=$t['ord_date']; ?></td>
                                    <td><?=$t['total_cust']; ?></td>
                                    <td><?=$t['total_amount']; ?></td>
                                    <?php foreach($item_types as $it) { ?>
                                        <td><?=$t[$it->type_name];?></td>
                                    <?php } ?>
                                    <td><?=$t['returned']; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Total</th>
                                <th><?=array_sum(array_column($today,'total_cust')); ?></th>
                                <th><?=array_sum(array_column($today,'total_amount')); ?></th>
                                <?php foreach($item_types as $it) { ?>
                                    <th><?=array_sum(array_column($today,$it->type_name));?></th>
                                <?php } ?>
                                <th><?=array_sum(array_column($today,'returned')); ?></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Daily Charges Summary By Customer
                    </div>
                    <div class="panel-body">
                        <table id="example" class="table table-striped table-bordered dttable" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Charge</th>
                                <?php foreach($item_types as $it) { ?>
                                    <th><?=$it->type_name;?></th>
                                <?php } ?>
                                <th>Returned</th>

                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach($today_cust as $t) { ?>
                                <tr>
                                    <td><?=$t['ord_date']; ?></td>
                                    <td><?=$t['user_name']; ?></td>
                                    <td><?=$t['total_amount']; ?></td>
                                    <?php foreach($item_types as $it) { ?>
                                        <td><?=$t[$it->type_name];?></td>
                                    <?php } ?>
                                    <td><?=$t['returned']; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Total</th>
                                <th></th>
                                <th><?=array_sum(array_column($today_cust,'total_amount')); ?></th>
                                <?php foreach($item_types as $it) { ?>
                                    <th><?=array_sum(array_column($today_cust,$it->type_name));?></th>
                                <?php } ?>
                                <th><?=array_sum(array_column($today,'returned')); ?></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Monthly Charges Summary
                    </div>
                    <div class="panel-body">
                        <table id="example" class="table table-striped table-bordered dttable" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Month</th>
                                <th>Active Customer</th>
                                <th>Charge</th>
                                <?php foreach($item_types as $it) { ?>
                                    <th><?=$it->type_name;?></th>
                                <?php } ?>
                                <th>Pending</th>
                                <th>InProcess</th>
                                <th>Delivered</th>
                                <th>Returned</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach($month as $t) { ?>
                                <tr>
                                    <td><?=$t['month']; ?></td>
                                    <td><?=$t['total_cust']; ?></td>
                                    <td><?=$t['total_amount']; ?></td>
                                    <?php foreach($item_types as $it) { ?>
                                        <td><?=$t[$it->type_name];?></td>
                                    <?php } ?>
                                    <td><?=$t['pending']; ?></td>
                                    <td><?=$t['processing']; ?></td>
                                    <td><?=$t['delivered']; ?></td>
                                    <td><?=$t['returned']; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Total</th>
                                <th><?=array_sum(array_column($month,'total_cust')); ?></th>
                                <th><?=array_sum(array_column($month,'total_amount')); ?></th>
                                <?php foreach($item_types as $it) { ?>
                                    <th><?=array_sum(array_column($month,$it->type_name));?></th>
                                <?php } ?>
                                <th><?=array_sum(array_column($month,'pending')); ?></th>
                                <th><?=array_sum(array_column($month,'processing')); ?></th>
                                <th><?=array_sum(array_column($month,'delivered')); ?></th>
                                <th><?=array_sum(array_column($month,'returned')); ?></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Outstanding Balance Summary
                    </div>
                    <div class="panel-body">
                        <table id="example" class="table table-striped table-bordered dttable" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Active Customer</th>
                                <th>Charge</th>
                                <th>Deposit</th>
                                <th>Outstanding</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach($outstanding as $t) { ?>
                                <tr>
                                    <td><?=$t['ord_date']; ?></td>
                                    <td><?=$t['total_cust']; ?></td>
                                    <td><?=$t['total_amount']; ?></td>
                                    <td><?=$t['deposit']; ?></td>
                                    <td><?=$t['outstanding']; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Total</th>
                                <th><?=array_sum(array_column($outstanding,'total_cust')); ?></th>
                                <th><?=array_sum(array_column($outstanding,'total_amount')); ?></th>
                                <th><?=array_sum(array_column($outstanding,'deposit')); ?></th>
                                <th><?=array_sum(array_column($outstanding,'outstanding')); ?></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
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