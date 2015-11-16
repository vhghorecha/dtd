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
			$vendor_amount=$this->Vendor_Model->get_vendor_amount($order_id);
			$this->Vendor_Model->set_user_balance($vendor_amount);
			$result['message'] = 'Order updated successfully.';
		}else{
			$result['error'] = 'Either your order is already updated or there is database error';
		}
		die(json_encode($result));
	}

	public function update_areacode(){
		$result = array();
		$user_id = $this->input->post('user_id');
		$user_areacode = $this->input->post('up_areacode');
		$this->db->set('user_areacode', $user_areacode);
		$this->db->where('user_id', $user_id);
		$this->db->update('users');
		if($this->db->affected_rows() > 0){
			$result['message'] = 'User area code updated successfully.';
		}else{
			$result['error'] = 'There is database error';
		}
		die(json_encode($result));
	}

	public function v_ord_rec()
	{
		die($this->Vendor_Model->get_orders());
	}
	public function a_app_ord()
	{
		die($this->Admin_Model->get_created_orders());
	}
	public function v_ord_del()
	{
		die($this->Vendor_Model->get_del_orders());
	}
	public function v_customers(){
		die($this->Vendor_Model->get_customers());
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
	public function a_ord_pen()
	{
		die($this->Admin_Model->get_pen_orders());
	}
	public function approve_order()
	{
		$order_id=$this->input->post('order_id');
		$this->db->set('order_status','Pending');
		$this->db->where('order_id',$order_id);
		$this->db->update('dtd_order');
		if($this->db->affected_rows()){
			$this->Admin_Model->set_user_balance($order_id);
			$result['message'] = 'Order Approve successfully.';
		}else{
			$result['error'] = 'Either your order is already approve or there is database error';
		}
		die(json_encode($result));
	}

	public function a_ven_pay()
	{
		$vendor_id = $_REQUEST['vendor_id'];
		die($this->Vendor_Model->get_ven_orders($vendor_id));
	}

	public function a_mon_pay()
	{
		die($this->Admin_Model->get_money_paid());
	}

	public function a_mon_rec()
	{
		die($this->Admin_Model->get_money_received());
	}
}
