<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
	
	function __construct(){
        parent::__construct();
		$this->load->model('user_model');
		$this->load->model('Customer_Model');

		if(!$this->user_model->is_cust()){
			redirect('/');

		}
    }
	
	public function index()
	{
		$data['all']=$this->Customer_Model->get_all_orders();
		$this->load->template('customer/index',$data);
 
	}
	public function book_order()
	{
		$is_order = $this->input->post('btnOrder');
		if($is_order == 'Book Order')
		{
			$config = array(
				array(
					'field' => 'recname',
					'label' => 'Recipient Name',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You must provide a %s'
					)
				),
				array(
					'field' => 'address',
					'label' => 'Address',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You must provide a %s'
					)
				),
				array(
					'field' => 'mobile',
					'label' => 'Mobile Number',
					'rules' => 'required|numeric',
					'errors' => array(
						'required' => 'You must provide a %s',
						'numeric' => '%s must be numeric'
					)
				),
				array(
					'field' => 'telephone',
					'label' => 'Telephone Number',
					'rules' => 'required|numeric',
					'errors' => array(
						'required' => 'You must provide a %s',
						'numeric' => '%s must be numeric'
					)
				),
				array(
					'field' => 'itemname',
					'label' => 'Item Name',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You must provide a %s'
					)
				),
				array(
					'field' => 'itemdesc',
					'label' => 'Item Description',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You must provide a %s'
					)
				),
				array(
					'field' => 'itemmemo',
					'label' => 'Item Memo',
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
				$data = array(
					'order_custid' => $this->user_model->get_current_user_id(),
					'order_vendorid' => '1',

					'order_recipient' => $this->input->post('recname'),
					'order_address' => $this->input->post('address'),
					'order_zipcode' => '0',
					'order_telp' => '0',
					'order_telno' => $this->input->post('telephone'),
					'order_mobp' => '0',
					'order_mobno' => $this->input->post('mobile'),
					'order_typeid' => $this->input->post('item_type'),
					'order_amount' => '100',
					'order_itemname' => $this->input->post('itemname'),
					'order_desc' => $this->input->post('itemdesc'),
					'order_memo' => $this->input->post('itemmemo'),
					'order_status' => 'Pending'


				);

				//insert the form data into database
				$this->db->insert('dtd_order', $data);

				//display success message
				$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Employee details added to Database!!!</div>');
				redirect('customer/');
			}
			$data['error'] = $error;
			$data['item_type'] = $this->Customer_Model->get_item_type();
			$this->load->template('customer/book_order',$data);
		}
		else
		{
			$data['item_type'] = $this->Customer_Model->get_item_type();
			$this->load->template('customer/book_order',$data);
		}

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
				$error = validation_errors();
			}
			else
			{
				//pass validation
				$curpwd=$this->Customer_Model->get_user_pwd();
				if($curpwd['pwd']==$this->input->post('oldpwd'))
				{
					$data=array(
						'user_pass'=>$this->input->post('newpwd')
					);
					$this->db->where('user_id',$this->user_model->get_current_user_id());
					$this->db->update('dtd_users',$data);
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Password Successfully Changed!!!</div>');
				}
				else
				{
					$error="Old Password does not match";
				}
			}
			$data['error'] = $error;
			$this->load->template('customer/change_pwd',$data);
		}
		else
		{

			$this->load->template('customer/change_pwd');
		}

	}
	public function confirm_order()
	{
		$this->load->template('customer/cnf-order');              
	}
	
	public function profile()
	{
		$is_profile=$this->input->post('btnEditProfile');
		if($is_profile=="Update Profile")
		{
			$data1=array(
				'user_name'=>$this->input->post('username'),
				'user_add'=>$this->input->post('useradd'),
				'user_zipcode'=>$this->input->post('userzip'),
				'user_tel'=>$this->input->post('usertel'),
				'user_mob'=>$this->input->post('usermob'),
				'user_site'=>$this->input->post('usersite'),
				'user_staffname'=>$this->input->post('userstaff'),
				'user_stafftel'=>$this->input->post('userstafftel'),
				'user_memo'=>$this->input->post('usermemo'),
			);
			$this->db->where('user_id',$this->user_model->get_current_user_id() );
			$this->db->update('users', $data1);
			$data2=array(
				'user_sercomp'=>$this->input->post('sercomp'),
				'user_lob'=>$this->input->post('lob'),
				'user_regno'=>$this->input->post('regno'),
			);
			$this->db->where('user_id',$this->user_model->get_current_user_id() );
			$this->db->update('cust', $data2);
		}
		$data['profile']=$this->Customer_Model->get_user_profile();
		$this->load->template('customer/profile',$data);


	}
	public function orders()
	{
		$data['today']=$this->Customer_Model->get_today();
		$data['month']=$this->Customer_Model->get_monthly();
		$this->load->template('customer/orders',$data);
	}
	public function account()
	{
		/*
		 * SELECT * FROM (
SELECT cust_id, DATE_FORMAT( dtd_order.order_date, '%M-%Y' ) AS ord_date, COUNT( order_id ), SUM(order_amount), count(dep_id), sum(dep_amount)
FROM dtd_cust
LEFT OUTER JOIN dtd_order ON dtd_order.order_custid = dtd_cust.cust_id
LEFT OUTER JOIN dtd_custdep ON dtd_custdep.dep_custid = dtd_cust.cust_id  AND DATE_FORMAT(dtd_custdep.dep_date, '%M-%Y') = DATE_FORMAT( dtd_order.order_date, '%M-%Y' )
GROUP BY ord_date
HAVING dtd_cust.cust_id = 2
UNION
SELECT cust_id, DATE_FORMAT( dtd_custdep.dep_date, '%M-%Y' ) AS ord_date, COUNT( order_id ), SUM(order_amount), count(dep_id), sum(dep_amount)
FROM dtd_cust
LEFT OUTER JOIN dtd_custdep ON dtd_custdep.dep_custid = dtd_cust.cust_id
LEFT OUTER JOIN dtd_order ON dtd_order.order_custid = dtd_cust.cust_id AND DATE_FORMAT(dtd_custdep.dep_date, '%M-%Y') = DATE_FORMAT( dtd_order.order_date, '%M-%Y' )
GROUP BY ord_date
HAVING dtd_cust.cust_id = 2
) account
		 */
		/*$data['charges']=$this->Customer_Model->get_user_charges();
		$data['deposit']=$this->Customer_Model->get_user_deposit();*/
		$data['account'] = $this->Customer_Model->get_user_account();
		$this->load->template('customer/account',$data);
	}
}
