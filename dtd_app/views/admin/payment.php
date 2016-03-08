       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <?php echo form_open(current_url(), array(
                    'id' => 'frmvendorpay',
                    'role' => 'form'
                )); ?>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Vendor Payment</h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>Delivered Orders</h3>
                            <table id="a_ven_pay" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Sr.no</th>
                                    <th><input type="checkbox" id="selallchk"/> Order id</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Customer</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Item type</th>
                                    <th>Item name</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Sr.no</th>
                                    <th>Order id</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Customer</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Item type</th>
                                    <th>Item name</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <?php if (!empty($error)) { ?>
                                <div class="alert alert-danger fade in"><?= $error; ?></div>
                            <?php } ?>
                            <?php if (!empty($message)) { ?>
                                <div class="alert alert-success fade in"><?= $message; ?></div>
                            <?php } ?>
                            <div class="form-group  required">
                                <label>Vendor Name</label>
                                <?PHP
                                $attributes = 'class="form-control" id="vendname" name="vendname" required autofocus';
                                echo form_dropdown('vendname',$vendors,set_value('vendname'),$attributes);
                                ?>
                            </div>
                            <div class="form-group required">
                                <label>Date of Payment</label>
                                <input class="form-control datepicker" placeholder="Click to Select Date" name="paydate" required>
                            </div>
                            <div class="form-group  required">
                                <label>Amount</label>
                                <input type="number" class="form-control" placeholder="Enter Amount" id="payamount" name="payamount" required value="0" readonly>
                            </div>
                            <div class="form-group  ">
                                <label>Transaction Reference</label>
                                <input class="form-control" placeholder="Enter Transaction Reference Number" name="payreference" >
                            </div>
                            <div class="form-group  ">
                                <label>Bank A/c. Number</label>
                                <input class="form-control" placeholder="Enter Bank A/c. Number" name="paybankacno" id="paybankacno" >
                            </div>
                            <div class="form-group  ">
                                <label>Bank Name</label>
                                <input class="form-control" placeholder="Enter Bank Name" name="paybankname" id="paybankname" >
                            </div>
                            <div class="form-group">
                                <button type="submit" href="<?=site_url('admin/payment')?>" class="btn btn-primary" name="btnSave" id="btnSave" value="save">Save</button>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Daily Payments to Vendors
                                </div>
                                <div class="panel-body">
                                    <table id="a_daily_payments" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Sr.no</th>
                                            <th class="all">Date</th>
                                            <th class="all">Vendor Name</th>
                                            <th class="all">Amount</th>
                                            <th>A/c No.</th>
                                            <th>Transaction No.</th>
                                            <th>Bank Name</th>
                                            <th class="all">Edit/Delete</th>
                                            <th class="all">Download</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Sr.no</th>
                                            <th>Date</th>
                                            <th>Vendor Name</th>
                                            <th>Amount</th>
                                            <th>A/c No.</th>
                                            <th>Transaction No.</th>
                                            <th>Bank Name</th>
                                            <th>Edit/Delete</th>
                                            <th>Download</th>
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
<?php $this->load->view("scripts") ?>

<script>
    var table2,table ;
    $(document).ready(function(){
        table2 = $('#a_ven_pay').dataTable( {
            "sDom": '<"top"pl>rt<"bottom"><"clear">',
            "oLanguage": {
                "sLengthMenu": "_MENU_ records per page"
            },
            "bSort": false,
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "<?=site_url('ajax/a_ven_pay/');?>",
            "sPaginationType": "listbox",
            "fnServerParams": function ( aoData ) {
                aoData.push( { "name": "vendor_id", "value": $('#vendname').val() } );
            },
            "responsive" : true,
            "columns": [
                { "data": null  },
                { "data": "order_id"  },
                { "data": "ord_date" },
                { "data": "vendor_amount" },
                { "data": "user_name" },
                { "data": "order_recipient" },
                { "data": "order_telno" },
                { "data": "type_name" },
                { "data": "order_itemname" },
            ],
            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                var index = iDisplayIndex +1;
                $('td:eq(0)',nRow).html(index);
                return nRow;
            },
            "drawCallback" : function(){
                $('.a_pay_order_amt').click(function(){
                    if($('#payamount').val() == ''){
                        $('#payamount').val(0);
                    }
                    if($(this).is(':checked')){
                        $('#payamount').val( parseInt($('#payamount').val()) + parseInt($(this).val()) );
                    }else{
                        $('#payamount').val( parseInt($('#payamount').val()) - parseInt($(this).val()) );
                    }
                });
            }
        } );

        // Setup - add a text input to each footer cell
        $('#a_ven_pay tfoot th').each( function () {
            //var title = $('#example thead th').eq( $(this).index() ).text();
            if($(this).index() != 1 ){
                $(this).html( txtsearch );
            }else{
                $(this).html( datesearch );
            }

        } );

        $('#vendname').change(function(){
            table2.fnDraw();
            $('#payamount').val();
        });

        ///hsm code
        $('#vendname').change(function(){
            $venid = $(this).val();
            if($venid > 0) {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '<?php echo site_url('ajax/a_get_bank' )?>',
                    data: {'vendor_id': $venid},
                    success: function (data) {
                        if (typeof data.pay_bankacno !== 'undefined') {
                            $('#paybankacno').val(data.pay_bankacno);
                            $('#paybankname').val(data.pay_bankname);
                        }
                    }
                });
            }
            else{
                $('#paybankacno').val('');
                $('#paybankname').val('');
            }
        });

        $("#selallchk").change(function(){
            $(".a_pay_order_amt").prop('checked', !$(this).prop("checked"));
            $('.a_pay_order_amt').trigger("click");
        });


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
                { "data": "user_name" },
                { "data": "pay_amount" },
                { "data": "pay_bankacno" },
                { "data": "pay_transno" },
                { "data": "pay_bankname" },
                { "data": "dep_id" },
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
    });


</script>




    
