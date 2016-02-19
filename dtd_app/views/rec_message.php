<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Messages Received:</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table id="c_rec_msg" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>

                            <th>From</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Reply/Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>

                            <th>From</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Reply/Delete</th>
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
<?php $this->load->view("scripts"); ?>

<?php if($current_page == 'vendor' && $current_action == 'rec_message') { ?>
    <script>
        var table = $('#c_rec_msg').dataTable( {
            "sDom": '<"top"pl>rt<"bottom"><"clear">',
            "aaSorting": [[3, "desc"]],
            "oLanguage": {
                "sLengthMenu": "_MENU_ records per page"
            },
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "<?=site_url('ajax/v_rec_msg');?>",
            "responsive" : true,
            "columns": [

                { "data": "msg_from", "width": "15%" },
                { "data": "msg_title", "width": "25%" },
                { "data": "msg_desc", "width": "50%" },
                { "data": "msg_date", "width": "10%" },
                { "data": "msg_id" },
            ],
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
        $('#c_rec_msg tfoot th').each( function () {
            //var title = $('#example thead th').eq( $(this).index() ).text();
            if($(this).index() != 4 ){
                $(this).html( txtsearch );
            }else{
                $(this).html( datesearch );
            }

        } );
    </script>
<?php } ?>

<?php if($current_page == 'customer' && $current_action == 'rec_message') { ?>
    <script>
        $(document).ready(function(){

            var table = $('#c_rec_msg').dataTable( {
                "sDom": '<"top"pl>rt<"bottom"><"clear">',
                "aaSorting": [[3, "desc"]],
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                },
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "<?=site_url('ajax/c_rec_msg');?>",
                "responsive" : true,

                "columns": [

                    { "data": "msg_from", "width": "15%" },
                    { "data": "msg_title", "width": "25%" },
                    { "data": "msg_desc", "width": "50%" },
                    { "data": "m_date", "width": "10%" },
                    { "data": "msg_id" },

                ],
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
            $('#c_rec_msg tfoot th').each( function () {
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

<?php if($current_page == 'admin' && $current_action == 'rec_message') { ?>
    <script>
        var table = $('#c_rec_msg').dataTable( {
            "sDom": '<"top"pl>rt<"bottom"><"clear">',
            "aaSorting": [[3, "desc"]],
            "oLanguage": {
                "sLengthMenu": "_MENU_ records per page"
            },
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "<?=site_url('ajax/a_rec_msg');?>",
            "responsive" : true,
            "columns": [

                { "data": "msg_from", "width": "15%" },
                { "data": "msg_title", "width": "25%" },
                { "data": "msg_desc", "width": "40%" },
                { "data": "msg_date", "width": "10%" },
                { "data": "msg_id", "width": "10%" },
            ],
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
        $('#c_rec_msg tfoot th').each( function () {
            //var title = $('#example thead th').eq( $(this).index() ).text();
            if($(this).index() != 4 ){
                $(this).html( txtsearch );
            }else{
                $(this).html( datesearch );
            }

        } );
    </script>
<?php } ?>
    
