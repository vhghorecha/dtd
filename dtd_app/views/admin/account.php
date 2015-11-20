<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Balance:</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="panel panel-primary">
								<div class="panel-heading">
								</div>
								<div class="panel-body">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th rowspan="2">Date</th>
                                            <th colspan="2">Received from Customers</th>
                                            <th colspan="2">Paid to Vendors</th>
                                            <th rowspan="2">Admin Balance</th>
                                        </tr>
                                        <tr>
                                            <th>Transactions</th>
                                            <th>Amount</th>
                                            <th>Transactions</th>
                                            <th>Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?PHP foreach($account as $row){
                                            if($row['charge']['date']!="" || $row['recived']['num']!=""){?>
                                                <tr>
                                                    <td><?PHP echo $row['date'];?></td>
                                                    <td><?PHP if($row['charge']['date']!="") echo $row['charge']['num']; else echo "0";?></td>
                                                    <td><?PHP if($row['charge']['amount']!="") echo callback_format_amount($row['charge']['amount']); else echo "0";?></td>
                                                    <td><?PHP if($row['recived']['num']!="") echo $row['recived']['num']; else echo "0";?></td>
                                                    <td><?PHP if($row['recived']['amount']!="") echo callback_format_amount($row['recived']['amount']); else echo "0";?></td>
                                                    <td><?PHP echo callback_format_amount($row['charge']['amount']-$row['recived']['amount']);?></td>
                                                </tr>
                                            <?PHP }?>
                                        <?PHP }?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Total</th>
                                            <th><?PHP echo array_sum(array_column(array_column($account,'charge'),'num')); ?></th>
                                            <th><?PHP $cha = array_sum(array_column(array_column($account,'charge'),'amount')); echo callback_format_amount($cha); ?></th>
                                            <th><?PHP echo array_sum(array_column(array_column($account,'recived'),'num')); ?></th>
                                            <th><?PHP $rec = array_sum(array_column(array_column($account,'recived'),'amount')); echo callback_format_amount($rec); ?></th>
                                            <th><?PHP echo callback_format_amount($cha-$rec);?></th>
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