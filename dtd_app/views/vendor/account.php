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
                <h3>Daily Total:</h3>
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th rowspan="2">Date</th>
                            <th colspan="2">Charge</th>
                            <th colspan="2">Received Amount</th>
                            <th rowspan="2">Due Balance</th>
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
                            <td><?PHP echo $row['charge']['amount']-$row['recived']['amount'];?></td>
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
                        <th><?PHP echo $cha-$rec;?></th>
                    </tr>
                    </tfoot>
                </table>
                <!--
                <h3>Customer Statistics:</h3>
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th rowspan="2">Customer</th>
                        <th colspan="2">Charge</th>
                        <th colspan="2">Received Amount</th>
                        <th rowspan="2">Due Balance</th>
                    </tr>
                    <tr>
                        <th>Number</th>
                        <th>Amount</th>
                        <th>Number</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
                -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Payment History:
                    </div>
                    <div class="panel-body">
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name of Bank</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?PHP foreach($payhist as $row){?>
                                <tr>
                                    <td><?PHP echo $row['pdate'];?></td>
                                    <td><?PHP echo $row['pay_bankname'];?></td>
                                    <td><?PHP echo $row['pay_amount'];?></td>
                                </tr>
                            <?PHP }?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="2">Total</th>
                                <th><?PHP echo array_sum(array_column($payhist,'pay_amount')); ?></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="panel-footer">

                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

    
