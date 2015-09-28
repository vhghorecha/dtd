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
		redirect('admin/login');
 
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
		$is_dep = $this->input->post('btnDeposit');
		if($is_dep=='Deposit'){
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
					'field' => 'depositdate',
					'label' => 'Date of Deposit',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You must provide a %s',
					)
				),
				array(
					'field' => 'depamount',
					'label' => 'Amount',
					'rules' => 'required|numeric',
					'errors' => array(
						'required' => 'You must provide a %s',
						'numeric' => 'Only Numbers are allowed in Amount',
					)
				),
				array(
					'field' => 'depreference',
					'label' => 'Transaction Reference',
					'rules' => 'required|alpha_numeric|is_unique[custdep.dep_transno]',
					'errors' => array(
						'required' => 'You must provide a %s',
						'alpha_numeric' => 'Only alpha numeric values are allowed in Transaction Reference',
						'is_unique' => 'Transaction Reference already registered...',
					)
				),
				array(
					'field' => 'depbank',
					'label' => 'Bank Name',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You must provide a %s',
					)
				),
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == true) {
				$custid = $this->Admin_Model->get_customerid($this->input->post('custname'));
				$data['dep_custid'] = $custid;
				$date = DateTime::createFromFormat('d/m/Y',$this->input->post('depositdate'));
				$data['dep_date'] = $date->format('Y-m-d');
				$data['dep_amount'] = $this->input->post('depamount');
				$data['dep_transno'] = $this->input->post('depreference');
				$data['dep_bankname'] = $this->input->post('depbank');
				$this->Admin_Model->customer_deposit($data);
				$message = "Customer deposit successfully done.";
			}else{
				$error = validation_errors();
			}

			if(!empty($error)){
				$data = $_POST;
				$data['error'] = $error;
			}
			if(!empty($message)){
				$data['message'] = $message;
			}
			$data['customers'] = $this->Admin_Model->get_customers();
			$this->load->template('admin/deposit',$data);
		}else{
			$data['customers'] = $this->Admin_Model->get_customers();
			$this->load->template('admin/deposit',$data);
		}
	}
	
	//Created by Hardik Mehta
	public function app_vendor(){
		$this->load->template('admin/appvendor');
	}

	public function app_customer(){
		$this->load->template('admin/appcustomer');
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
		$is_save = $this->input->post('btnSave');
		if($is_save=='save'){
			$config = array(
				array(
					'field' => 'vendname',
					'label' => 'Vendor Name',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You must provide a %s',
					)
				),
				array(
					'field' => 'paydate',
					'label' => 'Date of Payment',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You must provide a %s',
					)
				),
				array(
					'field' => 'payamount',
					'label' => 'Amount',
					'rules' => 'required|numeric',
					'errors' => array(
						'required' => 'You must provide a %s',
						'numeric' => 'Only Numbers are allowed in Amount',
					)
				),
				array(
					'field' => 'payreference',
					'label' => 'Transaction Reference',
					'rules' => 'required|alpha_numeric|is_unique[dtd_vendorpay.pay_transno]',
					'errors' => array(
						'required' => 'You must provide a %s',
						'alpha_numeric' => 'Only alpha numeric values are allowed in Transaction Reference',
						'is_unique' => 'Transaction Reference already registered...',
					)
				),
				array(
					'field' => 'paybankacno',
					'label' => 'Bank A/c. Number',
					'rules' => 'required|alpha_numeric',
					'errors' => array(
						'required' => 'You must provide a %s',
						'alpha_numeric' => 'Only alpha numeric values are allowed in Transaction Reference',
					)
				),
				array(
					'field' => 'paybankname',
					'label' => 'Bank Name',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You must provide a %s',
					)
				),
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == true) {
				$vendid = $this->Admin_Model->get_vendorid($this->input->post('vendname'));
				$data['pay_vendorid'] = $vendid;
				$date = DateTime::createFromFormat('d/m/Y',$this->input->post('paydate'));
				$data['pay_date'] = $date->format('Y-m-d');
				$data['pay_amount'] = $this->input->post('payamount');
				$data['pay_transno'] = $this->input->post('payreference');
				$data['pay_bankacno'] = $this->input->post('paybankacno');
				$data['pay_bankname'] = $this->input->post('paybankname');
				$this->Admin_Model->vendor_pay($data);
				$message = "Vendor Payment successfully done.";
			}else{
				$error = validation_errors();
			}

			if(!empty($error)){
				$data = $_POST;
				$data['error'] = $error;
			}
			if(!empty($message)){
				$data['message'] = $message;
			}
			$data['vendors'] = $this->Admin_Model->get_vendors();
			$this->load->template('admin/payment',$data);
		}else{
			$data['vendors'] = $this->Admin_Model->get_vendors();
			$this->load->template('admin/payment',$data);
		}
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
					'field' => 'vendname',
					'label' => 'Vendor Name',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You must provide a %s',
					)
				)
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == true) {
				$userid = $this->input->post('custname');
				$vendid = $this->input->post('vendname');
				$this->Admin_Model->vendor_allocate($vendid,$userid);
				$message = "Customer to Vendor allocation successfully done.";
			}else{
				$error = validation_errors();
			}

			if(!empty($error)){
				$data = $_POST;
				$data['error'] = $error;
			}
			if(!empty($message)){
				$data['message'] = $message;
			}
			$data['vendors'] = $this->Admin_Model->get_vendors();
			$data['customers'] = $this->Admin_Model->get_unallocated_customers();
			$this->load->template('admin/allocation',$data);
		}else{
			$data['vendors'] = $this->Admin_Model->get_vendors();
			$data['customers'] = $this->Admin_Model->get_unallocated_customers();
			$this->load->template('admin/allocation',$data);
		}
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
	public function vendor_customer()
	{
		$data['vendors'] = $this->Admin_Model->get_vendor_json();
		$this->load->template('admin/vendor_cust',$data);
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
