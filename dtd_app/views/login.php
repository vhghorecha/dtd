

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
						<?php if(!empty($error)) { ?>
							<div class="alert alert-danger fade in"><?=$error;?></div>
						<?php } ?>
                        <?php echo form_open('login', array(
							'id' => 'frmlogin',
							'role' => 'form'
						));?>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="txtemail" id="txtemail" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="txtpass" id="txtpass" type="password" value="" maxlength="15">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <input type="submit" class="btn btn-lg btn-success btn-block" name="btnLogin" id="btnLogin" value="Login">
								<div class="form-group">
                                    <label>
                                        <a href="<?=site_url('user/register');?>">New User, Click Here</a>
                                    </label>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

