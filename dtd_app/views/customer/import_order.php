<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Import Orders</h1>
            </div>

            <?php echo form_open_multipart('customer/import_order');?>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?php if(!empty($msg)) {
                        echo '<div class="alert';
                        if (!empty($error)) {
                            echo ' alert-danger';
                        } else {
                            echo ' alert-success';
                        }
                        echo ' fade in">' . $msg . "</div>";
                    }
                    ?>
                    <div class="form-group">
                        <a href="<?=RES_URL . 'order_sample.xlsx';?>">Download Sample Order File</a>
                        <label>Select Excel File*</label>
                        <input type="file" id="file" name="userfile" size="20" autofocus>

                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="btnImport" id="btnImport" value="Import">
                        </div>
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


