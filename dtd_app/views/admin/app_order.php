<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Approve Order
            </div>
            <div class="panel-body">
                <div id="update_res"></div>
                <table id="a_app_ord" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Order id</th>
                        <th>Customer</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Item type</th>
                        <th>Item name</th>
                        <th>Company Name</th>
                        <th>Representive Name</th>
                        <th>Status</th>
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
                        <th>Company Name</th>
                        <th>Representive Name</th>
                        <th>Status</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                Approved Order
            </div>
            <div class="panel-body">
                <table id="a_appd_ord" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Order id</th>
                        <th>Customer</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Item type</th>
                        <th>Item name</th>
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
                        <th>Company Name</th>
                        <th>Representive Name</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('scripts'); ?>


    <script>
        $(document).ready(function(){
            var table = $('#a_app_ord').dataTable( {
                "sDom": '<"top"pl>rt<"bottom"><"clear">',
                "aaSorting": [[1, "desc"]],
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                },
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "<?=site_url('ajax/a_app_ord');?>",
                "responsive" : true,
                "drawCallback" : function(){
                    $('.approve_order').click(function(){
                        $orderid = $(this).data('orderid');
                        $.ajax({
                            type:'POST',
                            url: '<?=site_url("ajax/approve_order");?>',
                            dataType: 'json',
                            data: {order_id : $orderid},
                            success:function(data, textStatus, jqXHR){
                                if(typeof data.message !== 'undefined'){
                                    $('#update_res').html('<div class="alert alert-success">' + data.message + '</div>')
                                }else{
                                    $('#update_res').html('<div class="alert alert-error">' + data.error + '</div>')
                                }
                                table.fnDraw(false);
                            }
                        });
                    });
                },
                "columns": [
                    { "data": "ord_date" },
                    { "data": "order_id" },
                    { "data": "user_name" },
                    { "data": "order_recipient" },
                    { "data": "order_telno" },
                    { "data": "type_name" },
                    { "data": "order_itemname" },
                    { "data": "user_comp" },
                    { "data": "user_rep" },
                    { "data": "order_status" },
                ]
            } );

            // Setup - add a text input to each footer cell
            $('#a_app_ord tfoot th').each( function () {
                //var title = $('#example thead th').eq( $(this).index() ).text();
                if($(this).index() != 0 ){
                    $(this).html( txtsearch );
                }else{
                    $(this).html( datesearch );
                }

            } );

            var table2 = $('#a_appd_ord').dataTable( {
                "sDom": '<"top"pl>rt<"bottom"><"clear">',
                "aaSorting": [[1, "desc"]],
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                },
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "<?=site_url('ajax/a_appd_ord');?>",
                "responsive" : true,
                "columns": [
                    { "data": "ord_date" },
                    { "data": "order_id" },
                    { "data": "user_name" },
                    { "data": "order_recipient" },
                    { "data": "order_telno" },
                    { "data": "type_name" },
                    { "data": "order_itemname" },
                    { "data": "user_comp" },
                    { "data": "user_rep" },
                ]
            } );

            // Setup - add a text input to each footer cell
            $('#a_appd_ord tfoot th').each( function () {
                //var title = $('#example thead th').eq( $(this).index() ).text();
                if($(this).index() != 0 ){
                    $(this).html( txtsearch );
                }else{
                    $(this).html( datesearch );
                }

            } );
        });

    </script>


