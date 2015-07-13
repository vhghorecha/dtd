<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
	
	public function index()
	{
		$this->load->template('customer');
 
	}
	public function book_order()
	{
		$this->load->template('book_order');              
	}
	public function confirm_order()
	{
		$this->load->template('cnf-order');              
	}
	
	public function profile()
	{
		$this->load->template('profile');              
	}
	public function orders()
	{
		$this->load->template('orders');              
	}
	public function account()
	{
		$this->load->template('account');              
	}
}
