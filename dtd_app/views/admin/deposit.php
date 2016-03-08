       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Customer Money Deposit</h1>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <?php if (!empty($error)) { ?>
                                <div class="alert alert-danger fade in"><?= $error; ?></div>
                            <?php } ?>
                            <?php if (!empty($message)) { ?>
                                <div class="alert alert-success fade in"><?= $message; ?></div>
                            <?php } ?>
                            <?php echo form_open(current_url(), array(
                                'id' => 'frmdeposit',
                                'role' => 'form'
                            )); ?>
                        <div class="form-group  required">
                            <label>Customer Name</label>
                            <?PHP
                                $attributes = 'class="form-control" id="custname" name="custname" required autofocus';
                                echo form_dropdown('custname',$customers,set_value('custname'),$attributes);
                            ?>
                            <input type="hidden" name="hiddepid" id="hiddepid" value="0"/>
                        </div>
                        <div class="form-group required">
                            <label>Date of Deposit</label>
                            <input class="form-control datepicker" placeholder="Click to Select Date" name="depositdate" id="depositdate" required>
                        </div>
                        <div class="form-group required">
                            <label>Amount</label>
                            <input class="form-control" placeholder="Enter Amount" name="depamount"  id="depamount" required>
                        </div>
                        <div class="form-group ">
                            <label>Transaction Reference</label>
                            <input class="form-control" placeholder="Enter Transaction Reference Number" name="depreference" id="depreference">
                        </div>

                        <div class="form-group ">
                            <label>Bank Name</label>
                            <input class="form-control" placeholder="Enter Bank Name" name="depbank" id="depbank">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="btnDeposit" id="btnDeposit" value="Deposit">Deposit</button>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Daily Deposits from Customers
                            </div>
                            <div class="panel-body">
                                <table id="a_daily_deposits" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Sr.no</th>
                                        <th>Date</th>
                                        <th>Customer Name</th>
                                        <th>Amount</th>
                                        <th>Transaction No.</th>
                                        <th>Bank Name</th>
                                        <th>Edit/Delete</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Sr.no</th>
                                        <th>Date</th>
                                        <th>Customer Name</th>
                                        <th>Amount</th>
                                        <th>Transaction No.</th>
                                        <th>Bank Name</th>
                                        <th>Edit/Delete</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="panel-footer">

                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
            </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

        <!-- /#page-wrapper -->

<?php $this->load->view('scripts'); ?>


<script>

    $(document).ready(function(){
        var table = $('#a_daily_deposits').dataTable( {
            "sDom": '<"top"pl>rt<"bottom"><"clear">',
            "aaSorting": [[1, "asc"],[2, "asc"]],
            "oLanguage": {
                "sLengthMenu": "_MENU_ records per page"
            },
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "<?=site_url('ajax/a_daily_deposits');?>",
            "sPaginationType": "listbox",
            "responsive" : true,
            "columns": [
                { "data": null },
                { "data": "depdate" },
                { "data": "user_name" },
                { "data": "dep_amount" },
                { "data": "dep_transno" },
                { "data": "dep_bankname" },
                { "data": "dep_id" },
            ],
            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                var index = iDisplayIndex +1;
                $('td:eq(0)',nRow).html(index);
                return nRow;
            },
            "drawCallback" : function(){
                $('.delete_item').click(function(){
                    $item_id = $(this).data('depid');
                    $isDelete = confirm('Are you sure you want to delete this Item?');
                    if($isDelete){
                        $.ajax({
                            type:'POST',
                            url: '<?=site_url("ajax/delete_deposit");?>',
                            dataType: 'json',
                            data: {dep_id : $item_id},
                            success:function(data, textStatus, jqXHR){
                                table.fnDraw(false);
                            }
                        });
                    }
                });
            },
        });
    });

</script>


