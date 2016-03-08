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

    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php $this->load->view('scripts'); ?>

    <script>
        var table;
        $(document).ready(function(){
            var items = $.parseJSON('<?=$items;?>');
            table = $('#c_orders').dataTable( {
                "sDom": '<"top"pl>rt<"bottom"><"clear">',
                "aaSorting": [[1, "desc"]],
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                },
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "<?=site_url('ajax/c_ord_del');?>",
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