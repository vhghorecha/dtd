<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Admin_Model');
	}
	public function index()
	{
		$this->load->template('admin/index');
 
	}
	public function deposit()
	{
		$this->load->template('admin/deposit');
 
	}
	public function change_pwd()
	{
		$this->load->template('admin/change_pwd');

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
