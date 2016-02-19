<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">DTD - Registration</h3>
                </div>
                <div class="panel-body">

                    <?php if (!empty($error)) { ?>
                        <div class="alert alert-danger fade in"><?= $error; ?></div>
                    <?php } ?>
					<?php if (!empty($message)) { ?>
                        <div class="alert alert-success fade in"><?= $message; ?></div>
                    <?php } ?>
                    <?php echo form_open(current_url(), array(
                        'id' => 'frmregistration',
                        'role' => 'form'
                    )); ?>
                    <fieldset>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
								<label>Username (Email)*</label>
                                <input class="form-control" placeholder="Email address" name="txtusername" id="txtusername" type="text" value="<?=@$txtusername;?>" required  autofocus>
                            </div>
                            <div class="form-group">
								<label>Password*</label>
                                <input class="form-control" placeholder="Password" name="txtpass" id="txtpass" type="password"  value="<?=@$txtpass;?>" required>
                            </div>
                            <div class="form-group">
								<label>Re-Type Password*</label>
                                <input class="form-control" placeholder="Re-type Password" name="txtcpass" id="txtcpass" type="password" value="<?=@$txtcpass;?>" required>
                            </div>
                            <div class="form-group">
								<label>Company Name*</label>
                                <input class="form-control" placeholder="Name" name="txtname" id="txtname" type="text" value="<?=@$txtname;?>" required>
                            </div>
                            <div class="form-group">
                                <label>Representive Name*</label>
                                <input class="form-control" placeholder="Representive Name" name="txtrepname" id="txtrepname" type="text" value="<?=@$txtmobile;?>" required>
                            </div>
                            <div class="form-group">
								<label>Address*</label>
                                <textarea name="txtaddress" class="form-control" placeholder="Address" id="txtaddress" row="3" required><?=@$txtaddress;?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Registration Type</label>
                                <br/>
                                <input type="radio" name="user_type" value="customer" checked> Customer
                                <input type="radio" name="user_type" value="vendor"> Vendor
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>ZipCode*</label>
                                <input class="form-control" placeholder="ZipCode" name="txtzip" id="txtzip" type="text" value="<?=@$txtzip;?>" required>
                            </div>
                            <div class="form-group">
								<label>Telephone No.*</label>
                                <input class="form-control" placeholder="Telephone Number" name="txttel" id="txttel" type="text" value="<?=@$txttel;?>" required>
                            </div>

                            <div class="form-group">
								<label>Website Address</label>
                                <input class="form-control" placeholder="Website Address" name="txtsite" id="txtsite" type="text" value="<?=@$txtsite;?>">
                            </div>
                            <div class="form-group">
								<label>Contact Person</label>
                                <input class="form-control" placeholder="Contact Person Name" name="txtperson" id="txtperson" type="text" value="<?=@$txtperson;?>">
                            </div>
                            <div class="form-group">
								<label>Telophone No. 2</label>
                                <input class="form-control" placeholder="Contact Person Number" name="txtpmob" id="txtpmob" type="text" value="<?=@$txtpmob;?>">
                            </div>
                            <div class="form-group">
                                <label>Memo</label>
                                <textarea name="txtmemo" class="form-control" placeholder="Memo" id="txtmemo" row="3"><?=@$txtmemo;?></textarea>
                            </div>

                            <div class="form-group" style="display:none" id="divBank">
                                <label>Bank Account Number</label>
                                <input class="form-control" placeholder="Bank Account Number" name="txtbank" id="txtbank" type="text" value="<?=@$txtbank;?>">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="checkbox" name="terms" required> <a href="<?= site_url('terms'); ?>">Terms of Contract</a> <br/>
                                <input type="checkbox" name="privacy" required> <a href="<?= site_url('privacy'); ?>">Privacy Policy</a>
                            </div>
                            <input type="submit" class="btn btn-mg btn-success " name="btnRegister" id="btnRegister" value="Register">
                            <div class="form-group">
                                <label>
                                    <a href="<?= site_url('login'); ?>">Already Register. Click Here</a>
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    </form>
                </div>
            </div>
        </div>

<?php $this->load->view("scripts"); ?>


<script>
    $("input[name='user_type']").change(function(){
        if($(this).val() == 'vendor'){
            $('#divBank').show();
            $('#divBank').prop('required',true);
        }else{
            $('#divBank').hide();
            $('#divBank').prop('required',false);
        }
    });
</script>

