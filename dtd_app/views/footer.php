==
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
				"columns": [
					{ "data": "order_date" },
					{ "data": "order_id" },
					{ "data": "user_name" },
					{ "data": "order_recipient" },
					{ "data": "order_telno" },
					{ "data": "type_name" },
					{ "data": "order_itemname" },
					{ "data": "user_sercomp" },
					{ "data": "user_mob" }
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