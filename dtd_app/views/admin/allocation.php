       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Customer-Vendor Allocation</h1>
                    </div>
					<form role="form">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
                                <label>Customer Name*</label>
                                <?PHP
                                    $attributes = 'class="form-control" name="custname" required autofocus';
                                    echo form_dropdown('custname',$customers,set_value('custname'),$attributes);
                                ?>
                            </div>
							<div class="form-group">
                                <label>Vendor Name*</label>
                                <?PHP
                                    $attributes = 'class="form-control" name="vendname" required autofocus';
                                    echo form_dropdown('vendname',$vendors,set_value('vendname'),$attributes);
                                ?>
                            </div>
							
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<button type="submit" href="<?=site_url('admin/allocation')?>" class="btn btn-primary" name="btnAllocate" id="btnAllocate" value="Allocate">Allocate</button>
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

    
