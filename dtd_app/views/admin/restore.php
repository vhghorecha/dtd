<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Database Restore</h1>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                       Recover database
                    </div>
                    <div class="panel-body">
                        <?php if (!empty($error)) { ?>
                            <div class="alert alert-danger fade in"><?=$error; ?></div>
                        <?php } ?>
                        <?php if (!empty($message)) { ?>
                            <div class="alert alert-success fade in"><?= $message; ?></div>
                        <?php } ?>
                        <?php echo form_open_multipart('admin/dbrestore', array(
                            'id' => 'frmbackup',
                            'role' => 'form'
                        )); ?>
                        <div class="form-group required">
                            <label>Upload file</label>
                            <input type="file" id="userfile" name="userfile" class="form-control" autofocus>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" href="<?=site_url('admin/dbrestore');?>"  name="btnRestore" id="btnRestore" value="Restore">Restore</button>

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
<?php $this->load->view("scripts"); ?>