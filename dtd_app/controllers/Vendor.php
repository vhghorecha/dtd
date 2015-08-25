<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('User_Model');
		$this->load->model('Vendor_Model');
	}
	public function index()
	{
		$this->load->template('vendor/index');
	}
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
				$msg = validation_errors();
				$data['error'] = true;
			}
			else
			{
				//pass validation
				$curpwd=$this->Vendor_Model->get_user_pwd();
				if($curpwd['pwd']==$this->input->post('oldpwd'))
				{
					$data=array(
						'user_pass'=>$this->input->post('newpwd')
					);
					$this->User_Model->update_pwd($data);
					$msg = 'Password Successfully Changed!!!';
				}
				else
				{
					$msg = 'Old Password does not match!!!';
					$data['error'] = true;
				}
			}
			$data['msg'] = $msg;
			$this->load->template('vendor/change_pwd',$data);
		}
		else
		{
			$this->load->template('vendor/change_pwd');
		}

	}
	public function orders_received()
	{
		$data['orders'] = $this->Vendor_Model->get_orders();
		$this->load->template('vendor/orders_received',$data);
	}
	public function view_order()
	{
		$this->load->template('vendor/view_order');
	}
	public function update_order()
	{
		$this->load->template('vendor/update_order');
	}
	public function orders_processed()
	{
		$this->load->template('vendor/orders_processed');
	}
	public function profile()
	{
		$is_profile=$this->input->post('btnEditProfile');
		if($is_profile=="Edit Profile")
		{

		}
		else
		{
			$user_id = $this->User_Model->get_current_user_id();
			$data=$this->Vendor_Model->get_vendor_profile($user_id);
			$this->load->template('vendor/profile',$data);
		}
		//$this->load->template('vendor/profile');
	}
	public function orders()
	{
		$orders = $this->Vendor_Model->get_orders();
		$this->load->template('vendor/orders',$orders);
	}
	public function account()
	{
		$this->load->template('vendor/account');
	}
}
