</div>
    <!-- /#wrapper -->

    <!-- jQuery -->
	<script src="<?=RES_URL;?>js/jquery-1.11.1.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=RES_URL;?>js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?=RES_URL;?>js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?=RES_URL;?>js/sb-admin-2.js"></script>
	<script src="<?=RES_URL;?>js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" language="javascript" src="<?=RES_URL;?>js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="<?=RES_URL;?>js/dataTables.bootstrap.js"></script>
	<script type="text/javascript" language="javascript" src="<?=RES_URL;?>js/dataTables.responsive.js"></script>
	<script type="text/javascript" language="javascript" src="<?=RES_URL;?>js/jquery.columnFilter.js"></script>
	<script type="text/javascript" language="javascript" src="<?=RES_URL;?>js/select2.min.js"></script>
	<script type="text/javascript">
		// When the document is ready
		$(document).ready(function () {
			$('.datepicker').datepicker({
				format: "dd/mm/yyyy"
			});
            $('.tdatepicker').datepicker({
                format: "M-dd"
            });
			$('.datepicker, .tdatepicker').on('changeDate', function(ev){
				$(this).datepicker('hide');
			});
			$('select').select2();
		});
    </script>

	<script type="text/javascript">
	// When the document is ready
		$(document).ready(function() {
			$('table.dttable').DataTable({
				"sDom": '<"top">rt<"bottom"><"clear">',
				"responsive" : true
			});
		});
	</script>

	<?php if($current_page == 'vendor' && $current_action == 'orders_received') { ?>
		<script>
			$(document).ready(function(){
				$('#btn_up_code').click(function(){
					$orderid = $('#up_orderid').val();
					$up_code = $('#up_code').val();
					$.ajax({
						type:'POST',
						url: '<?=site_url("ajax/update_order");?>',
						dataType: 'json',
						data: {order_id : $orderid, up_code : $up_code},
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
			var table = $('#v_ord_rec').dataTable( {
				"sDom": '<"top"pl>rt<"bottom"><"clear">',
				"aaSorting": [[0, "desc"]],
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": "<?=site_url('ajax/v_ord_rec');?>",
				"responsive" : true,
				"drawCallback" : function(){
					$('.update_order').click(function(){
						$('#up_orderid').val($(this).data('orderid'));
						$('#pop_up_order').modal('show');
					});
				},
				"columns": [
					{ "data": "ord_date" },
					{ "data": "order_id" },
					{ "data": "user_name" },
					{ "data": "order_recipient" },
					{ "data": "order_telno" },
					{ "data": "type_name" },
					{ "data": "order_itemname" },
					{ "data": "user_sercomp" },
					{ "data": "user_mob" },
					{ "data": "order_status" },
				]
			} );

            // Setup - add a text input to each footer cell
            $('#v_ord_rec tfoot th').each( function () {
                //var title = $('#example thead th').eq( $(this).index() ).text();
                if($(this).index() != 0 ){
                    $(this).html( '<input type="text" style="width:100%" />' );
                }else{
                    $(this).html( '<input type="text" style="width:100%" class="tdatepicker" />' );
                }

            } );
		</script>
	<?php } ?>

	<?php if($current_page == 'customer' && $current_action == 'orders') { ?>
		<script>
			var table = $('#c_orders').dataTable( {
				"sDom": '<"top"pl>rt<"bottom"><"clear">',
				"aaSorting": [[0, "desc"]],
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": "<?=site_url('ajax/c_orders');?>",
				"responsive" : true,
				"columns": [
					{ "data": "order_id" },
					{ "data": "order_date" },
					{ "data": "order_recipient" },
					{ "data": "order_telno" },
					{ "data": "type_name" },
					{ "data": "order_status" },
					{ "data" : "modify"},
				]
			} );

			// Setup - add a text input to each footer cell
			$('#c_orders tfoot th').each( function () {
				//var title = $('#example thead th').eq( $(this).index() ).text();
				if($(this).index() != 1 ){
					$(this).html( '<input type="text" style="width:100%" />' );
				}else{
					$(this).html( '<input type="text" style="width:100%" class="tdatepicker" />' );
				}

			} );
		</script>
	<?php } ?>

	<?php if($current_page == 'admin' && $current_action == 'app_vendor') { ?>
		<script>
			var table = $('#a_pending_vendors').dataTable( {
				"sDom": '<"top"pl>rt<"bottom"><"clear">',
				"aaSorting": [[0, "desc"]],
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": "<?=site_url('ajax/a_pending_vendors');?>",
				"responsive" : true,
				"columns": [
					{ "data": "user_name" },
					{ "data": "user_email" },
					{ "data": "user_add" },
					{ "data": "user_tel" },
					{ "data": "user_mob" },
					{ "data": "user_site" },
					{ "data": "user_staffname" },
					{ "data": "user_stafftel" },
					{ "data": "user_id" },
				],
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
		</script>
	<?php } ?>

	<?php if($current_page == 'admin' && $current_action == 'app_customer') { ?>
		<script>
			var table = $('#a_pending_customers').dataTable( {
				"sDom": '<"top"pl>rt<"bottom"><"clear">',
				"aaSorting": [[0, "desc"]],
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": "<?=site_url('ajax/a_pending_customers');?>",
				"responsive" : true,
				"columns": [
					{ "data": "user_name" },
					{ "data": "user_email" },
					{ "data": "user_add" },
					{ "data": "user_tel" },
					{ "data": "user_mob" },
					{ "data": "user_site" },
					{ "data": "user_staffname" },
					{ "data": "user_stafftel" },
					{ "data": "user_id" },
				],
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
		</script>
	<?php } ?>

	<?php if($current_page == 'admin' && $current_action == 'customers') { ?>
		<script>
			var table = $('#a_customers').dataTable( {
				"sDom": '<"top"pl>rt<"bottom"><"clear">',
				"aaSorting": [[0, "desc"]],
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": "<?=site_url('ajax/a_customers');?>",
				"responsive" : true,
				"columns": [
					{ "data": "user_name" },
					{ "data": "user_email" },
					{ "data": "user_add" },
					{ "data": "user_tel" },
					{ "data": "user_mob" },
					{ "data": "user_site" },
					{ "data": "user_staffname" },
					{ "data": "user_stafftel" },
					{ "data": "user_balance"},
				]
			} );
		</script>
	<?php } ?>

	<?php if($current_page == 'admin' && $current_action == 'vendors') { ?>
		<script>
			var table = $('#a_vendors').dataTable( {
				"sDom": '<"top"pl>rt<"bottom"><"clear">',
				"aaSorting": [[0, "desc"]],
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": "<?=site_url('ajax/a_vendors');?>",
				"responsive" : true,
				"columns": [
					{ "data": "user_name" },
					{ "data": "user_email" },
					{ "data": "user_add" },
					{ "data": "user_tel" },
					{ "data": "user_mob" },
					{ "data": "user_site" },
					{ "data": "user_staffname" },
					{ "data": "user_stafftel" },
					{ "data": "user_balance"},
				]
			} );
		</script>
	<?php } ?>

	<?php if($current_page == 'admin' && $current_action == 'vendor_customer_') { ?>
		<script>
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
					{ "data": "user_name" },
					{ "data": "user_email" },
					{ "data": "user_add" },
					{ "data": "user_tel" },
					{ "data": "user_mob" },
					{ "data": "user_site" },
					{ "data": "user_staffname" },
					{ "data": "user_stafftel" },
					{ "data": "user_balance"},
				]
			}
			);
		</script>
	<?php } ?>

	<?php if($current_page == 'admin' && $current_action == 'vendor_customer') { ?>
		<script>
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
						{ "data": "user_mob" },
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
		</script>
	<?php } ?>

	<?php if($current_page == 'admin' && $current_action == 'payment') { ?>
			<script>
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
			</script>
		<?PHP } ?>

	<?php if($current_page == 'admin' && $current_action == 'deposit') { ?>
		<script>
			var table = $('#a_daily_deposits').dataTable( {
				"sDom": '<"top"pl>rt<"bottom"><"clear">',
				"aaSorting": [[0, "asc"],[1, "asc"]],
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": "<?=site_url('ajax/a_daily_deposits');?>",
				"responsive" : true,
				"columns": [
					{ "data": "depdate" },
					{ "data": "user_name" },
					{ "data": "dep_amount" },
					{ "data": "dep_transno" },
					{ "data": "dep_bankname" },
				]
			} );
		</script>
	<?php } ?>

	<?php if($current_page == 'admin' && $current_action == 'payment') { ?>
		<script>
			var table = $('#a_daily_payments').dataTable( {
				"sDom": '<"top"pl>rt<"bottom"><"clear">',
				"aaSorting": [[0, "asc"],[1, "asc"]],
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": "<?=site_url('ajax/a_daily_payments');?>",
				"responsive" : true,
				"columns": [
					{ "data": "paydate" },
					{ "data": "user_name" },
					{ "data": "pay_amount" },
					{ "data": "pay_transno" },
					{ "data": "pay_bankname" },
				]
			} );
		</script>
	<?php } ?>
	<?php if($current_page == 'admin' && $current_action == 'price') { ?>
		<script>
			var table = $('#a_customer_grade').dataTable( {
				"sDom": '<"top"pl>rt<"bottom"><"clear">',
				"aaSorting": [[0, "asc"],[1, "asc"]],
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": "<?=site_url('ajax/a_customer_grade');?>",
				"responsive" : true,
				"columns": [
					{ "data": "term"},
					{ "data": "gp_no_order" },
					{ "data": "grade_name" },
					{ "data": "gp_disc" },
					{ "data": "edit" },
				]
			} );
		</script>
	<?php } ?>
	<?php if($current_page == 'admin' && $current_action == 'price') { ?>
		<script>
			var table = $('#a_item_price').dataTable( {
				"sDom": '<"top"pl>rt<"bottom"><"clear">',
				"aaSorting": [[0, "asc"],[1, "asc"]],
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": "<?=site_url('ajax/a_item_price');?>",
				"responsive" : true,
				"columns": [
					{ "data": "type_name"},
					{ "data": "gi_price" },
					{ "data": "edit" },
				]
			} );
		</script>
	<?php } ?>
	<?php if($current_page == 'admin' && $current_action == 'price') { ?>
		<script>
			var table = $('#a_vendor_price').dataTable( {
				"sDom": '<"top"pl>rt<"bottom"><"clear">',
				"aaSorting": [[0, "asc"]],
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": "<?=site_url('ajax/a_vendor_price');?>",
				"responsive" : true,
				"columns": [
					{ "data": "user_name"},
					{ "data": "type_name" },
					{ "data": "gp_price" },
					{ "data": "profit" },
					{ "data": "edit" },
				]
			} );
		</script>
	<?php } ?>
	<?php if($current_page == 'admin' && $current_action == 'item') { ?>
		<script>
			$(document).ready(function(){
				$('#btn_up_item').click(function(){
					$typeid = $('#up_itemid').val();
					$typename = $('#up_itemname').val();
					$.ajax({
						type:'POST',
						url: '<?=site_url("ajax/edit_item");?>',
						dataType: 'json',
						data: {type_id : $typeid, type_name : $typename},
						success:function(data, textStatus, jqXHR){
							if(typeof data.message !== 'undefined'){
								$('#update_item').html('<div class="alert alert-success">' + data.message + '</div>')
							}else{
								$('#update_item').html('<div class="alert alert-error">' + data.error + '</div>')
							}
							table.fnDraw(false);
						}
					});
				});
			});
			var table = $('#a_item_list').dataTable( {
				"sDom": '<"top"pl>rt<"bottom"><"clear">',
				"aaSorting": [[0, "asc"]],
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"drawCallback" : function(){
					$('.edit_item').click(function(){
						$('#up_itemid').val($(this).data('typeid'));
						$('#up_itemname').val($(this).data('typename'));
						$('#pop_up_item').modal('show');
					});
					$('.delete_item').click(function(){
						$item_id = $(this).data('typeid');
						$isDelete = confirm('Are you sure you want to delete this Item?');
						if($isDelete){
							$.ajax({
								type:'POST',
								url: '<?=site_url("ajax/delete_item");?>',
								dataType: 'json',
								data: {type_id : $item_id},
								success:function(data, textStatus, jqXHR){
									table.fnDraw(false);
								}
							});
						}
					});
				},
				"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": "<?=site_url('ajax/a_item_list');?>",
				"responsive" : true,
				"columns": [
					{ "data": "type_name" },
					{ "data": "edit" },
				]
			} );
		</script>
	<?php } ?>
	<?php if($current_page == 'admin' && $current_action == 'grade') { ?>
		<script>
			$(document).ready(function(){
				$('#btn_up_grade').click(function(){
					$gradeid = $('#up_gradeid').val();
					$gradename = $('#up_gradename').val();
					$.ajax({
						type:'POST',
						url: '<?=site_url("ajax/edit_grade");?>',
						dataType: 'json',
						data: {grade_id : $gradeid, grade_name : $gradename},
						success:function(data, textStatus, jqXHR){
							if(typeof data.message !== 'undefined'){
								$('#update_grade').html('<div class="alert alert-success">' + data.message + '</div>')
							}else{
								$('#update_grade').html('<div class="alert alert-error">' + data.error + '</div>')
							}
							table.fnDraw(false);
						}
					});
				});
			});
			var table = $('#a_grade_list').dataTable( {
				"sDom": '<"top"pl>rt<"bottom"><"clear">',
				"aaSorting": [[0, "asc"]],
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"drawCallback" : function(){
					$('.edit_grade').click(function(){
						$('#up_gradeid').val($(this).data('gradeid'));
						$('#up_gradename').val($(this).data('gradename'));
						$('#pop_up_grade').modal('show');
					});
					$('.delete_grade').click(function(){
						$grade_id = $(this).data('gradeid');
						$isDelete = confirm('Are you sure you want to delete this Customer Grade?');
						if($isDelete){
							$.ajax({
								type:'POST',
								url: '<?=site_url("ajax/delete_grade");?>',
								dataType: 'json',
								data: {grade_id : $grade_id},
								success:function(data, textStatus, jqXHR){
									table.fnDraw(false);
								}
							});
						}
					});
				},
				"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": "<?=site_url('ajax/a_grade_list');?>",
				"responsive" : true,
				"columns": [
					{ "data": "grade_name" },
					{ "data": "edit" },
				]
			} );
		</script>
	<?php } ?>
	<script>
        if(typeof table !== 'undefined'){
            table.DataTable().columns().every( function () {
                var that = this;
                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
            function fnResetAllFilters() {
                var oSettings = table.fnSettings();
                for (iCol = 0; iCol < oSettings.aoPreSearchCols.length; iCol++) {
                    oSettings.aoPreSearchCols[iCol].sSearch = '';
                }
                table.fnDraw();
            }
            $('<button class="btn btn-primary pull-right">Clear Search</button>').click( function () {$('input').val('');fnResetAllFilters();}).insertBefore( 'div.dataTables_wrapper');
        }
	</script>
</body>

</html>