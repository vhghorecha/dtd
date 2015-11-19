		<?php if($current_page == "customer"){ ?>

			<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </li>
                        <li>
                            <a href="<?=site_url('customer');?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
						<li>
                            <a href="<?=site_url('customer/book_order');?>"><i class="fa fa-edit fa-fw"></i> Delivery Request</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Reports<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?=site_url('customer/orders');?>">Orders</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('customer/account');?>">Account</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<li>
                            <a href="<?=site_url('customer/profile');?>"><i class="fa fa-user fa-fw"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-envelope fa-fw"></i> Message Board<span class="fa arrow"></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?=site_url('customer/message');?>"><i class="fa fa-edit fa-fw"></i> New Message</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('customer/rec_message');?>"><i class="fa fa-envelope-o fa-fw"></i> Received</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('customer/sent_message');?>"><i class="fa fa-send fa-fw"></i> Sent</a>
                                </li>
                            </ul>
                        </li>
						<li>
                            <a href="<?=site_url('user/logout');?>"><i class="fa fa-sign-out fa-fw"></i> Log Out</a>
                        </li>


                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->

        </nav>
		<?php } elseif($current_page == "vendor") { ?>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </li>
                        <li>
                            <a href="<?=site_url('vendor');?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="<?=site_url('vendor/orders_received');?>"><i class="fa fa-edit fa-fw"></i> Orders Received</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Reports<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?=site_url('vendor/orders');?>">Orders</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('vendor/account');?>">Account</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="<?=site_url('vendor/profile');?>"><i class="fa fa-user fa-fw"></i> Profile</a>
                        </li>
                        <li>
                            <a href="<?=site_url('vendor/customers');?>"><i class="fa fa-users fa-fw"></i> View Customers</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-envelope fa-fw"></i> Message Board<span class="fa arrow"></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?=site_url('vendor/message');?>"><i class="fa fa-edit fa-fw"></i> New Message</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('vendor/rec_message');?>"><i class="fa fa-envelope-o fa-fw"></i> Received</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('vendor/sent_message');?>"><i class="fa fa-send fa-fw"></i> Sent</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?=site_url('user/logout');?>"><i class="fa fa-sign-out fa-fw"></i> Log Out</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
            </nav>

			<?php } elseif($current_page == "admin" && $current_action != 'login') { ?>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </li>
                        <li>
                            <a href="<?=site_url('admin/dashboard');?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="<?=site_url('admin/app_order');?>"><i class="fa fa-thumbs-o-up fa-fw"></i> Approve Order</a>
                        </li>
                        <li>
                            <a href="<?=site_url('admin/allocation');?>"><i class="fa fa-edit fa-fw"></i> Customer-Vendor allocation</a>
                        </li>
						<li>
                            <a href="<?=site_url('admin/deposit');?>"><i class="fa fa-plus-square fa-fw"></i> Customer Deposit</a>
                        </li>
						<li>
                            <a href="<?=site_url('admin/payment');?>"><i class="fa fa-minus-square fa-fw"></i> Vendor Payment</a>
                        </li>
						<li>
                            <a href="<?=site_url('admin/price');?>"><i class="fa fa-area-chart fa-fw"></i> Pricing Scheme</a>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-money fa-fw"></i> Transactions<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?=site_url('admin/money_received');?>">Money Recieved</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('admin/money_paid');?>">Money Paid</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Customers<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?=site_url('admin/app_customer');?>">Approve Customer</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('admin/customers');?>">View Customers</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Vendors<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?=site_url('admin/app_vendor');?>">Approve Vendor</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('admin/vendors');?>">View Vendors</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('admin/vendor_customer');?>">View Customers</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-adn fa-fw"></i> Manage<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?=site_url('admin/item');?>">Item</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('admin/grade');?>">Grade</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="<?=site_url('admin/change_pwd');?>"><i class="fa fa-cogs fa-fw"></i> Change Password</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-envelope fa-fw"></i> Message Board<span class="fa arrow"></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?=site_url('admin/message');?>"><i class="fa fa-edit fa-fw"></i> New Message</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('admin/rec_message');?>"><i class="fa fa-envelope-o fa-fw"></i> Received</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('admin/sent_message');?>"><i class="fa fa-send fa-fw"></i> Sent</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?=site_url('admin/backup');?>" target="_blank"><i class="fa fa-cogs fa-save"></i> Backup</a>
                        </li>

                        <li>
                            <a href="<?=site_url('user/logout');?>"><i class="fa fa-sign-out fa-fw"></i> Log Out</a>
                        </li>


                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->

            </nav>
            <?php } ?>