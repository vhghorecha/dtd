<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	function __construct(){
		parent::__construct();
		// Load the model
		$this->load->model('Vendor_Model');
		$this->load->model('User_Model');
		$this->load->model('Customer_Model');
	}

	public function v_ord_rec()
	{
		die($this->Vendor_Model->get_orders());
	}

	public function c_orders(){
		die($this->Customer_Model->get_user_orders());
	}
	public function c_account(){
		die($this->Customer_Model->get_user_account());
	}
}
