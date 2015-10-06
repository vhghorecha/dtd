<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Manage Items</h1>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Items
                    </div>
                    <div class="panel-body">
                        <table id="a_item_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Edit / Delete</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        New Item
                    </div>
                    <div class="panel-body">
                        <?php if (!empty($error)) { ?>
                            <div class="alert alert-danger fade in"><?= $error; ?></div>
                        <?php } ?>
                        <?php if (!empty($message)) { ?>
                            <div class="alert alert-success fade in"><?= $message; ?></div>
                        <?php } ?>
                        <?php echo form_open(current_url(), array(
                            'id' => 'frmadditem',
                            'role' => 'form'
                        )); ?>
                        <div class="form-group required">
                            <label>Item Type Name</label>
                            <input class="form-control" placeholder="Enter Type Name" name="typename" id="typename" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" href="<?=site_url('admin/item')?>" class="btn btn-primary" name="btnSave" id="btnSave" value="save">Save</button>
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
<div class="modal fade" role="dialog" id="pop_up_item">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header alert alert-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Update Item</h4>
            </div>
            <div class="modal-body">
                <div id="update_item"></div>
                <input type="hidden" id="up_itemid"/>
                <input type="text" id="up_itemname" name="up_itemname" placeholder="Enter Item Type"/>
                <input type="button" id="btn_up_item" name="btn_up_item" value="Update"/>
            </div>
        </div>
    </div>
</div>