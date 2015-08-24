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
		$this->load->template('customer/change_pwd');
	}
	public function confirm_order()
	{
		$this->load->template('customer/cnf-order');              
	}
	
	public function profile()
	{
		$this->load->template('customer/profile');              
	}
	public function orders()
	{
		$data['order']=$this->Customer_Model->get_user_orders();
		$data['today']=$this->Customer_Model->get_today();
		$data['month']=$this->Customer_Model->get_monthly();
		$this->load->template('customer/orders',$data);
	}
	public function account()
	{

		$this->load->template('customer/account');              
	}
}
