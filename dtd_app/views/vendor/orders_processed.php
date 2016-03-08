<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Orders Processed:</h1>
            </div>
        </div>
        <div class="row" >
            <div class="col-lg-12">
                <div id="cbo_items" class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
                <div id="cbo_customer" class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h3>Delivered Orders</h3>
                <table id="v_ord_del" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Sr.no</th>
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
                        <th>Sr.no</th>
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
                <div class="pull-right">
                    <a href="<?=site_url('vendor/upload_code')?>" class="btn btn-primary">Upload Code</a>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php $this->load->view('scripts'); ?>

    <script>
        var table;
        var items = $.parseJSON('<?=$items;?>');
        var customers = $.parseJSON('<?=$customers;?>');
        $(document).ready(function(){

            table = $('#v_ord_del').dataTable( {
                "sDom": '<"top"pl>rt<"bottom"><"clear">',
                "aaSorting": [[1, "desc"]],
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                },
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "<?=site_url('ajax/v_ord_del');?>",
                "sPaginationType": "listbox",
                "responsive" : true,
                "drawCallback" : function(){
                    $('.update_order').click(function(){
                        $('#update_res').html('');
                        $('#up_code').val('');
                        $('#up_orderid').val($(this).data('orderid'));
                        $('#pop_up_order').modal('show');
                    });
                },
                "columns": [
                    { "data": null },
                    { "data": "ord_date" },
                    { "data": "order_id" },
                    { "data": "user_name" },
                    { "data": "order_recipient" },
                    { "data": "order_address" },
                    { "data": "order_zipcode" },
                    { "data": "order_telno" },
                    { "data": "type_name" },
                    { "data": "order_itemname" },
                    { "data": "order_status" },
                ],
                "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    var index = iDisplayIndex +1;
                    $('td:eq(0)',nRow).html(index);
                    return nRow;
                },

                "initComplete": function(settings, json) {



                    this.api().columns(7).every( function () {
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

                },


            } );

            // Setup - add a text input to each footer cell
            $('#v_ord_del tfoot th').each( function () {
                //var title = $('#example thead th').eq( $(this).index() ).text();
                if($(this).index() != 0 ){
                    $(this).html( txtsearch );
                }else{
                    $(this).html( datesearch );
                }

            } );
        });

    </script>

