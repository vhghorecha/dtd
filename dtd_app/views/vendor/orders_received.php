<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Orders Received:</h1>
            </div>
        </div>
        <div class="row">
                <table id="v_ord_rec" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Order id</th>
                        <th>Customer</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Item type</th>
                        <th>Item name</th>
                        <th>Company name</th>
                        <th>Phone</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Date</th>
                        <th>Order id</th>
                        <th>Customer</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Item type</th>
                        <th>Item name</th>
                        <th>Company name</th>
                        <th>Phone</th>
                        <th>Status</th>
                    </tr>
                    </tfoot>
                </table>
                <a href="<?=site_url('vendor/download')?>" class="btn btn-primary pull-right">Download</a>
            </div>
            <br/>
            <!-- /.col-lg-12 -->
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Daily Statistics
                        </div>
                        <div class="panel-body">
                            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>No. of Order</th>
                                    <th>Charge amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($dorders as $order){?>
                                <tr>
                                    <td><?PHP echo $order['user_name']; ?></td>
                                    <td><?PHP echo $order['num']; ?></td>
                                    <td><?PHP echo $order['amount']; ?></td>
                                </tr>
                                <?PHP }?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th><?PHP echo array_sum(array_column($dorders,'num'));?></th>
                                    <th><?PHP echo array_sum(array_column($dorders,'amount'));?></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="panel-footer">

                        </div>
                    </div>
                </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<div class="modal fade" role="dialog" id="pop_up_order">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header alert alert-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Update Order</h4>
            </div>
            <div class="modal-body">
                <div id="update_res"></div>
                <input type="hidden" id="up_orderid"/>
                <input type="text" id="up_code" name="up_code" placeholder="Enter Update Code" />
                <input type="button" id="btn_up_code" name="btn_up_code" value="Update"/>
            </div>
        </div>
    </div>
</div>