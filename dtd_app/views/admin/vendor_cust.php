<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Customer List of Vendor:</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">

                        </div>
                        <div class="panel-body">
                            <div id="cbo_vendor"></div>
                            <table id="a_vendor_customers" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Vendor</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Telephone No</th>
                                    <th>Compnay Name</th>
                                    <th>Representive Name</th>
                                    <th>Website</th>
                                    <th>Staff Name</th>
                                    <th>Staff Telephone</th>
                                    <th>Balance</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="panel-footer">

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php $this->load->view("scripts"); ?>

    <script>
        $(document).ready(function(){

            var vendors = $.parseJSON('<?=$vendors;?>');
            var table = $('#a_vendor_customers').dataTable( {
                    "sDom": '<"top"pl>rt<"bottom"><"clear">',
                    "aaSorting": [[0, "desc"]],
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ records per page"
                    },
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "<?=site_url('ajax/a_vendor_customers');?>",
                    "responsive" : true,
                    "columns": [
                        { "data": "vendor_id", "visible": false },
                        { "data": "user_name" },
                        { "data": "user_email" },
                        { "data": "user_add" },
                        { "data": "user_tel" },
                        { "data": "user_comp" },
                        { "data": "user_rep" },
                        { "data": "user_site" },
                        { "data": "user_staffname" },
                        { "data": "user_stafftel" },
                        { "data": "user_balance"},
                    ],
                    "initComplete": function(settings, json) {
                        this.api().columns(0).every( function () {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
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
                                select.append( '<option value="'+value.user_id+'">'+value.user_name+'</option>' )
                            } );
                        } );
                    },
                }
            );

        });

    </script>



