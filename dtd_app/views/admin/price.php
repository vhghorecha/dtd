<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Pricing Scheme</h1>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Item Price
                    </div>
                    <div class="panel-body">
                        <table id="a_item_price" class="table table-striped table-bordered example" cellspacing="0"
                               width="100%">
                            <thead>
                                <tr>
                                    <th>Sr.no</th>
                                    <th>Item Type</th>
                                    <th>Price</th>
                                    <th>Edit/Delete</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="panel-footer">
                        <a href="<?= site_url('admin/newitemprice'); ?>">New Item price</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Customer Grades and Discount
                    </div>
                    <div class="panel-body">
                        <table id="a_customer_grade" class="table table-striped table-bordered example" cellspacing="0"
                               width="100%">
                            <thead>
                                <tr>
                                    <th>Sr.no</th>
                                    <th>Term(Period)</th>
                                    <th>No. of Orders</th>
                                    <th>Grade</th>
                                    <th>Discount</th>
                                    <th>Edit/Delete</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="panel-footer">
                        <a href="<?= site_url('admin/newgradediscount'); ?>">New Grade Discount</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">


            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Vendor Price
                    </div>
                    <div class="panel-body">
                        <table id="a_vendor_price" class="table table-striped table-bordered example" cellspacing="0"
                               width="100%">
                            <thead>
                                <tr>
                                    <th>Sr.no</th>
                                    <th>Vendor Name</th>
                                    <th>Item Type</th>
                                    <th>Price</th>
                                    <th>Admin-Profit</th>
                                    <th>Edit / Delete</th>
                                </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Sr.no</th>
                                <th>Vendor Name</th>
                                <th>Item Type</th>
                                <th>Price</th>
                                <th>Admin-Profit</th>
                                <th>Edit / Delete</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="panel-footer">
                        <a href="<?= site_url('admin/vendorprice'); ?>">New Vendor Price</a>
                    </div>
                </div>
            </div>

        </div>


        <!-- /.col-lg-12 -->

        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php $this->load->view("scripts"); ?>


    <script>
        $(document).ready(function(){

            var table = $('#a_customer_grade').dataTable( {
                "sDom": '<"top"pl>rt<"bottom"><"clear">',
                "aaSorting": [[1, "asc"],[2, "asc"]],
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                },
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "<?=site_url('ajax/a_customer_grade');?>",
                "sPaginationType": "listbox",
                "responsive" : true,
                "columns": [
                    { "data": null},
                    { "data": "term"},
                    { "data": "gp_no_order" },
                    { "data": "grade_name" },
                    { "data": "gp_disc" },
                    { "data": "edit" },
                ],
                "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    var index = iDisplayIndex +1;
                    $('td:eq(0)',nRow).html(index);
                    return nRow;
                },
            } );

            var table2 = $('#a_item_price').dataTable( {
                "sDom": '<"top"pl>rt<"bottom"><"clear">',
                "aaSorting": [[1, "asc"],[2, "asc"]],
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                },
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "<?=site_url('ajax/a_item_price');?>",
                "sPaginationType": "listbox",
                "responsive" : true,
                "columns": [
                    { "data": null},
                    { "data": "type_name"},
                    { "data": "gi_price" },
                    { "data": "edit" },
                ],
                "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    var index = iDisplayIndex +1;
                    $('td:eq(0)',nRow).html(index);
                    return nRow;
                },
            } );

            var table3 = $('#a_vendor_price').dataTable( {
                "sDom": '<"top"pl>rt<"bottom"><"clear">',
                "aaSorting": [[1, "asc"]],
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                },
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "<?=site_url('ajax/a_vendor_price');?>",
                "responsive" : true,
                "columns": [
                    { "data": null},
                    { "data": "user_name"},
                    { "data": "type_name" },
                    { "data": "gp_price" },
                    { "data": "profit" },
                    { "data": "edit" },
                ],
                "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    var index = iDisplayIndex +1;
                    $('td:eq(0)',nRow).html(index);
                    return nRow;
                },
            } );
            // Setup - add a text input to each footer cell
            /* $('#a_vendor_price tfoot th').each( function () {
             $(this).html( txtsearch );
             } );*/
        });


    </script>

