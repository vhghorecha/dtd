<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Database Backup</h1>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Order backup
                    </div>
                    <div class="panel-body">
                        <?php if (!empty($error)) { ?>
                            <div class="alert alert-danger fade in"><?= $error; ?></div>
                        <?php } ?>
                        <?php if (!empty($message)) { ?>
                            <div class="alert alert-success fade in"><?= $message; ?></div>
                        <?php } ?>
                        <?php echo form_open('admin/orderbackup', array(
                            'id' => 'frmbackup',
                            'role' => 'form'
                        )); ?>
                        <div class="form-group required">
                            <label>Start date</label>
                            <input class="form-control datepicker" placeholder="Enter start date" name="startdate" id="startdate" required>
                        </div>
                        <div class="form-group required">
                            <label>End date</label>
                            <input class="form-control datepicker" placeholder="Enter start date" name="enddate" id="enddate" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" href="<?=site_url('admin/orderbackup');?>"  name="btnBackup" id="btnBackup" value="Backup">Backup</button> <b>Or</b>
                            <a href="<?=site_url('admin/fullbackup');?>"  target="_blank">Full backup</a>
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

    
