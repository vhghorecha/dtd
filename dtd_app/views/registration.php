<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">DTD - Registration</h3>
                </div>
                <div class="panel-body">
                    <?php if(!empty($error)) { ?>
                        <div class="alert alert-danger fade in"><?=$error;?></div>
                    <?php } ?>
                    <?php echo form_open('registration', array(
                        'id' => 'frmregistration',
                        'role' => 'form'
                    ));?>
                    <fieldset>
                        <div class="form-group">
                            <lable>Registration Type</lable><br/>
                            <input type="radio" name="user_type" value="male" autofocus> Customer
                            <input type="radio" name="user_type" value="female"> Vendor
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Email address" name="txtusername" id="txtusername" type="text" value="" maxlength="25" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="txtpass" id="txtpass" type="password" value="" maxlength="15" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Re-type Password" name="txtcpass" id="txtcpass" type="password" value="" maxlength="15" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Name" name="txtname" id="txtname" type="text" value="" required>
                        </div>
                        <div class="form-group">
                            <textarea name="txtaddress" placeholder="Enter address" id="txtaddress" row="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="ZipCode" name="txtzip" id="txtzip" type="text" value="" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Telephone Number" name="txttel" id="txttel" type="text" value="" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Mobile Number" name="txtmobile" id="txtmobile" type="text" value="" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Website Address" name="txtsite" id="txtsite" type="text" value="" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Contact Person Name" name="txtperson" id="txtperson" type="text" value="" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Contact Person Number" name="txtpmob" id="txtpmob" type="text" value="" required>
                        </div>

                        <input type="submit" class="btn btn-mg btn-success " name="btnLogin" id="btnLogin" value="Register Me">
                        <div class="form-group">
                            <label>
                                <a href="<?=site_url('login');?>">Already Register. Click Here</a>
                            </label>
                        </div>
                    </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

