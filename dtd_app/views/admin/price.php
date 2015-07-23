       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Pricing Scheme</h1>
                    </div>
					
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="panel panel-primary">
								<div class="panel-heading">
									Customer Grade
								</div>
								<div class="panel-body">
									<table id="example" class="table table-striped table-bordered example" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Customer Grade</th>
                        <th>Discount</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>

                    <tfoot>
						<tr>
                        <th>Customer Grade</th>
                        <th>Discount</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </tfoot>

                    <tbody>
                    <tr>
                        <td>Silver</td>
                        <td>0</td>
                        <td><a href="<?=site_url('admin/grade');?>">Edit</a></td>
                        <td><a href="<?=site_url('admin/delete_grade');?>">Delete</a></td>
                    </tr>
					<tr>
                        <td>Gold</td>
                        <td>10</td>
                        <td><a href="<?=site_url('admin/grade');?>">Edit</a></td>
                        <td><a href="<?=site_url('admin/delete_grade');?>">Delete</a></td>
                    </tr>
					
                    
                    </tbody>
                </table>
								</div>
								<div class="panel-footer">
									<a href="<?=site_url('admin/grade');?>">New Grade</a>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="panel panel-primary">
								<div class="panel-heading">
									Item Price
								</div>
								<div class="panel-body">
									<table id="example" class="table table-striped table-bordered example" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Item Type</th>
                        <th>Price</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>

                    <tfoot>
						<tr>
                        <th>Item Type</th>
                        <th>Price</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </tfoot>

                    <tbody>
                    <tr>
                        <td>A</td>
                        <td>100</td>
                        <td><a href="<?=site_url('admin/item');?>">Edit</a></td>
                        <td><a href="<?=site_url('admin/delete_item');?>">Delete</a></td>
                    </tr>
					<tr>
                        <td>B</td>
                        <td>120</td>
                        <td><a href="<?=site_url('admin/item');?>">Edit</a></td>
                        <td><a href="<?=site_url('admin/delete_item');?>">Delete</a></td>
                    </tr>
					<tr>
                        <td>C</td>
                        <td>150</td>
                        <td><a href="<?=site_url('admin/item');?>">Edit</a></td>
                        <td><a href="<?=site_url('admin/delete_item');?>">Delete</a></td>
                    </tr>
					
                    
                    </tbody>
                </table>
								</div>
								<div class="panel-footer">
									<a href="<?=site_url('admin/item');?>">New Item</a>
								</div>
							</div>
						</div>	
				</div>
				<div class="row">
                    
					
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="panel panel-primary">
								<div class="panel-heading">
									Vendor Pricing
								</div>
								<div class="panel-body">
													<table id="example" class="table table-striped table-bordered example" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Vendor Name</th>
                        <th>Item Type</th>
                        <th>Price</th>
                        <th>Earning</th>
						<th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>

                    <tfoot>
					<tr>
                        <th>Vendor Name</th>
                        <th>Item Type</th>
                        <th>Price</th>
                        <th>Earning</th>
						<th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </tfoot>

                    <tbody>
                    <tr>
                        <td>Vimal</td>
                        <td>A</td>
						<td>80</td>
						<td>20</td>
                        <td><a href="<?=site_url('admin/vendorprice');?>">Edit</a></td>
                        <td><a href="<?=site_url('admin/delete_vendor_price');?>">Delete</a></td>
                    </tr>
					<tr>
                        <td>Vimal</td>
                        <td>B</td>
						<td>90</td>
						<td>30</td>
                        <td><a href="<?=site_url('admin/vendorprice');?>">Edit</a></td>
                        <td><a href="<?=site_url('admin/delete_vendor_price');?>">Delete</a></td>
                    </tr>
					<tr>
                        <td>Hardik</td>
                        <td>A</td>
						<td>70</td>
						<td>30</td>
                        <td><a href="<?=site_url('admin/vendorprice');?>">Edit</a></td>
                        <td><a href="<?=site_url('admin/delete_vendor_price');?>">Delete</a></td>
                    </tr>
					<tr>
                        <td>Hardik</td>
                        <td>B</td>
						<td>90</td>
						<td>30</td>
                        <td><a href="<?=site_url('admin/vendorprice');?>">Edit</a></td>
                        <td><a href="<?=site_url('admin/delete_vendor_price');?>">Delete</a></td>
                    </tr>
					
                    
                    </tbody>
                </table>
								</div>
								<div class="panel-footer">
									<a href="<?=site_url('admin/vendorprice');?>">New Vendor Price</a>
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

    
