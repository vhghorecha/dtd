<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger fade in"><?= $error; ?></div>
        <?php } ?>
        <?php if (!empty($message)) { ?>
            <div class="alert alert-success fade in"><?= $message; ?></div>
        <?php } ?>
        <?php echo form_open(current_url(), array(
            'id' => 'frmvendorpay',
            'role' => 'form'
        )); ?>
        <h1 class="page-header">Vendor Payment</h1>
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Filter & Generate Payment
                </div>
                <div class="panel-body">
                    <div class="col-xs-12 col-sm-3">
                        <div class="form-group  required">
                            <?PHP
                            $attributes = 'class="form-control" id="vendname" name="vendname" data-placeholder="Select Vendors" required autofocus multiple="multiple"';
                            echo form_dropdown('vendname[]',$vendors,false,$attributes);
                            ?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <div class="form-group required">
                            <input class="form-control datepicker" placeholder="From Date" name="fromdate" required />
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <div class="form-group required">
                            <input class="form-control datepicker" placeholder="To Date" name="todate" required />
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <input class="btn btn-primary" type="submit" id="btnfilter" name="btnfilter" value="Generate"/>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close();?>
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Vendor Payments
                    </div>
                    <div class="panel-body">
                        <table id="a_daily_payments" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Sr.no</th>
                                <th class="all">Date</th>
                                <th class="all">Amount</th>
                                <th>Pay Code</th>
                                <th>Status</th>
                                <th class="all">Download</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Sr.no</th>
                                <th class="all">Date</th>
                                <th class="all">Amount</th>
                                <th>Pay Code</th>
                                <th>Status</th>
                                <th class="all">Download</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php $this->load->view("scripts") ?>

<script>
    var table2,table ;
    $(document).ready(function(){
        //=====================================================================
        table = $('#a_daily_payments').dataTable( {
            "sDom": '<"top"pl>rt<"bottom"><"clear">',
            "aaSorting": [[0, "asc"],[1, "asc"]],
            "oLanguage": {
                "sLengthMenu": "_MENU_ records per page"
            },
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "<?=site_url('ajax/a_daily_payments');?>",
            "responsive" : true,
            "sPaginationType": "listbox",
            "columns": [
                { "data": null  },
                { "data": "paydate" },
                { "data": "pay_amount" },
                { "data": "pay_code" },
                { "data": "pay_status" },
                { "data": "download" },
            ],
            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                var index = iDisplayIndex +1;
                $('td:eq(0)',nRow).html(index);
                return nRow;
            },
            "drawCallback" : function(){
                $('.delete_item').click(function(){
                    $delid = $(this).data("depid");
                    $isDelete = confirm('Are you sure to delete this?');
                    if($isDelete==true)
                    {
                        $.ajax({
                            type:'POST',
                            url: '<?=site_url("ajax/delete_payment");?>',
                            dataType: 'json',
                            data: {dep_id : $delid},
                            success:function(data, textStatus, jqXHR){
                                table.fnDraw(false);
                            }
                        });
                    }

                });//end of delete_item click

            }
            //end of drawback
        } );
        //=======================================================================
        // Setup - add a text input to each footer cell
        $('#a_daily_payments tfoot th').each( function () {
            if($(this).index() == 1 ) {
                $(this).html(datesearch);
            }else{
                $(this).html( txtsearch );
            }
        } );
    });


</script>




    
