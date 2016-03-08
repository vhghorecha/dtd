<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Money Paid:</h1>
            </div>
        </div>
        <div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <table id="a_mon_pay" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Sr.no</th>
                                    <th>Date</th>
                                    <th>Vendor Name</th>
                                    <th>Amount</th>
                                    <th>Transaction Number</th>
                                    <th>Bank Name</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th>Sr.no</th>
                                    <th>Date</th>
                                    <th>Vendor Name</th>
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
            table = $('#a_mon_pay').dataTable( {
                "sDom": '<"top"pl>rt<"bottom"><"clear">',
                "aaSorting": [[1, "desc"]],
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                },
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "<?=site_url('ajax/a_mon_pay');?>",
                "responsive" : true,
                "sPaginationType": "listbox",

                "columns": [
                    { "data": null },
                    { "data": "pdate" },
                    { "data": "user_name" },
                    { "data": "pay_amount" },
                    { "data": "pay_transno" },
                    { "data": "pay_bankname" },
                ],
                "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    var index = iDisplayIndex +1;
                    $('td:eq(0)',nRow).html(index);
                    return nRow;
                },
            } );

            // Setup - add a text input to each footer cell
            $('#a_mon_pay tfoot th').each( function () {
                //var title = $('#example thead th').eq( $(this).index() ).text();
                if($(this).index() != 0 ){
                    $(this).html( txtsearch );
                }else{
                    $(this).html( datesearch );
                }

            } );

        });

    </script>

