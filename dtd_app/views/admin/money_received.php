<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Money Received:</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <table id="a_mon_rec" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Sr.no</th>
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Amount</th>
                                <th>Transaction Number</th>
                                <th>Bank Name</th>
                            </tr>
                            </thead>

                            <tfoot>
                            <tr>
                                <th>Sr.no</th>
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Amount</th>
                                <th>Transaction Number</th>
                                <th>Bank Name</th>
                            </tr>
                            </tfoot>
                        </table>
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
<?php $this->load->view('scripts'); ?>


    <script>
        var table;
        $(document).ready(function(){
            table = $('#a_mon_rec').dataTable( {
                "sDom": '<"top"pl>rt<"bottom"><"clear">',
                "aaSorting": [[1, "desc"]],
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                },
                "bProcessing": true,
                "sPaginationType": "listbox",
                "bServerSide": true,
                "sAjaxSource": "<?=site_url('ajax/a_mon_rec');?>",
                "responsive" : true,


                "columns": [
                    { "data": null },
                    { "data": "ddate" },
                    { "data": "user_name" },
                    { "data": "dep_amount" },
                    { "data": "dep_transno" },
                    { "data": "dep_bankname" },
                ],
                "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    var index = iDisplayIndex +1;
                    $('td:eq(0)',nRow).html(index);
                    return nRow;
                },
            } );

            // Setup - add a text input to each footer cell
            $('#a_mon_rec tfoot th').each( function () {
                //var title = $('#example thead th').eq( $(this).index() ).text();
                if($(this).index() != 0 ){
                    $(this).html( txtsearch );
                }else{
                    $(this).html( datesearch );
                }

            } );

        });

    </script>

