<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">View Message</h1>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <?php echo form_open(current_url(), array(
                    'id' => 'frmmessage',
                    'role' => 'form'
                )); ?>
                <div class="form-group">
                    <label>Recipients :</label>
                    <?php echo callback_message_from($txtreci); ?>
                </div>
                <div class="form-group">
                    <label>Subject :</label>
                    <?php echo $txtsub; ?>

                </div>
                <div class="form-group">
                    <label>Message :</label>
                    <?php echo $txtmsg; ?>
                </div>

                <?php
                if(!empty($attachment))
                {
                    ?>
                    <div class="form-group">
                        <div class="form-group">
                            <a href="<?=RES_URL."files/".$attachment;?>" target="_blank" >View attachment</a>
                        </div>
                    </div>
                    <?php
                }
                ?>


                <div class="form-group">
                    <a href="<?php echo site_url('vendor/rec_message'); ?>" >Back</a>
                </div>


            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

            </div>

            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php $this->load->view("scripts"); ?>

<script type="text/javascript" language="javascript" src="<?=RES_URL;?>js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({ selector:'textarea',height: 300 });

</script>


