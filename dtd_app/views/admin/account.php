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
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Daily Income
                    </div>
                    <div class="panel-body">
                        <?php /* echo form_open(""); ?>
                        <div class="form-inline text-center">
                            <label>Month:</label>
                            <input type="text" name="month" class="form-control mdatepicker" size="4" placeholder="Select Month" value="<?=set_value('month',date('M'));?>"/>
                            <input type="submit" class="btn btn-primary" value="Filter"/>
                        </div>
                        <?php echo form_close(); */?>
                        <table id="a_account" class="table dttable table-striped table-bordered" cellspacing="0" width="100%">
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
                            <?PHP foreach($daccount as $row){
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
                                <th><?PHP echo array_sum(array_column(array_column($daccount,'charge'),'num')); ?></th>
                                <th><?PHP $cha = array_sum(array_column(array_column($daccount,'charge'),'amount')); echo callback_format_amount($cha); ?></th>
                                <th><?PHP echo array_sum(array_column(array_column($daccount,'recived'),'num')); ?></th>
                                <th><?PHP $rec = array_sum(array_column(array_column($daccount,'recived'),'amount')); echo callback_format_amount($rec); ?></th>
                                <th><?PHP echo callback_format_amount($cha-$rec);?></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Weekly Check
                    </div>
                    <div class="panel-body">
                        <table id="example" class="table table-striped table-bordered dttable" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th rowspan="2">Date</th>
                                <th>Customer</th>
                                <th colspan="5" style="text-align:center">Vendor</th>
                            </tr>
                            <tr>
                                <th>No. of Orders</th>
                                <th>Pending</th>
                                <th>InProcess</th>
                                <th>Delivered</th>
                                <th>Returned</th>
                                <th>Sum</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach($today as $t) { ?>
                                <tr>
                                    <td><?=$t['ord_date']; ?></td>
                                    <td><?=$t['total_cust']; ?></td>
                                    <td><?=$t['pending']; ?></td>
                                    <td><?=$t['processing']; ?></td>
                                    <td><?=$t['delivered']; ?></td>
                                    <td><?=$t['returned']; ?></td>
                                    <td><?=$t['total_cust']; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Total</th>
                                <th><?=array_sum(array_column($today,'total_cust')); ?></th>
                                <th><?=array_sum(array_column($today,'pending')); ?></th>
                                <th><?=array_sum(array_column($today,'processing')); ?></th>
                                <th><?=array_sum(array_column($today,'delivered')); ?></th>
                                <th><?=array_sum(array_column($today,'returned')); ?></th>
                                <th><?=array_sum(array_column($today,'total_cust')); ?></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Monthly Income
                    </div>
                    <div class="panel-body">
                        <?php /* echo form_open(""); ?>
                        <div class="form-inline text-center">
                            <label>Year:</label>
                            <input type="text" name="year" class="form-control ydatepicker" size="4" placeholder="Select Year" value="<?=set_value('year',date('Y'));?>"/>
                            <input type="submit" class="btn btn-primary" value="Filter"/>
                        </div>
                        <?php echo form_close(); */?>
                        <table id="a_account" class="table dttable table-striped table-bordered" cellspacing="0" width="100%">
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
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Yearly Income
                    </div>
                    <div class="panel-body">

                        <table id="va_account" class="table dttable table-striped table-bordered" cellspacing="0" width="100%">
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
                            <?PHP foreach($yaccount as $row){
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
                                <th><?PHP echo array_sum(array_column(array_column($yaccount,'charge'),'num')); ?></th>
                                <th><?PHP $cha = array_sum(array_column(array_column($yaccount,'charge'),'amount')); echo callback_format_amount($cha); ?></th>
                                <th><?PHP echo array_sum(array_column(array_column($yaccount,'recived'),'num')); ?></th>
                                <th><?PHP $rec = array_sum(array_column(array_column($yaccount,'recived'),'amount')); echo callback_format_amount($rec); ?></th>
                                <th><?PHP echo callback_format_amount($cha-$rec);?></th>
                            </tr>
                            </tfoot>
                        </table>
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
<?php $this->load->view("scripts"); ?>