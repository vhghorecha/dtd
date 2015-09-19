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
	<script type="text/javascript">
		// When the document is ready
		$(document).ready(function () {
			$('.datepicker').datepicker({
				format: "dd/mm/yyyy"
			});
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
					{ "data": "order_date" },
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
				]
			} );
		</script>
	<?php } ?>

		
</body>

</html>