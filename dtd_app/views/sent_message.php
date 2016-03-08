<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Messages Sent:</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table id="c_sent_msg" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sr.no</th>
                            <th>To</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sr.no</th>
                            <th>To</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Delete</th>
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
<?php if($current_page == 'customer' && $current_action == 'sent_message') { ?>
    <script>
        var table;
        $(document).ready(function(){

            table = $('#c_sent_msg').dataTable( {
                "sDom": '<"top"pl>rt<"bottom"><"clear">',
                "aaSorting": [[4, "desc"]],
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                },
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "<?=site_url('ajax/c_sent_msg');?>",
                "sPaginationType": "listbox",
                "responsive" : true,
                "columns": [
                    { "data": null, "width": "10%" },
                    { "data": "msg_to", "width": "10%" },
                    { "data": "msg_title", "width": "20%" },
                    { "data": "msg_desc", "width": "50%" },
                    { "data": "msg_date", "width": "10%" },
                    { "data": "msg_id" },
                ],
                "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    var index = iDisplayIndex +1;
                    $('td:eq(0)',nRow).html(index);
                    return nRow;
                },
                "drawCallback" : function(){
                    $('.delete_item').click(function(){
                        $msg_id = $(this).data('msgid');
                        $isDelete = confirm('Are you sure you want to delete this message?');
                        if($isDelete){
                            $.ajax({
                                type:'POST',
                                url: '<?=site_url("ajax/delete_rec_message");?>',
                                dataType: 'json',
                                data: {msg_id : $msg_id},
                                success:function(data, textStatus, jqXHR){
                                    table.fnDraw(false);
                                }
                            });
                        }
                    });
                },
            });

            // Setup - add a text input to each footer cell
            $('#c_sent_msg tfoot th').each( function () {
                //var title = $('#example thead th').eq( $(this).index() ).text();
                if($(this).index() != 4 ){
                    $(this).html( txtsearch );
                }else{
                    $(this).html( datesearch );
                }

            } );

        });

    </script>
<?php } ?>

<?php if($current_page == 'vendor' && $current_action == 'sent_message') { ?>
    <script>
        var table;
        $(document).ready(function(){


            table = $('#c_sent_msg').dataTable( {
                "sDom": '<"top"pl>rt<"bottom"><"clear">',
                "aaSorting": [[4, "desc"]],
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                },
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "<?=site_url('ajax/v_sent_msg');?>",
                "sPaginationType": "listbox",
                "responsive" : true,
                "columns": [
                    { "data": null, "width": "10%" },
                    { "data": "msg_to", "width": "10%" },
                    { "data": "msg_title", "width": "20%" },
                    { "data": "msg_desc", "width": "50%" },
                    { "data": "msg_date", "width": "10%" },
                    { "data": "msg_id" },
                ],
                "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    var index = iDisplayIndex +1;
                    $('td:eq(0)',nRow).html(index);
                    return nRow;
                },
                "drawCallback" : function(){
                $('.delete_item').click(function(){
                    $msg_id = $(this).data('msgid');
                    $isDelete = confirm('Are you sure you want to delete this message?');
                    if($isDelete){
                        $.ajax({
                            type:'POST',
                            url: '<?=site_url("ajax/delete_rec_message");?>',
                            dataType: 'json',
                            data: {msg_id : $msg_id},
                            success:function(data, textStatus, jqXHR){
                                table.fnDraw(false);
                            }
                        });
                    }
                });
            },
            } );

            // Setup - add a text input to each footer cell
            $('#c_sent_msg tfoot th').each( function () {
                //var title = $('#example thead th').eq( $(this).index() ).text();
                if($(this).index() != 3 ){
                    $(this).html( txtsearch );
                }else{
                    $(this).html( datesearch );
                }

            } );
        });
    </script>
<?php } ?>

<?php if($current_page == 'admin' && $current_action == 'sent_message') { ?>
    <script>
        var table;
        $(document).ready(function(){


            table = $('#c_sent_msg').dataTable( {
                "sDom": '<"top"pl>rt<"bottom"><"clear">',
                "aaSorting": [[4, "desc"]],
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                },
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "<?=site_url('ajax/a_sent_msg');?>",
                "sPaginationType": "listbox",
                "responsive" : true,
                "columns": [
                    { "data": null, "width": "10%" },
                    { "data": "msg_to", "width": "10%" },
                    { "data": "msg_title", "width": "20%" },
                    { "data": "msg_desc", "width": "50%" },
                    { "data": "msg_date", "width": "10%" },
                    { "data": "msg_id" },
                ],
                "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    var index = iDisplayIndex +1;
                    $('td:eq(0)',nRow).html(index);
                    return nRow;
                },
                "drawCallback" : function() {
                    $('.delete_item').click(function () {
                        $msg_id = $(this).data('msgid');
                        $isDelete = confirm('Are you sure you want to delete this message?');
                        if ($isDelete) {
                            $.ajax({
                                type: 'POST',
                                url: '<?=site_url("ajax/delete_rec_message");?>',
                                dataType: 'json',
                                data: {msg_id: $msg_id},
                                success: function (data, textStatus, jqXHR) {
                                    table.fnDraw(false);
                                }
                            });
                        }
                    });
                },
            } );

        });

        // Setup - add a text input to each footer cell
        $('#c_sent_msg tfoot th').each( function () {
            //var title = $('#example thead th').eq( $(this).index() ).text();
            if($(this).index() != 4 ){
                $(this).html( txtsearch );
            }else{
                $(this).html( datesearch );
            }

        } );
    </script>
<?php } ?>