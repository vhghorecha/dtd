       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Item Price</h1>
                    </div>
					<form role="form">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							
							
							<div class="form-group">
                                <label>Item Type*</label>
                                <input class="form-control" placeholder="Enter Item Type" name="itemname" autofocus required>
                            </div>
							<div class="form-group">
                                <label>Price*</label>
                                <input class="form-control" placeholder="Enter Price" name="itemprice" required>
                            </div>
						</div>
						
						<div class="col-lg-12">
							<div class="form-group">
								<button type="submit" href="<?=site_url('admin/item_save')?>" class="btn btn-primary">Save</button>
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

    
