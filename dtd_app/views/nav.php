			<?php
			if($current_page == "customer")
			{
			?>	
			
			<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <!-- <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div> 
                             /input-group 
                        </li>-->
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
                            <a href="<?=site_url();?>"><i class="fa fa-sign-out fa-fw"></i> Log Out</a>
                        </li>
                        
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
			
        </nav>
		<?php } ?>