<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Admin_Model');
		//Created By Hardik Mehta
		$this->load->model('user_model');
	}

	//Modified By Hardik Mehta
	public function index()
	{
		$this->load->template('admin/login');
 
	}

	//Cretaed By Hardik Mehta
	public function dashboard()
	{
		$this->load->template("admin/index");
	}

	//Created By Hardik Mehta
	public function login()
	{
		$is_login = $this->input->post('btnLogin');

		if($is_login == 'Login')
		{
			$config = array(
				array(
					'field' => 'txtemail',
					'label' => 'E-mail',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You must provide a %s',

					)
				),
				array(
					'field' => 'txtpass',
					'label' => 'Password',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You must provide a %s',
					)
				)
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == true)
			{
				$data = $this->user_model->adminvalidate();
				if($data['validated']){
					if($data['is_active'])
					{
						$this->session->set_userdata('userinfo', $data);
							redirect('admin/dashboard');

					}
					else
					{
						$error = "Your account not activated by Admin";
					}
				}else{
					$error = "Invalid Email or Password";
				}
			}
			else
			{
				$error = validation_errors();
			}
			$data['error'] = $error;
			$this->load->template('admin/login',$data);
		}
		else
		{
			$this->load->template('admin/login');
		}
	}
	public function deposit()
	{
		$this->load->template('admin/deposit');
 
	}

	//Created by Hardik Mehta
	public function app_vendor(){
		$this->load->template('admin/appvendor');
}

	//Created by Hardik Mehta
	public function change_pwd()
	{
		$is_change = $this->input->post('btnChange');
		if($is_change == 'Change')
		{
			$config = array
			(
				array(
					'field' => 'oldpwd',
					'label' => 'Old Password',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You must provide a %s'
					)
				),
				array(
					'field' => 'newpwd',
					'label' => 'New Password',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You must provide a %s'
					)
				),
				array(
					'field' => 'confirmpwd',
					'label' => 'Confirm Password',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You must provide a %s'

					)
				)

			);
			$this->form_validation->set_rules($config);

			if ($this->form_validation->run() == FALSE)
			{
				//fail validation
				$error = validation_errors();
			}
			else
			{
				//pass validation
				$curpwd=$this->Admin_Model->get_adm_pwd();

				if($curpwd['pwd']==$this->input->post('oldpwd'))
				{
					$data=array(
						'admin_pass'=>$this->input->post('newpwd')
					);
					$this->db->where('admin_id',$this->user_model->get_admin_id());
					$this->db->update('dtd_admin',$data);
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Password Successfully Changed!!!</div>');
				}
				else
				{
					$error="Old Password does not match";
					$data['error'] = $error;
				}
			}

			$this->load->template('admin/change_pwd',$data);
		}
		else
		{

			$this->load->template('admin/change_pwd');
		}


	}

	public function payment()
	{
		$this->load->template('admin/payment');
 
	}
	public function allocation()
	{
		$is_reg = $this->input->post('btnAllocate');
		if($is_reg=='Allocate'){
			$config = array(
				array(
					'field' => 'custname',
					'label' => 'Customer Name',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You must provide a %s',
					)
				),
				array(
					'field' => 'venname',
					'label' => 'Vendor Name',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You must provide a %s',
					)
				)
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == true) {
				$data['user_name'] = $this->input->post('txtname');
				$data['user_email'] = $this->input->post('txtusername');}
		}

		$data['vendors'] = $this->Admin_Model->get_vendors();
		$data['customers'] = $this->Admin_Model->get_customers();
		$this->load->template('admin/allocation',$data);

	}
	public function grade()
	{
		$this->load->template('admin/grade');
	}
	public function customers()
	{
		$this->load->template('admin/customers');
 
	}
	public function vendors()
	{
		$this->load->template('admin/vendors');
 
	}
	public function price()
	{
		$this->load->template('admin/price');
 
	}
	public function item()
	{
		$this->load->template('admin/item');
 
	}
	public function vendorprice()
	{
		$this->load->template('admin/vendorprice');
 
	}
	public function money_received()
	{
		$this->load->template('admin/money_received');
 
	}
	public function money_paid()
	{
		$this->load->template('admin/money_paid');
 
	}
	public function account()
	{
		$this->load->template('admin/account');
 
	}
	
	public function orders_pending()
	{
		$this->load->template('admin/orders_pending');		
	}
	
}
