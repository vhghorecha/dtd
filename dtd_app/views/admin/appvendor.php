<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> New Vendor Registration List:</h1>
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
                        <th>Vendor Name</th>
                        <th>Mobile Number</th>
                        <th>Balance</th>
                        
						<th>Edit</th>
						<th>Delete</th>
                    </tr>
                    </thead>

                    <tfoot>
						<tr>
                        <th>Vendor Name</th>
                        <th>Mobile Number</th>
                        <th>Balance</th>
                        
						<th>Edit</th>
						<th>Delete</th>
                        
                        
                    </tr>
                    </tfoot>

                    <tbody>
                    <tr>
                        <td>Hardik</td>
                        <td>9898989898</td>
                        <td>500</td>
                        
                        <td><a href="<?=site_url('admin/vendor_detail');?>">Edit</a></td>
						<td><a href="<?=site_url('admin/vendor_delete');?>">Delete</a></td>
                    </tr>
					                    <tr>
                        <td>Vimal</td>
                        <td>9898989898</td>
                        <td>500</td>
                        
                        <td><a href="<?=site_url('admin/vendor_detail');?>">Edit</a></td>
						<td><a href="<?=site_url('admin/vendor_delete');?>">Delete</a></td>
                    </tr>
                    
                    </tbody>
                </table>
				</div>
				<div class="panel-footer">
									<a href="<?=site_url('admin/vendor_detail');?>">New Vendor</a>
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