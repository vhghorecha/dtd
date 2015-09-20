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
                        <th rowspan="2">Month</th>
                        <th colspan="2" align="center">Charges</th>
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
                    <?php
                    foreach($account as $acc) {
                        ?>
                        <tr>
                            <td><? echo $acc['ord_date']; ?></td>
                            <td><? echo $acc['COUNT( order_id )']; ?></td>
                            <td><? echo $acc['SUM(order_amount)']; ?></td>
                            <td><? echo $acc['count(dep_id)']; ?></td>
                            <td><? echo $acc['sum(dep_amount)']; ?></td>
                            <td></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

    
