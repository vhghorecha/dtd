       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Customer Grade</h1>
                    </div>
					<form role="form">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							
							
							<div class="form-group">
                                <label>Grade Name*</label>
                                <input class="form-control" placeholder="Enter Grade Name" name="gradename" autofocus required>
                            </div>
							<div class="form-group">
                                <label>Discount*</label>
                                <input class="form-control" placeholder="Enter Discount Percentage" name="percentage" required>
                            </div>
						</div>
						
						<div class="col-lg-12">
							<div class="form-group">
								<button type="submit" href="<?=site_url('admin/grade_save')?>" class="btn btn-primary">Save</button>
							</div>
						</div>
					</form>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    
