<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Your Account</h1>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                Monthly
            </div>
            <div class="panel-body">
                <?php echo form_open(""); ?>
                <div class="form-inline text-center">
                    <label>Year:</label>
                    <input type="text" name="year" class="form-control ydatepicker" size="4" placeholder="Select Year" value="<?=set_value('year',date('Y'));?>"/>
                    <input type="submit" class="btn btn-primary" value="Filter"/>
                </div>
                <?php echo form_close();?>
                <div class="row">
                    <div class="col-lg-12">
                        <table id="c_account" class="table dttable table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th rowspan="2">Date</th>
                                    <th colspan="2">Charges</th>
                                    <th colspan="2">Deposit</th>
                                    <th rowspan="2">Balance</th>
                                </tr>
                                <tr>
                                    <th>Number</th>
                                    <th>Amount</th>
                                    <th>Number</th>
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
                                    <td><?PHP echo callback_format_amount($row['recived']['amount']-$row['charge']['amount']);?></td>
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
                                <th><?PHP echo callback_format_amount($rec-$cha);?></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                Yearly
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table id="cy_account" class="table dttable table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th rowspan="2">Date</th>
                                <th colspan="2">Charges</th>
                                <th colspan="2">Deposit</th>
                                <th rowspan="2">Balance</th>
                            </tr>
                            <tr>
                                <th>Number</th>
                                <th>Amount</th>
                                <th>Number</th>
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
                                        <td><?PHP echo callback_format_amount($row['recived']['amount']-$row['charge']['amount']);?></td>
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
                                <th><?PHP echo callback_format_amount($rec-$cha);?></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

    
