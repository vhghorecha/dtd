<!-- Page Content -->
<div id="page-wrapper">
    <?php echo form_open(site_url('vendor/download'), array(
        'id' => 'frmvendorpay',
        'role' => 'form'
    )); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"> Orders Received:</h3>
            </div>
        </div>
        <div class="row" >
            <div class="col-lg-12">
                <div id="cbo_items" class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
                <div id="cbo_customer" class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
            </div>
        </div>

        <div class="row">
                <table id="v_ord_rec" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Sr.no</th>
                        <th><input type="checkbox" id="selallchk"/> Order id</th>
                        <th>Date</th>
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
                        <th>Order id</th>
                        <th>Date</th>
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
                <div class="col-xs-12">
                    <div class="pull-right">
                        <input type="submit" class="btn btn-primary" value="Download"/>
                        <a href="<?=site_url('vendor/download')?>" class="btn btn-primary">Download All</a>
                    </div>
                </div>
            </div>
            <br/>
            <!-- /.col-lg-12 -->
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Daily Statistics
                        </div>
                        <div class="panel-body">
                            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>No. of Order</th>
                                    <th>Charge amount</th>
                                </tr>
                                </thead>3
                                <tbody>
                                <?php foreach($dorders as $order){?>
                                    <tr>
                                        <td><?PHP echo $order['user_name']; ?></td>
                                        <td><?PHP echo $order['num']; ?></td>
                                        <td><?PHP echo $order['amount']; ?></td>
                                    </tr>
                                <?PHP }?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th><?PHP echo array_sum(array_column($dorders,'num'));?></th>
                                    <th><?PHP echo array_sum(array_column($dorders,'amount'));?></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="panel-footer">

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Daily Statistics on Item
                        </div>
                        <div class="panel-body">
                            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>No. of Order</th>
                                    <th>Charge amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($iorders as $order){?>
                                    <tr>
                                        <td><?PHP echo $order['type_name']; ?></td>
                                        <td><?PHP echo $order['num']; ?></td>
                                        <td><?PHP echo $order['amount']; ?></td>
                                    </tr>
                                <?PHP }?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th><?PHP echo array_sum(array_column($iorders,'num'));?></th>
                                    <th><?PHP echo array_sum(array_column($iorders,'amount'));?></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="panel-footer">

                        </div>
                    </div>
                </div>
        </div>
    </div>
    <?php echo form_close();?>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<div class="modal fade" role="dialog" id="pop_up_order">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header alert alert-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Update Order</h4>
            </div>
            <div class="modal-body">
                <div id="update_res"></div>
                <input type="hidden" id="up_orderid"/>
                <input type="text" id="up_code" name="up_code" placeholder="Enter Update Code" />
                <input type="button" id="btn_up_code" name="btn_up_code" value="Update"/>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('scripts'); ?>

    <script type="text/javascript" language="javascript" src="<?=RES_URL;?>js/jquery.fileDownload.js"></script>
    <script>
        $(document).ready(function(){
            $('#btn_up_code').click(function(){
                $orderid = $('#up_orderid').val();
                $up_code = $('#up_code').val();
                $.ajax({
                    type:'POST',
                    url: '<?=site_url("ajax/update_order");?>',
                    dataType: 'json',
                    data: {order_id : $orderid, up_code : $up_code},
                    success:function(data, textStatus, jqXHR){
                        if(typeof data.message !== 'undefined'){
                            $('#update_res').html('<div class="alert alert-success">' + data.message + '</div>')
                            table.fnDraw(false);
                            $('#pop_up_order').modal('hide');
                        }else{
                            $('#update_res').html('<div class="alert alert-error">' + data.error + '</div>')
                        }
                    }
                });
            });
        });
        var items = $.parseJSON('<?=$items;?>');
        var customers = $.parseJSON('<?=$customers;?>');
        var table = $('#v_ord_rec').dataTable( {
            "sDom": '<"top"pl>rt<"bottom"><"clear">',
            "bSort": false,
            "oLanguage": {
                "sLengthMenu": "_MENU_ records per page"
            },
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "<?=site_url('ajax/v_ord_rec');?>",
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
                { "data": "order_id" },
                { "data": "ord_date" },
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
        $('#v_ord_rec tfoot th').each( function () {
            //var title = $('#example thead th').eq( $(this).index() ).text();
            if($(this).index() != 1 ){
                $(this).html( txtsearch );
            }else{
                $(this).html( datesearch );
            }

        } );

        $("#selallchk").change(function(){
            $(".v_order_id").prop('checked', $(this).prop("checked"));
        });

        $(document).on("submit", "form#frmvendorpay", function (e) {
            e.preventDefault();
            var order_ids = [];
            $.each($("input[name='order_id']:checked"), function(){
                order_ids.push($(this).val());
            });
            $.fileDownload($(this).prop('action'), {
                httpMethod: "POST",
                data: {order_id: order_ids},
                successCallback: function (url) {
                    table.fnDraw();
                },
            });
        });

    </script>

