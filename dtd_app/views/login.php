

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
								<div class="form-group">
                                            
                                            <select class="form-control">
                                                <option>Select your Role</option>
												<option>Admin</option>
                                                <option>Client</option>
                                                <option>Vendor</option>
                                                
                                            </select>
                                        </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
								
                                <a href="./customer" class="btn btn-lg btn-success btn-block">Login</a>
								<div class="form-group">
                                    <label>
                                        <a href="<?=site_url('registration');?>">New User, Click Here</a>
                                    </label>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

