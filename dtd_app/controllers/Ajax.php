<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	function __construct(){
		parent::__construct();
		// Load the model
		$this->load->model('Vendor_Model');
		$this->load->model('User_Model');
		$this->load->model('Customer_Model');
		$this->load->model('Admin_Model');
	}

	public function update_order(){
		$result = array();
		$order_id = $this->input->post('order_id');
		$data['order_updatecode'] = $this->input->post('up_code');
		$data['order_status'] = 'Delivered';
		$res = $this->Vendor_Model->update_order($data,$order_id);
		if($res){
			$result['message'] = 'Order updated successfully.';
		}else{
			$result['error'] = 'Either your order is already updated or there is database error';
		}
		die(json_encode($result));
	}

	public function v_ord_rec()
	{
		die($this->Vendor_Model->get_orders());
	}
	public function c_orders(){
		die($this->Customer_Model->get_user_orders());
	}
	public function a_pending_vendors(){
		die($this->Admin_Model->get_pending_vendors());
	}
	public function a_pending_customers(){
		die($this->Admin_Model->get_pending_customers());
	}
	public function a_customers(){
		die($this->Admin_Model->get_all_customers());
	}
	public function a_vendors(){
		die($this->Admin_Model->get_all_vendors());
	}
	public function a_vendor_customers(){
		die($this->Admin_Model->get_vendor_customers());
	}
	public function a_daily_deposits(){
		die($this->Admin_Model->get_daily_deposits());
	}
	public function a_daily_payments(){
		die($this->Admin_Model->get_daily_payments());
	}
	public function a_customer_grade(){
		die($this->Admin_Model->get_customer_grade());
	}
	public function a_item_price(){
		die($this->Admin_Model->get_item_price());
	}
	public function a_vendor_price(){
		die($this->Admin_Model->get_vendor_price());
	}
	public function delete_item(){
		$type_id = $this->input->post('type_id');
		$data['deleted'] = $this->Admin_Model->delete_item($type_id);
		die(json_encode($data));
	}
	public function edit_item(){
		$result = array();
		$type_id = $this->input->post('type_id');
		$data['type_name'] = $this->input->post('type_name');
		$res = $this->Admin_Model->edit_item($data,$type_id);
		if($res){
			$result['message'] = 'Item updated successfully.';
		}else{
			$result['error'] = 'Either your Item is already updated or there is database error';
		}
		die(json_encode($result));
	}
	public function a_item_list(){
		die($this->Admin_Model->get_items());
	}
	public function delete_grade(){
		$grade_id = $this->input->post('grade_id');
		$data['deleted'] = $this->Admin_Model->delete_grade($grade_id);
		die(json_encode($data));
	}
	public function approve_user(){
		$user_id = $this->input->post('user_id');
		$data['approve'] = $this->Admin_Model->approve_user($user_id);
		die(json_encode($data));
	}
	public function edit_grade(){
		$result = array();
		$grade_id = $this->input->post('grade_id');
		$data['grade_name'] = $this->input->post('grade_name');
		$res = $this->Admin_Model->edit_grade($data,$grade_id);
		if($res){
			$result['message'] = 'Customer grade updated successfully.';
		}else{
			$result['error'] = 'Either your customer grade is already updated or there is database error';
		}
		die(json_encode($result));
	}
	public function a_grade_list(){
		die($this->Admin_Model->get_grades());
	}
	public function c_account(){
		die($this->Customer_Model->get_user_account());
	}

	public function a_get_bank(){
		$vendorid = $this->input->post('vendor_id');
		die($this->Admin_Model->get_vendor_bank($vendorid));
	}
}
