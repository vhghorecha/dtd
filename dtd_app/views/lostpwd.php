<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Lost Password??</h3>
                </div>
                <div class="panel-body">
                    <?php if(!empty($error)) { ?>
                        <div class="alert alert-danger fade in"><?=$error;?></div>
                    <?php } ?>
                    <?php if(!empty($message)) { ?>
                        <div class="alert alert-success fade in"><?=$message;?></div>
                    <?php } ?>
                    <?php echo form_open('user/lostpwd', array(
                        'id' => 'frmlogin',
                        'role' => 'form'
                    ));?>
                        <fieldset>
                            <div class="form-group required">
                                <input class="form-control" placeholder="E-mail" name="txtemail" id="txtemail" type="email" autofocus>
                            </div>
                            <div class="form-group required">
                                <label class="control-label"><img id="imgcaptcha" src="<?=site_url('ajax/get_captcha/lostpwd');?>"/></label>
                                <a href="#" id="lnkcaptcha"><i class="fa fa-refresh"></i></a>
                                <input type="text" class="form-control" name="txtcaptcha" id="txtcaptcha" placeholder="Image Code" required/>
                            </div>
                            <input type="submit" class="btn btn-lg btn-success btn-block" name="btnReset" id="btnReset" value="Get New Password">
                            <div class="form-group">
                                <label>
                                    <a href="<?=site_url('user/register');?>">New User, Click Here</a> | <a href="<?=site_url('');?>">Login</a>
                                </label>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view("scripts"); ?>


<script>
$('#lnkcaptcha').click(function(e){
    e.preventDefault();
    $('#imgcaptcha').attr('src','<?=site_url("ajax/get_captcha/lostpwd");?>' + $.now());
});
</script>

