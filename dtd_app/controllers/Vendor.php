<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('Vendor_Model');

		if(!$this->user_model->is_vendor()){
			redirect('/');
		}
	}
	public function index()
	{
		$data['all']=$this->Vendor_Model->get_summary_info();
		$this->load->template('vendor/index',$data);
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
					$this->user_model->update_pwd($data);
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
		$data['dorders'] = $this->Vendor_Model->get_day_orders();
		$this->load->template('vendor/orders_received',$data);
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
	{	$user_id = $this->user_model->get_current_user_id();
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

			}
			else
			{
				//pass validation
				$curpwd=$this->Vendor_Model->get_user_pwd();
				if($curpwd['pwd']==md5($this->input->post('oldpwd')))
				{
					$data=array(
						'user_pass'=>$this->input->post('newpwd')
					);
					$this->user_model->update_pwd($data);
					$msg = 'Password Successfully Changed!!!';
				}
				else
				{
					$msg = 'Old Password does not match!!!';

				}
			}
			$data['msg'] = $msg;
			$data['profile']=$this->Vendor_Model->get_vendor_profile($user_id);

			$this->load->template('vendor/profile',$data);
		}
		elseif($this->input->post('btnEditProfile')=="Update Profile")
		{
			$data1=array(
				'user_name'=>$this->input->post('username'),
				'user_mob'=>$this->input->post('usermob'),
				'user_add'=>$this->input->post('useradd'),
				'user_zipcode'=>$this->input->post('userzip'),
				'user_site'=>$this->input->post('usersite'),
				'user_memo'=>$this->input->post('umemo')
			);
			$this->db->where('user_id',$user_id);
			$this->db->update('dtd_users', $data1);
			$data2=array(
				'vendor_comp'=>$this->input->post('compname'),
				'vendor_hq1'=>$this->input->post('hq1'),
				'vendor_hq2'=>$this->input->post('hq2'),
				'vendor_hq3'=>$this->input->post('hq3'),
				'vendor_taxno'=>$this->input->post('taxrno'),
				'pay_bankacno'=>$this->input->post('bankacno'),
				'pay_bankname'=>$this->input->post('bankname'),

			);
			$this->db->where('user_id',$user_id);
			$this->db->update('dtd_vendor', $data2);
			$data['profile']=$this->Vendor_Model->get_vendor_profile($user_id);
			$this->load->template('vendor/profile',$data);
		}
		else
		{
		$data['profile']=$this->Vendor_Model->get_vendor_profile($user_id);
		$this->load->template('vendor/profile',$data);
		}
	}
	public function orders()
	{
		$orders['daily'] = $this->Vendor_Model->get_daily_orders();
		$orders['monthly'] = $this->Vendor_Model->get_monthly_orders();
		$this->load->template('vendor/orders',$orders);
	}
	public function account()
	{
		$data['account'] = $this->Vendor_Model->get_user_account();
		$data['payhist'] = $this->Vendor_Model->get_payment_history();
		$this->load->template('vendor/account',$data);
	}
	public function download()
	{
		$this->load->template('vendor/download');
	}
}
