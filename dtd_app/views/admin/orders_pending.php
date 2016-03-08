<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Orders Pending:</h1>
            </div>
        </div>
        <div class="row" >
            <div class="col-lg-12">
                <div id="cbo_items" class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
                <div id="cbo_status"  class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
                <div id="cbo_customer"  class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
                <div id="cbo_vendor"  class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
            </div>
        </div>
        <div class="row">
            <table id="a_ord_pen" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Sr.no</th>
                    <th>Date</th>
                    <th>Order id</th>
                    <th>Customer</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Item type</th>
                    <th>Item name</th>
                    <th>Vendor</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Sr.no</th>
                    <th>Date</th>
                    <th>Order id</th>
                    <th>Customer</th>
                    <th>Recepient</th>
                    <th>Phone</th>
                    <th>Item type</th>
                    <th>Item name</th>
                    <th>Vendor</th>
                    <th>Status</th>
                </tr>
                </tfoot>
            </table>

        </div>
        <br/>
        <!-- /.col-lg-12 -->

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
            var customers = $.parseJSON('<?=$customers;?>');
            var vendors = $.parseJSON('<?=$vendors;?>');
            //========================================
            table = $('#a_ord_pen').dataTable( {
                "sDom": '<"top"pl>rt<"bottom"i><"clear">',
                "aaSorting": [[2, "desc"]],
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                },
                "bProcessing": true,
                "bServerSide": true,
                "sPaginationType": "listbox",
                "sAjaxSource": "<?=site_url('ajax/a_ord_pen');?>",
                "responsive" : true,

                "columns": [
                    { "data": null },
                    { "data": "ord_date" },
                    { "data": "order_id" },
                    { "data": "cust_name" },
                    { "data": "order_recipient" },
                    { "data": "order_telno" },
                    { "data": "type_name" },
                    { "data": "order_itemname" },
                    { "data": "vendor_name" },
                    { "data": "order_status" },
                ],
                "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    var index = iDisplayIndex +1;
                    $('td:eq(0)',nRow).html(index);
                    return nRow;
                },
                "initComplete": function(settings, json) {



                    this.api().columns(5).every( function () {
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


                    this.api().columns(8).every( function () {
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

                    this.api().columns(2).every( function () {
                        var column = this;
                        var select = $('<select><option value="">Search Customer</option></select>')
                            .appendTo( $('#cbo_customer').empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search( val  )
                                    .draw();
                            } );

                        $.each( customers, function( index, value ){
                            select.append( '<option value="'+value.user_name+'">'+value.user_name+'</option>' )
                        } );
                    } );

                    this.api().columns(7).every( function () {
                        var column = this;
                        var select = $('<select><option value="">Search Vendor</option></select>')
                            .appendTo( $('#cbo_vendor').empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search( val  )
                                    .draw();
                            } );

                        $.each( vendors, function( index, value ){
                            select.append( '<option value="'+value.user_email+'">'+value.user_email+'</option>' )
                        } );
                    } );



                },


            } );

            // Setup - add a text input to each footer cell
            $('#a_ord_pen tfoot th').each( function () {
                //var title = $('#example thead th').eq( $(this).index() ).text();
                if($(this).index() != 0 ){
                    $(this).html( txtsearch );
                }else{
                    $(this).html( datesearch );
                }

            } );
            //========================================
        });

    </script>

