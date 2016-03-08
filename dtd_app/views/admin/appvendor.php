<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> New Vendor Registration List:</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">

                        </div>
                        <div class="panel-body">
                            <table id="a_pending_vendors" class="table table-striped table-bordered" cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>Sr.no</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Telephone No</th>
                                    <th>Company Name</th>
                                    <th>Representive Name</th>
                                    <th>Website</th>
                                    <th>Staff Name</th>
                                    <th>Staff Telephone</th>
                                    <th class="all">Approve</th>
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
<?php $this->load->view('scripts'); ?>

    <script>
     $(document).ready(function(){
         var table = $('#a_pending_vendors').dataTable( {
             "sDom": '<"top"pl>rt<"bottom"><"clear">',
             "aaSorting": [[1, "desc"]],
             "oLanguage": {
                 "sLengthMenu": "_MENU_ records per page"
             },
             "bProcessing": true,
             "bServerSide": true,
             "sAjaxSource": "<?=site_url('ajax/a_pending_vendors');?>",
             "sPaginationType": "listbox",
             "responsive" : true,
             "columns": [
                 { "data": null },
                 { "data": "user_name" },
                 { "data": "user_email" },
                 { "data": "user_add" },
                 { "data": "user_tel" },
                 { "data": "user_comp" },
                 { "data": "user_rep"},
                 { "data": "user_site" },
                 { "data": "user_staffname" },
                 { "data": "user_stafftel" },
                 { "data": "user_id" },
             ],
             "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                 var index = iDisplayIndex +1;
                 $('td:eq(0)',nRow).html(index);
                 return nRow;
             },
             "drawCallback" : function(){
                 $('.approve_user').click(function(){
                     $user_id = $(this).data('userid');
                     $isDelete = confirm('Are you sure you want to Approve?');
                     if($isDelete){
                         $.ajax({
                             type:'POST',
                             url: '<?=site_url("ajax/approve_user");?>',
                             dataType: 'json',
                             data: {user_id : $user_id},
                             success:function(data, textStatus, jqXHR){
                                 table.fnDraw(false);
                             }
                         });
                     }
                 });
             },
         } );

         // Setup - add a text input to each footer cell
         $('#a_pending_vendors tfoot th').each( function () {
             $(this).html( txtsearch );
         } );
     });

    </script>

