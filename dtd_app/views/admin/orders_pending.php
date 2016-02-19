<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Orders Pending:</h1>
            </div>
        </div>
        <div class="row">
            <table id="a_ord_pen" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Order id</th>
                    <th>Customer</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Item type</th>
                    <th>Item name</th>
                    <th>Company name</th>
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
                    <th>Company name</th>
                    <th>Company Name</th>
                    <th>Representive Name</th>

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
        $(document).ready(function(){
            //========================================
            var table = $('#a_ord_pen').dataTable( {
                "sDom": '<"top"pl>rt<"bottom"><"clear">',
                "aaSorting": [[1, "desc"]],
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                },
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "<?=site_url('ajax/a_ord_pen');?>",
                "responsive" : true,

                "columns": [
                    { "data": "ord_date" },
                    { "data": "order_id" },
                    { "data": "user_name" },
                    { "data": "order_recipient" },
                    { "data": "order_telno" },
                    { "data": "type_name" },
                    { "data": "order_itemname" },
                    { "data": "user_sercomp" },
                    { "data": "user_comp" },
                    { "data": "user_rep" },

                ]
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

