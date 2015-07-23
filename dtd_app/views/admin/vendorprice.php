       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Vendor Price</h1>
                    </div>
					<form role="form">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
                                <label>Vendor Name*</label>
                                    <select class="form-control" name="venname" required autofocus>
                                        <option>Vimal Ghorecha (Rajkot)</option>
                                        <option>Chirag Bhatt (Rajkot)</option>
                                        <option>Hardik Mehta (Wankaner)</option>
                                        
                                        </select>
                            </div>
							<div class="form-group">
                                <label>Item Type*</label>
                                    <select class="form-control" name="itemtype" required >
                                        <option>A</option>
                                        <option>B</option>
                                        <option>C</option>
                                    </select>
                            </div>
							<div class="form-group">
                                <label>Price*</label>
                                <input class="form-control" placeholder="Enter Amount" name="price" required>
                            </div>
							
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							
							
							
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<button type="submit" href="<?=site_url('customer/ven_price_save')?>" class="btn btn-primary">Save</button>
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

    
