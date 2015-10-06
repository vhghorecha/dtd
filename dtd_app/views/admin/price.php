<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Pricing Scheme</h1>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Item Price
                    </div>
                    <div class="panel-body">
                        <table id="a_item_price" class="table table-striped table-bordered example" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>Item Type</th>
                                <th>Price</th>
                                <th>Edit/Delete</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="panel-footer">
                        <a href="<?= site_url('admin/newitemprice'); ?>">New Item price</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Customer Grades and Discount
                    </div>
                    <div class="panel-body">
                        <table id="a_customer_grade" class="table table-striped table-bordered example" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>Term(Period)</th>
                                <th>No. of Orders</th>
                                <th>Grade</th>
                                <th>Discount</th>
                                <th>Edit/Delete</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="panel-footer">
                        <a href="<?= site_url('admin/newgradediscount'); ?>">New Grade Discount</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">


            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Vendor Price
                    </div>
                    <div class="panel-body">
                        <table id="a_vendor_price" class="table table-striped table-bordered example" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>Vendor Name</th>
                                <th>Item Type</th>
                                <th>Price</th>
                                <th>Admin-Profit</th>
                                <th>Edit / Delete</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="panel-footer">
                        <a href="<?= site_url('admin/vendorprice'); ?>">New Vendor Price</a>
                    </div>
                </div>
            </div>

        </div>


        <!-- /.col-lg-12 -->

        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

    
