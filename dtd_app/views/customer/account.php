<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Your Account:</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table id="c_account" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                            <td><?PHP if($row['charge']['amount']!="") echo $row['charge']['amount']; else echo "0";?></td>
                            <td><?PHP if($row['recived']['num']!="") echo $row['recived']['num']; else echo "0";?></td>
                            <td><?PHP if($row['recived']['amount']!="") echo $row['recived']['amount']; else echo "0";?></td>
                            <td><?PHP echo $row['recived']['amount']-$row['charge']['amount'];?></td>
                        </tr>
                        <?PHP }?>
                    <?PHP }?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Total</th>
                        <th><?PHP echo array_sum(array_column(array_column($account,'charge'),'num')); ?></th>
                        <th><?PHP echo $cha = array_sum(array_column(array_column($account,'charge'),'amount')); ?></th>
                        <th><?PHP echo array_sum(array_column(array_column($account,'recived'),'num')); ?></th>
                        <th><?PHP echo $rec = array_sum(array_column(array_column($account,'recived'),'amount')); ?></th>
                        <th><?PHP echo $rec-$cha;?></th>
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

    
