<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Send Message</h1>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php if (!empty($error)) { ?>
                    <div class="alert alert-danger fade in"><?= $error; ?></div>
                <?php } ?>
                <?php if (!empty($message)) { ?>
                    <div class="alert alert-success fade in"><?= $message; ?></div>
                <?php } ?>
                <?php echo form_open(current_url(), array(
                    'id' => 'frmmessage',
                    'role' => 'form'
                )); ?>
                <div class="form-group">
                    <?php if(isset($txtreci)){ ?>
                        <div class="form-group">
                            <label>To</label>
                        </div>
                        <input type="hidden" name="reci" value="<?=$txtreci;?>"/>
                        <?php echo callback_message_to($txtreci);?>
                    <?php } else { ?>
                        <div class="form-group">
                            <input type="radio" name="reci" value="all" checked> All DTD Users  <input type="radio" name="reci" value="allc"> All Customers  <input type="radio" name="reci" value="allv"> All Vendors
                            <input type="radio" name="reci" value="customer"> Customer <?PHP
                            $attributes = 'name="custname"';
                            echo form_dropdown('custname',$customers,set_value('custname'),$attributes);
                            ?>
                            <input type="radio" name="reci" value="vendor"> Vendor <?PHP
                            $attributes = 'name="vendname"';
                            echo form_dropdown('vendname',$vendors,set_value('vendname'),$attributes);
                            ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="form-group">
                    <label>Subject*</label>
                    <input class="form-control" placeholder="Enter Message Subject" name="txtsub" id="txtsub" type="text" value="<?=@$txtsub;?>" required>
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea name="txtmsg" class="form-control" placeholder="Enter your message" id="txtmsg" row="3"><?=@$txtmsg;?></textarea>
                </div>



            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <button type="submit" href="<?=site_url('admin/message')?>" class="btn btn-primary" name="btnSend" id="btnSend" value="Send">Send</button>
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

    <script type="text/javascript" language="javascript" src="<?=RES_URL;?>js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({ selector:'textarea',height: 300 });
    </script>




