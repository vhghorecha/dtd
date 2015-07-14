<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
	
	public function index()
	{
		$this->load->template('customer/index');
 
	}
	public function book_order()
	{
		$this->load->template('customer/book_order');              
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
		$this->load->template('customer/orders');              
	}
	public function account()
	{
		$this->load->template('customer/account');              
	}
}
