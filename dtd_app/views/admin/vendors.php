<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Vendor List:</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">

                        </div>
                        <div class="panel-body">
                            <table id="a_vendors" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Sr.no</th>
                                    <th>User ID</th>
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
                                    <th class="all">Area Code</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Sr.no</th>
                                    <th>User ID</th>
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
                                    <th class="all">Area Code</th>
                                </tr>
                                </tfoot>
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
<div class="modal fade" role="dialog" id="pop_up_user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header alert alert-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Update User</h4>
            </div>
            <div class="modal-body">
                <div id="update_res"></div>
                <input type="hidden" id="up_userid"/>
                <input type="text" id="up_areacode" name="up_areacode" placeholder="Enter Area Code" />
                <input type="button" id="btn_up_code" name="btn_up_code" value="Update"/>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view("scripts"); ?>


    <script>
        $(document).ready(function(){
            $('#btn_up_code').click(function(){
                $userid = $('#up_userid').val();
                $up_code = $('#up_areacode').val();
                $.ajax({
                    type:'POST',
                    url: '<?=site_url("ajax/update_areacode");?>',
                    dataType: 'json',
                    data: {user_id : $userid, up_areacode : $up_code},
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
        });
        var table = $('#a_vendors').dataTable( {
            "sDom": '<"top"pl>rt<"bottom"><"clear">',
            "aaSorting": [[1, "desc"]],
            "oLanguage": {
                "sLengthMenu": "_MENU_ records per page"
            },
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "<?=site_url('ajax/a_vendors');?>",
            "sPaginationType": "listbox",
            "responsive" : true,
            "columns": [
                { "data": null },
                { "data": "user_id" },
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
                { "data": "user_areacode"},
            ],
            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                var index = iDisplayIndex +1;
                $('td:eq(0)',nRow).html(index);
                return nRow;
            },
            "drawCallback" : function(){
                $('.update_area_code').click(function(){
                    $('#update_res').html('');
                    $('#up_areacode').val($(this).data('userarea'));
                    $('#up_userid').val($(this).data('userid'));
                    $('#pop_up_user').modal('show');
                });
            },
        } );
        // Setup - add a text input to each footer cell
        $('#a_vendors tfoot th').each( function () {
            $(this).html( txtsearch );
        } );
    </script>

